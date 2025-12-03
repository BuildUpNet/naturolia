<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
  
    public function viewCart()
    {
        if (Auth::check()) {
            $user = Auth::user();

            $cart = Cart::where('user_id', $user->id)
                ->with('items.product.images')
                ->first();

            $items = $cart ? $cart->items : collect();
        } else {
        
            $sessionCart = session('guest_cart', ['items' => []]);

            $items = collect($sessionCart['items'])->map(function ($item) {
                $product = Product::find($item['product_id']);
                $item['product'] = $product;
                $item['id'] = $item['product_id']; 
                return (object) $item;
            });
        }

        return view('add-cart', compact('items'));
    }

public function addToCart($productId)
{
    $product = Product::with('images')->findOrFail($productId);

    // If user is logged in
    if (auth()->check()) {
        $user = auth()->user();
        $cart = \App\Models\Cart::firstOrCreate(['user_id' => $user->id]);

        $cartItem = \App\Models\CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price,
            ]);
        }

        return redirect()->route('cart.view')->with('success', 'Product added to cart!');
    }

    // For guest users
    $guestCart = session('guest_cart', ['items' => []]);
    $items = collect($guestCart['items']);

    $existing = $items->firstWhere('product_id', $product->id);

    if ($existing) {
        $items = $items->map(function ($item) use ($product) {
            if ($item['product_id'] === $product->id) {
                $item['quantity']++;
            }
            return $item;
        });
    } else {
        $items->push([
            'product_id' => $product->id,
            'title' => $product->title ?? $product->name ?? 'Unknown Product',
            'price' => $product->price ?? 0,
            'quantity' => 1,
            'image' => $product->images->first()->image_path ?? 'images/default-placeholder.jpg',
        ]);
    }

    session(['guest_cart' => ['items' => $items->toArray()]]);

    return redirect()->route('cart.view')->with('success', 'Product added to cart!');
}


    public function removeItem($cartItemId)
    {
        if (Auth::check()) {
            $cartItem = CartItem::findOrFail($cartItemId);
            $cartItem->delete();
        } else {
            $cart = session()->get('guest_cart', ['items' => []]);
            $cart['items'] = array_filter($cart['items'], function ($item) use ($cartItemId) {
                return $item['product_id'] != $cartItemId;
            });
            session()->put('guest_cart', $cart);
        }

        return redirect()->route('cart.view')->with('success', 'Item removed from cart!');
    }

 
 public function updateItemQuantity(Request $request, $cartItemId)
{
    $request->validate(['quantity' => 'required|integer|min:1']);

    if (Auth::check()) {
        // ✅ Logged-in user
        $cartItem = CartItem::with('cart.items')->findOrFail($cartItemId);
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        $subtotal = $cartItem->price * $cartItem->quantity;
        $total = $cartItem->cart->items->sum(fn($i) => $i->price * $i->quantity);
    } else {
        // ✅ Guest user (cart stored in session)
        $cart = session()->get('guest_cart', ['items' => []]);
        foreach ($cart['items'] as &$item) {
            if ($item['product_id'] == $cartItemId) { // using product_id for guest
                $item['quantity'] = $request->quantity;
            }
        }

        session()->put('guest_cart', $cart);

        $subtotal = collect($cart['items'])
            ->firstWhere('product_id', $cartItemId)['price'] * $request->quantity;

        $total = collect($cart['items'])
            ->sum(fn($i) => $i['price'] * $i['quantity']);
    }

    return response()->json([
        'success' => true,
        'updated_quantity' => $request->quantity,
        'updated_subtotal' => number_format($subtotal, 2),
        'updated_total' => number_format($total, 2),
    ]);
}

}
