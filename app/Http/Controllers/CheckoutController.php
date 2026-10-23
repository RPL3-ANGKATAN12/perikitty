<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    private const CITY = 'Batam';

    private const PROVINCE = 'Kepulauan Riau';

    private const INITIAL_STATUS = 'pending';

    public function create(Request $request): View|RedirectResponse
    {
        $cart = $request->session()->get('cart', []);

        if ($cart === []) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Keranjang masih kosong.');
        }

        $subtotal = collect($cart)->sum(
            fn (array $item): int => $item['price'] * $item['quantity']
        );

        return view('checkout.create', [
            'cart' => $cart,
            'subtotal' => $subtotal,
            'districts' => config('shipping.districts'),
            'user' => $request->user(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $cart = $request->session()->get('cart', []);

        if ($cart === []) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Keranjang masih kosong.');
        }

        $districts = config('shipping.districts');

        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'regex:/^(\+62|62|0)8[0-9]{8,12}$/'],
            'address' => ['required', 'string', 'max:500'],
            'district' => ['required', Rule::in(array_keys($districts))],
            'notes' => ['nullable', 'string', 'max:500'],
        ], [
            'phone.regex' => 'Nomor HP tidak valid. Contoh: 081234567890.',
            'district.in' => 'Pengiriman hanya tersedia untuk kecamatan di Batam.',
        ]);

        $order = DB::transaction(function () use ($cart, $validated, $districts, $request): Order {
            $products = Product::query()
                ->whereIn('id', array_keys($cart))
                ->lockForUpdate()
                ->get()
                ->keyBy('id');

            $subtotal = 0;
            $lines = [];

            foreach ($cart as $productId => $item) {
                $product = $products->get($productId);

                if ($product === null || ! $product->is_active || $product->stock < $item['quantity']) {
                    throw ValidationException::withMessages([
                        'cart' => 'Stok "'.$item['name'].'" tidak mencukupi. Silakan periksa keranjangmu.',
                    ]);
                }

                $lineSubtotal = $product->price * $item['quantity'];
                $subtotal += $lineSubtotal;

                $lines[] = [
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'subtotal' => $lineSubtotal,
                ];
            }

            $shipping = $districts[$validated['district']];

            $order = Order::create([
                'user_id' => $request->user()->id,
                'order_number' => 'PK-'.now()->format('ymd').'-'.Str::upper(Str::random(5)),
                'customer_name' => $validated['customer_name'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'district' => $validated['district'],
                'notes' => $validated['notes'] ?? null,
                'city' => self::CITY,
                'province' => self::PROVINCE,
                'subtotal' => $subtotal,
                'shipping' => $shipping,
                'total' => $subtotal + $shipping,
                'status' => self::INITIAL_STATUS,
            ]);

            foreach ($lines as $line) {
                $order->items()->create([
                    'product_id' => $line['product']->id,
                    'product_name' => $line['product']->name,
                    'price' => $line['product']->price,
                    'quantity' => $line['quantity'],
                    'subtotal' => $line['subtotal'],
                ]);

                $line['product']->decrement('stock', $line['quantity']);
            }

            return $order;
        });

        $request->session()->forget('cart');

        return redirect()
                      ->route('orders.show', $order)
            ->with('success', 'Pesanan '.$order->order_number.' berhasil dibuat.');
    }
}