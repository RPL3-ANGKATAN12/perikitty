<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        $shipping = config('batam.shipping_cost', 10000);

        return view('checkout.index', compact('cart', 'total', 'shipping'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'address' => 'required|string|min:5',
        ], [
            'kecamatan.required' => 'Pilih kecamatan pengiriman.',
            'kelurahan.required' => 'Pilih kelurahan pengiriman.',
            'address.min' => 'Alamat terlalu singkat, mohon isi alamat lengkap.',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        $shipping = config('batam.shipping_cost', 10000);
        $grandTotal = $total + $shipping;

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => auth()->id() ?? 1,
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'customer_name' => $request->name,
                'phone' => $request->phone ?? auth()->user()->phone ?? '-',
                'address' => $request->address . ', Kel. ' . $request->kelurahan,
                'city' => 'Batam',
                'province' => 'Kepulauan Riau',
                'district' => $request->kecamatan,
                'subtotal' => $total,
                'shipping' => $shipping,
                'total' => $grandTotal,
                'status' => 'Diproses',
            ]);

            $pesanWA = "Halo Admin Perikitty, saya mau pesan:\n\n";
            $pesanWA .= "No. Pesanan: " . $order->order_number . "\n";
            $pesanWA .= "Nama: " . $request->name . "\n";
            $pesanWA .= "Alamat: " . $request->address . ", Kel. " . $request->kelurahan . ", Kec. " . $request->kecamatan . ", Kota Batam\n\n";
            $pesanWA .= "Detail Barang:\n";

            foreach ($cart as $id => $details) {
                $itemSubtotal = $details['price'] * $details['qty'];

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'product_name' => $details['name'],
                    'price' => $details['price'],
                    'quantity' => $details['qty'],
                    'subtotal' => $itemSubtotal,
                ]);

                $product = Product::find($id);
                if ($product) {
                    $product->decrement('stock', $details['qty']);
                }

                $pesanWA .= "- " . $details['name'] . " (" . $details['qty'] . "x) = Rp " . number_format($itemSubtotal, 0, ',', '.') . "\n";
            }

            $pesanWA .= "\nSubtotal: Rp " . number_format($total, 0, ',', '.');
            $pesanWA .= "\nOngkir: Rp " . number_format($shipping, 0, ',', '.');
            $pesanWA .= "\nTotal: Rp " . number_format($grandTotal, 0, ',', '.') . "\n\nTerima kasih!";

            DB::commit();
            session()->forget('cart');

            $waNumber = '6285835566771';
            $waUrl = "https://wa.me/" . $waNumber . "?text=" . urlencode($pesanWA);

            return redirect($waUrl);

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Checkout gagal: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return redirect()->route('konfirmasi.gagal');
        }
    }
}