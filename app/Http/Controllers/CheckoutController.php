<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Razorpay\Api\Api;
use App\Mail\OrderInvoiceMail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\CodCharge;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Mail\UserWelcomeMail;
use App\Mail\AdminNewOrderMail;
use Exception;


class CheckoutController extends Controller
{
    public function showCheckout()
    {
        $user = auth()->user();

  
        if (!$user) {
            $sessionCart = session('guest_cart', ['items' => []]);
            if (empty($sessionCart['items'])) {
                return redirect()->route('cart.view')->with('error', 'Your cart is empty.');
            }

            $cartItems = collect($sessionCart['items'])->map(function ($item) {
                $product = \App\Models\Product::with('topImage')->find($item['product_id']);
                if (!$product) return null;

                return [
                    'title' => $product->title,
                    'price' => $product->price,
                    'quantity' => $item['quantity'],
                    'image' => $product->topImage->image_path ?? 'images/default-placeholder.jpg',
                ];
            })->filter();

            $totalPrice = $cartItems->sum(fn($item) => $item['price'] * $item['quantity']);
 $codCharge = CodCharge::first()->amount ?? 0;
            return view('checkout-guest', compact('cartItems', 'totalPrice' ,'codCharge'));
        }

      
        $cart = \App\Models\Cart::where('user_id', $user->id)
            ->with('items.product.topImage')
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $cartItems = $cart->items->map(function ($item) {
            $product = $item->product;
            return [
                'title' => $product->title,
                'price' => $product->price,
                'quantity' => $item->quantity,
                'image' => $product->topImage->image_path ?? 'images/default-placeholder.jpg',
            ];
        });
   $codCharge = CodCharge::first()->amount ?? 0;
        $totalPrice = $cartItems->sum(fn($item) => $item['price'] * $item['quantity']);

        return view('checkout', compact('user', 'cartItems', 'totalPrice' , 'codCharge'));
    }

    public function addAddress(Request $request)
    {
        $request->validate([
            'receiver_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'pincode' => 'required|string|max:6',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
        ]);

        $address = Address::create([
            'user_id' => auth()->id(),
            'receiver_name' => $request->receiver_name,
            'address' => $request->address,
            'pincode' => $request->pincode,
            'city' => $request->city,
            'state' => $request->state,
        ]);

        return redirect()->route('checkout.show')
            ->with('selected_address', $address->id)
            ->with('success', 'New address added successfully!');
    }

public function placeCodOrder(Request $request)
{
    $user = auth()->user();

    $cart = Cart::where('user_id', $user->id)->with('items.product')->first();
    if (!$cart || $cart->items->isEmpty()) {
        return redirect()->back()->with('error', 'Your cart is empty.');
    }

    $request->validate([
        'shipping_address_id' => 'nullable',
    ]);

    // ✅ Determine shipping address
    if ($request->shipping_address_id && $request->shipping_address_id !== 'user_address') {
        $address = Address::findOrFail($request->shipping_address_id);
        $shipping_address = "{$address->address}, {$address->city}, {$address->state} - {$address->pincode}";
    } else {
        $shipping_address = "{$user->address}, {$user->city}, {$user->state} - {$user->zipcode}";
    }

    // ✅ Generate custom order number
    $today = Carbon::now();
    $prefix = 'NAT-' . $today->format('d-m-y');
    $orderCountToday = Order::whereDate('created_at', $today->toDateString())->count();
    $sequence = str_pad($orderCountToday + 1, 3, '0', STR_PAD_LEFT);
    $customOrderId = $prefix . '-' . $sequence;

    // ✅ Calculate subtotal and COD charge
    $subtotal = $cart->items->sum(fn($item) => $item->price * $item->quantity);
    $codCharge = CodCharge::first()->amount ?? 0;
    $grandTotal = $subtotal + $codCharge;

    // ✅ Create order including cod_charges
    $order = Order::create([
        'user_id' => $user->id,
        'order_number' => $customOrderId,
        'shipping_address' => $shipping_address,
        'payment_method' => 'cod',
        'subtotal' => $subtotal,
        'cod_charges' => $codCharge, // ⚡ Add this field in DB (migration below)
        'total' => $grandTotal,
        'status' => 'Order Placed',
    ]);

    // ✅ Save order items
    foreach ($cart->items as $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $item->product_id,
            'quantity' => $item->quantity,
            'price' => $item->price,
            'total' => $item->price * $item->quantity,
        ]);
    }

    // ✅ Generate invoice
    $invoiceDirectory = public_path('invoices');
    if (!file_exists($invoiceDirectory)) {
        mkdir($invoiceDirectory, 0755, true);
    }

    $pdf = Pdf::loadView('view-invoice', compact('order'));
    $pdfFileName = 'invoice-' . $order->order_number . '.pdf';
    $pdfPath = 'invoices/' . $pdfFileName;
    $pdf->save(public_path($pdfPath));

    $order->update(['invoice_path' => $pdfPath]);


Mail::to($user->email)->send(new OrderInvoiceMail($order, public_path($pdfPath)));


Mail::to('sale@naturolia.in')->send(new AdminNewOrderMail($order));

    
    $cart->items()->delete();
    $cart->delete();

    return redirect()->route('orders.success', $order->id)
        ->with('order_success', true)
        ->with('order_id', $order->id);
}


public function createRazorpayOrder(Request $request)
{
    try {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['error' => 'Not logged in'], 401);
        }

        $cart = Cart::where('user_id', $user->id)->with('items.product')->first();
        if (!$cart || $cart->items->isEmpty()) {
            return response()->json(['error' => 'Cart empty'], 400);
        }

        $totalAmount = $cart->items->sum(fn($item) => $item->price * $item->quantity);

        $api = new \Razorpay\Api\Api(
            config('services.razorpay.key'),
            config('services.razorpay.secret')
        );

        $razorpayOrder = $api->order->create([
            'receipt' => 'rcptid_' . uniqid(),
            'amount' => $totalAmount * 100,
            'currency' => 'INR',
        ]);

        return response()->json([
            'orderId' => $razorpayOrder['id'],
            'amount' => $totalAmount,
            'currency' => 'INR',
            'key' => config('services.razorpay.key'),
            'name' => $user->name,
            'email' => $user->email,
            'contact' => $user->phone,
        ]);
    } catch (\Throwable $e) {
        return response()->json([
            'error' => 'Unable to initiate payment. Please try again.',
            'message' => $e->getMessage(),
        ], 500);
    }
}
public function verifyPayment(Request $request)
{
    try {
        $user = auth()->user();
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

      
        $razorpayOrderId = $request->input('razorpay_order_id');
        $razorpayPaymentId = $request->input('razorpay_payment_id');
        $razorpaySignature = $request->input('razorpay_signature');
        $shippingAddressId = $request->input('shipping_address_id');

        $api->utility->verifyPaymentSignature([
            'razorpay_order_id' => $razorpayOrderId,
            'razorpay_payment_id' => $razorpayPaymentId,
            'razorpay_signature' => $razorpaySignature,
        ]);

      
        $cart = Cart::where('user_id', $user->id)->with('items.product')->first();
        if (!$cart || $cart->items->isEmpty()) {
            return response()->json(['error' => 'Cart is empty'], 400);
        }

       
        if ($shippingAddressId && $shippingAddressId !== 'user_address') {
            $address = Address::where('id', $shippingAddressId)
                ->where('user_id', $user->id)
                ->first();

            if (!$address) {
                return response()->json(['error' => 'Invalid or unauthorized shipping address.'], 400);
            }

            $shipping_address = "{$address->address}, {$address->city}, {$address->state} - {$address->pincode}";
        } else {
            $shipping_address = "{$user->address}, {$user->city}, {$user->state} - {$user->zipcode}";
        }

   
        $today = now();
        $prefix = 'NAT-' . $today->format('d-m-y');
        $sequence = str_pad(Order::whereDate('created_at', $today->toDateString())->count() + 1, 3, '0', STR_PAD_LEFT);
        $customOrderId = $prefix . '-' . $sequence;

        $total = $cart->items->sum(fn($item) => $item->price * $item->quantity);

      
        $order = Order::create([
            'user_id' => $user->id,
            'order_number' => $customOrderId,
            'shipping_address' => $shipping_address,
            'payment_method' => 'online',
            'razorpay_order_id' => $razorpayOrderId,
            'razorpay_payment_id' => $razorpayPaymentId,
            'razorpay_signature' => $razorpaySignature,
            'subtotal' => $total,
            'total' => $total,
            'status' => 'Order Placed',
        ]);

        // ✅ Save order items
        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'total' => $item->price * $item->quantity,
            ]);
        }

        // ✅ Generate invoice
        $pdf = Pdf::loadView('view-invoice', compact('order'));
        $fileName = 'invoice-' . $order->order_number . '.pdf';
        $path = public_path('invoices/' . $fileName);
        $pdf->save($path);
        $order->update(['invoice_path' => 'invoices/' . $fileName]);

        Mail::to($user->email)->send(new OrderInvoiceMail($order, $path));
Mail::to('sale@naturolia.in')->send(new AdminNewOrderMail($order));


        // ✅ Clear cart
        $cart->items()->delete();
        $cart->delete();

        // ✅ Return success response
        return response()->json([
            'success' => true,
            'redirect_url' => route('orders.success', $order->id),
        ]);

    }catch (\Throwable $e) {
        // ❌ Create Failed Order Record
        Order::create([
            'user_id' => auth()->id(),
            'order_number' => 'FAILED-' . uniqid(),
            'payment_method' => 'online',
            'status' => 'Payment Failed',
            'razorpay_order_id' => $request->input('razorpay_order_id'),
        ]);

        return response()->json([
            'error' => true,
            'message' => 'Payment failed or cancelled. Please try again.',
            'details' => $e->getMessage(),
        ]);
    }
}

    public function success($orderId)
    {
        $order = Order::with('items.product')->findOrFail($orderId);
        return view('checkout-success', compact('order'));
    }

public function guestCheckout(Request $request)
{
    $sessionCart = session('guest_cart', ['items' => []]);
    $cartItems = collect($sessionCart['items']);

    if ($cartItems->isEmpty()) {
        return redirect()->route('cart.view')->with('error', 'Your cart is empty.');
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
      'phone' => 'required|numeric|digits_between:1,10',
        'address' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'state' => 'required|string|max:255',
        'pincode' => 'required|string|max:10',
        'payment_method' => 'required|string|in:cod,online',
    ]);

    // ✅ Step 1: Check or create user
    $user = User::where('email', $request->email)->first();
    $randomPassword = null;

    if ($user) {
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);
    } else {
        $randomPassword = Str::random(10);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($randomPassword),
            'phone' => $request->phone,
            'role' => 'user',
            'status' => 'active',
            'city' => $request->city,
            'address' => $request->address,
            'zipcode' => $request->pincode,
        ]);

        // send welcome email
        Mail::to($request->email)->send(new UserWelcomeMail($user, $randomPassword));
    }

    // ✅ Step 2: Calculate total
    $subtotal = $cartItems->sum(fn($item) => $item['price'] * $item['quantity']);
    $codCharge = CodCharge::first()->amount ?? 0;
    $total = $subtotal + ($request->payment_method === 'cod' ? $codCharge : 0);

    // ✅ Step 3: Generate unique order number
    $today = now();
    $prefix = 'NAT-' . $today->format('d-m-y');
    $sequence = str_pad(Order::whereDate('created_at', $today->toDateString())->count() + 1, 3, '0', STR_PAD_LEFT);
    $orderNumber = $prefix . '-' . $sequence;

    // ✅ Step 4: Create Order
    $order = Order::create([
        'user_id' => $user->id,
        'guest_email' => $request->email,
        'guest_phone' => $request->phone,
        'shipping_address' => "{$request->address}, {$request->city}, {$request->state} - {$request->pincode}",
        'payment_method' => $request->payment_method,
        'order_number' => $orderNumber,
        'subtotal' => $subtotal,
        'cod_charges' => $request->payment_method === 'cod' ? $codCharge : 0,
        'total' => $total,
        'status' => $request->payment_method === 'online' ? 'pending' : 'Order Placed',
    ]);

    foreach ($cartItems as $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $item['product_id'],
            'quantity' => $item['quantity'],
            'price' => $item['price'],
            'total' => $item['price'] * $item['quantity'],
        ]);
    }

    // ✅ Step 5: Handle payment method
    if ($request->payment_method === 'online') {
        // Razorpay order creation
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $razorpayOrder = $api->order->create([
            'receipt' => $orderNumber,
            'amount' => $total * 100, // amount in paise
            'currency' => 'INR',
        ]);

        $order->update([
            'razorpay_order_id' => $razorpayOrder['id'],
        ]);

        // Return Razorpay checkout view
        return view('razorpay-checkout', [
            'order' => $order,
            'razorpayOrder' => $razorpayOrder,
            'user' => $user,
            'key' => env('RAZORPAY_KEY'),
        ]);
    }

    // ✅ Step 6: Generate Invoice for COD
    $order = Order::with(['items.product.images'])->find($order->id);
    $pdf = Pdf::loadView('view-invoice', compact('order'));
    $fileName = 'invoice-' . $orderNumber . '.pdf';
    $path = public_path('invoices/' . $fileName);
    $pdf->save($path);

    $order->update(['invoice_path' => 'invoices/' . $fileName]);
    Mail::to($request->email)->send(new OrderInvoiceMail($order, $path));
Mail::to('sale@naturolia.in')->send(new AdminNewOrderMail($order));


    // ✅ Step 7: Clear guest cart
    session()->forget('guest_cart');

    // ✅ Step 8: Auto-login user (if COD)
    if ($request->payment_method === 'cod') {
        Auth::login($user);
    }

    return redirect()->route('orders.success', $order->id)
        ->with('success', 'Your order has been placed successfully!');
}


 public function razorpayVerify(Request $request)
{
    $signatureStatus = false;

    if ($request->razorpay_order_id && $request->razorpay_payment_id && $request->razorpay_signature) {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $attributes = [
            'razorpay_order_id' => $request->razorpay_order_id,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_signature' => $request->razorpay_signature,
        ];

        try {
            $api->utility->verifyPaymentSignature($attributes);
            $signatureStatus = true;
        } catch (\Exception $e) {
            $signatureStatus = false;
        }
    }

    $order = Order::where('razorpay_order_id', $request->razorpay_order_id)->first();

    if ($signatureStatus && $order) {
        $order->update([
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_signature' => $request->razorpay_signature,
            'status' => 'Order Placed',
        ]);

        // ✅ Generate invoice
        $pdf = Pdf::loadView('view-invoice', compact('order'));
        $fileName = 'invoice-' . $order->order_number . '.pdf';
        $path = public_path('invoices/' . $fileName);
        $pdf->save($path);

        $order->update(['invoice_path' => 'invoices/' . $fileName]);
        Mail::to($order->guest_email)->send(new OrderInvoiceMail($order, $path));
Mail::to('sale@naturolia.in')->send(new AdminNewOrderMail($order));


        // ✅ Find the user by email
        $user = User::where('email', $order->guest_email)->first();

        if ($user) {
            // ✅ Automatically login user after payment success
            Auth::login($user);

            // ✅ Clear guest cart
            session()->forget('guest_cart');

            return redirect()->route('orders.success', $order->id)
                ->with('success', 'Payment successful! You are now logged in and your order has been placed.');
        } else {
            // If user not found (edge case)
            return redirect()->route('orders.success', $order->id)
                ->with('success', 'Payment successful! (Login skipped - user not found)');
        }
    } else {
        return redirect()->route('cart.view')->with('error', 'Payment verification failed!');
    }
}
public function downloadInvoice($orderId)
{
    $order = Order::with('items.product')->findOrFail($orderId);


    $invoicePath = public_path($order->invoice_path);

  
    if (!$order->invoice_path || !file_exists($invoicePath)) {

      
        if (!file_exists(public_path('invoices'))) {
            mkdir(public_path('invoices'), 0755, true);
        }

       
        $pdf = Pdf::loadView('view-invoice', compact('order'));
        $fileName = 'invoice-' . $order->order_number . '.pdf';
        $invoicePath = public_path('invoices/' . $fileName);
        $pdf->save($invoicePath);

     
        $order->update([
            'invoice_path' => 'invoices/' . $fileName
        ]);
    }

   
    return response()->download($invoicePath);
}


}
