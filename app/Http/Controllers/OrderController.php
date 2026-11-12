<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function success(Request $request, Order $order): View
    {
        abort_unless($order->user_id === $request->user()->id, 404);

        return view('orders.success', compact('order'));
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

    public function cancel(Request $request, Order $order): RedirectResponse
    {
        abort_unless($order->user_id === $request->user()->id, 404);

        if ($order->status !== 'pending') {
            return back()->with('error', 'Pesanan hanya bisa dibatalkan selama menunggu pembayaran.');
        }

        DB::transaction(function () use ($order) {
            foreach ($order->items as $item) {
                if ($item->product) {
                    $item->product->increment('stock', $item->quantity);
                }
            }

            $order->update(['status' => 'cancelled']);
        });

        return redirect()
            ->route('orders.show', $order)
            ->with('success', 'Pesanan berhasil dibatalkan. Stok sudah dikembalikan.');
    }
}
