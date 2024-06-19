<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\CartItem;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::all();
        return view('admin.orders.index', compact('orders'));
    }


    public function store()
    {
        $cart = Cart::with('items.product')->where('user_id', auth()->id())->firstOrFail();

        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => $cart->total_price,
            'status' => 'pending',
        ]);

        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'options' => $item->options,
            ]);
        }

        // Vider le panier après la création de la commande
        $cart->items()->delete();
        $cart->update(['total_price' => 0]);

        return redirect()->route('orders.show', $order);
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function confirm(Order $order)
    {
        $order->update(['status' => 'confirmed']);
        return redirect()->route('orders.show', $order)->with('success', 'Commande confirmée avec succès.');
    }
}
