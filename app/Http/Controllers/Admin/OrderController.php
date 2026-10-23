<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class OrderController extends Controller
{
    public const STATUSES = [
        'pending' => 'Menunggu konfirmasi',
        'processing' => 'Dikemas',
        'shipped' => 'Dikirim',
        'completed' => 'Selesai',
        'cancelled' => 'Dibatalkan',
    ];

    public function index(): View
    {
        $orders = Order::query()
            ->with('user')
            ->latest()
            ->get();

        return view('admin.orders.index', [
            'orders' => $orders,
            'statuses' => self::STATUSES,
        ]);
    }

    public function show(Order $order): View
    {
        $order->load(['user', 'items']);

        return view('admin.orders.show', [
            'order' => $order,
            'statuses' => self::STATUSES,
        ]);
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(array_keys(self::STATUSES))],
        ]);

        if ($order->status === 'cancelled') {
            return back()->with('error', 'Pesanan yang sudah dibatalkan tidak bisa diubah.');
        }

        DB::transaction(function () use ($order, $validated): void {
            if ($validated['status'] === 'cancelled') {
                foreach ($order->items as $item) {
                    $item->product?->increment('stock', $item->quantity);
                }
            }

            $order->update(['status' => $validated['status']]);
        });

        return redirect()
            ->route('admin.orders.show', $order)
            ->with('success', 'Status pesanan berhasil diperbarui.');
    }
}