<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Mail\OrderStatusUpdated;
use App\Mail\CourierDetailsUpdated;
use Illuminate\Support\Facades\Mail;
use Razorpay\Api\Api;
use Exception;
use App\Mail\OrderCancelledMail;
use App\Mail\ReturnRequestMail;
use Carbon\Carbon;

class OrderController extends Controller
{
public function pending()
{
   $orders = Order::with(['items.product', 'user'])
    ->whereNotIn('status', ['completed', 'delivered'])
    ->orderBy('id', 'desc')
    ->get();

    return view('Admin.pending-order', compact('orders'));
}

public function orderStatus(Request $request, Order $order)
{
    $request->validate([
        'status' => 'required|string|in:packed,courier,delivered,cancelled',
    ]);

    // Check if trying to change to 'courier' status without courier details
    if ($request->status === 'courier' && !$order->courier_name) {
        return back()->withErrors('Please add courier details before changing status to courier.');
    }

    $oldStatus = $order->status;
    $order->status = $request->status;
    $order->save();

    if ($oldStatus !== $request->status) {
        Mail::to($order->user->email)->send(new OrderStatusUpdated($order));
    }

    return back()->with('success', 'Order status updated successfully.');
}
public function saveCourierDetails(Request $request, Order $order)
{
    $request->validate([
        'courier_name' => 'required|string|max:255',
        'tracking_number' => 'required|string|max:255',
        'courier_link' => 'max:255',
    ]);

    $order->courier_name = $request->courier_name;
    $order->tracking_number = $request->tracking_number;
    $order->courier_link = $request->courier_link;
    $order->save();

  
    Mail::to($order->user->email)->send(new CourierDetailsUpdated($order));

    return redirect()->back()->with('success', 'Courier details saved and email sent successfully.');
}
  public function completed()
{
    $orders = Order::with('items.product', 'user')
        ->whereIn('status', ['delivered', 'completed'])
        ->get();

    return view('Admin.completed-order', compact('orders'));
}
public function cancelledOrders()
{
    $orders = Order::where('status', 'Cancelled')->latest()->get();
    return view('Admin.cancelled-order', compact('orders'));
}

public function allOrders()
{
  $orders = Order::with('items.product', 'user')
                    ->orderBy('id', 'DESC')   
                    ->get(); 
    return view('Admin.all-order', compact('orders'));
}
public function track(Order $order)
{
   
    return view('track-shipment', compact('order'));
}
public function cancelOrder($id)
{
    $user = auth()->user();
    $order = Order::where('id', $id)
        ->where('user_id', $user->id)
        ->firstOrFail();

   
    if ($order->status !== 'Order Placed') {
        return back()->with('error', 'You cannot cancel this order after it has been shipped or delivered.');
    }

  
    if ($order->payment_method === 'cod') {
        $order->update([
            'status' => 'Cancelled',
            'refund_status' => 'not_applicable',
        ]);

     
        Mail::to($user->email)->send(new OrderCancelledMail($order, 'cod'));

        return back()->with('success', 'Your COD order has been cancelled successfully.');
    }

 
    if ($order->payment_method === 'online') {
        $order->update([
            'status' => 'Cancelled',
            'refund_status' => 'pending',
        ]);

      
        Mail::to($user->email)->send(new OrderCancelledMail($order, 'online'));

        return back()->with('success', 'Your order has been cancelled. Refund will be processed within 7 business days.');
    }

    return back()->with('error', 'Unable to cancel this order.');
}
public function processRefund($id)
{
    $order = Order::findOrFail($id);

    if ($order->payment_method !== 'online' || !$order->razorpay_payment_id) {
        return back()->with('error', 'Refund not applicable for this order.');
    }

    try {
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        // Fetch payment and issue refund
        $payment = $api->payment->fetch($order->razorpay_payment_id);
        $refund = $payment->refund([
            'amount' => $order->total * 100, 
            'speed'  => 'optimum',
        ]);

        $order->update(['refund_status' => 'completed']);

        return back()->with('success', 'Refund processed successfully.');
    } catch (Exception $e) {
        $order->update(['refund_status' => 'failed']);
        return back()->with('error', 'Refund failed: ' . $e->getMessage());
    }
}
public function returnOrder(Request $request, $id)
{
    $order = Order::findOrFail($id);

  
    if ($order->status !== 'delivered') {
        return back()->with('error', 'Order not delivered yet.');
    }

  
    $deliveredAt = Carbon::parse($order->delivered_at);
    if (now()->diffInDays($deliveredAt) > 5) {
        return back()->with('error', 'Return period expired (5 days after delivery).');
    }

  
    $order->update([
        'return_status' => 'requested',
        'return_reason' => $request->return_reason,
        'return_requested_at' => now(),
    ]);

  
    try {
      
        Mail::to('sale@naturolia.in')->send(new ReturnRequestMail($order, 'admin'));

       
        Mail::to($order->user->email)->send(new ReturnRequestMail($order, 'customer'));

    } catch (\Exception $e) {
        \Log::error('Mail sending failed for Order #' . $order->order_number . ': ' . $e->getMessage());
    }

    return back()->with('success', 'Return request submitted successfully. You will receive a confirmation email.');
}
}
