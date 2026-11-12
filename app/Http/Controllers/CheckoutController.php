<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach($cart as $item) { $total += $item['price'] * $item['qty']; }
        if(empty($cart)) return redirect()->route('cart.index');
        return view('checkout.index', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required', 'phone' => 'required', 'address' => 'required']);
        $cart = session()->get('cart', []);
        $total = 0;
        foreach($cart as $item) { $total += $item['price'] * $item['qty']; }

        try {
            $order = Order::create([
                'user_id' => auth()->id() ?? 1,
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'total' => $total,
                'status' => 'Diproses'
            ]);
            foreach($cart as $id => $details) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'qty' => $details['qty'],
                    'price' => $details['price']
                ]);
            }
            session()->forget('cart');
            return redirect()->route('konfirmasi.sukses'); // Ngarah ke halaman sukses
        } catch (\Exception $e) {
            return redirect()->route('konfirmasi.gagal'); // Ngarah ke halaman gagal
        }
    }
}