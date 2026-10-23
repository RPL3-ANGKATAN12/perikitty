<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $orders = Order::query()
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function show(Request $request, Order $order): View
    {
        abort_unless($order->user_id === $request->user()->id, 404);

        $order->load('items');

        $lines = [
            'Halo '.config('shop.name').', saya mau konfirmasi pesanan:',
            '',
            'No. Pesanan: '.$order->order_number,
        ];

        foreach ($order->items as $item) {
            $lines[] = '- '.$item->product_name.' x'.$item->quantity;
        }

        $lines[] = '';
        $lines[] = 'Subtotal: Rp '.number_format($order->subtotal, 0, ',', '.');
        $lines[] = 'Ongkir: Rp '.number_format($order->shipping, 0, ',', '.');
        $lines[] = 'Total: Rp '.number_format($order->total, 0, ',', '.');
        $lines[] = '';
        $lines[] = 'Nama: '.$order->customer_name;
        $lines[] = 'Alamat: '.$order->address.', '.$order->district.', '.$order->city;

        $whatsappUrl = 'https://wa.me/'.config('shop.whatsapp')
            .'?text='.rawurlencode(implode("\n", $lines));

        return view('orders.show', compact('order', 'whatsappUrl'));
    }
}