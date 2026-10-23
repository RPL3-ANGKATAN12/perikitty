<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(Request $request): View
    {
        $cart = $request->session()->get('cart', []);

        $subtotal = collect($cart)->sum(
            fn (array $item): int => $item['price'] * $item['quantity']
        );

        return view('cart.index', compact('cart', 'subtotal'));
    }

    public function add(Request $request, Product $product): RedirectResponse
    {
        if (! $product->is_active) {
            abort(404);
        }

        if ($product->stock < 1) {
            return back()->with('error', 'Produk sedang habis.');
        }

        $cart = $request->session()->get('cart', []);

        $productId = $product->id;

        if (isset($cart[$productId])) {
            if ($cart[$productId]['quantity'] >= $product->stock) {
                return back()->with('error', 'Jumlah melebihi stok yang tersedia.');
            }

            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => 1,
            ];
        }

        $request->session()->put('cart', $cart);

        return redirect()
            ->route('cart.index')
            ->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:0'],
        ]);

        $cart = $request->session()->get('cart', []);

        if (! isset($cart[$product->id])) {
            return back();
        }

        $quantity = $validated['quantity'];

        if ($quantity < 1) {
            unset($cart[$product->id]);
            $request->session()->put('cart', $cart);

            return back()->with('success', 'Produk dihapus dari keranjang.');
        }

        if ($quantity > $product->stock) {
            return back()->with('error', 'Jumlah melebihi stok yang tersedia.');
        }

        $cart[$product->id]['quantity'] = $quantity;

        $request->session()->put('cart', $cart);

        return back()->with('success', 'Jumlah produk diperbarui.');
    }

    public function remove(Request $request, Product $product): RedirectResponse
    {
        $cart = $request->session()->get('cart', []);

        unset($cart[$product->id]);

        $request->session()->put('cart', $cart);

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }

    public function clear(Request $request): RedirectResponse
    {
        $request->session()->forget('cart');

        return back()->with('success', 'Keranjang berhasil dikosongkan.');
    }
}