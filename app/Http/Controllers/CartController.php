<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;

class CartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);
        $cartItem = $cart->items()->where('product_id', $productId)->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            $cart->items()->create([
                'product_id' => $productId,
                'quantity' => 1, // ou $request->quantity si vous passez une quantité
                'price' => $product->price
            ]);
        }

        $cart->update(['total_price' => $cart->items->sum(function ($item) {
            return $item->price * $item->quantity;
        })]);

        return redirect()->route('cart.show');
    }

    public function showCart()
    {
        $cart = Cart::with('items.product')->where('user_id', auth()->id())->first();
        return view('cart.show', ['cart' => $cart]);
    }

    public function removeFromCart($itemId)
    {
        $item = CartItem::findOrFail($itemId);
        $cart = $item->cart;
        $item->delete();

        $cart->update(['total_price' => $cart->items->sum(function ($item) {
            return $item->price * $item->quantity;
        })]);

        return redirect()->route('cart.show');
    }
}
