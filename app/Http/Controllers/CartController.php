<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private function getImage($product): string
    {
        if ($product->images) {
            $decoded = json_decode($product->images, true);
            if (is_array($decoded) && count($decoded) > 0) {
                $path = ltrim((string) $decoded[0], '/');
                $path = preg_replace('#^(storage/|products/)+#', '', $path);
                if ($path !== '') {
                    return $path;
                }
            }
        }
        return 'produk1.jpg';
    }

    private function pesanStok($product): string
    {
        return 'Jumlah melebihi stok. Stok tersedia: ' . $product->stock . ' pcs.';
    }

    public function index()
    {
        $cart = [];
        $total = 0;

        if (Auth::check()) {
            $items = CartItem::with('product')
                ->where('user_id', Auth::id())
                ->get();

            foreach ($items as $item) {
                if (!$item->product) continue;

                $price = $item->product->price;
                $qty = $item->qty;
                $total += $price * $qty;

                $cart[$item->product_id] = [
                    'id' => $item->id,
                    'product_id' => $item->product_id,
                    'name' => $item->product->name,
                    'qty' => $qty,
                    'price' => $price,
                    'image' => $this->getImage($item->product),
                ];
            }
        } else {
            $cart = session()->get('cart', []);
            foreach ($cart as $item) {
                $total += $item['price'] * $item['qty'];
            }
        }

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($product->stock <= 0) {
            return redirect()->route('cart.index')->with('error', 'Maaf, stok produk ini sudah habis.');
        }

        if (Auth::check()) {
            $item = CartItem::where('user_id', Auth::id())
                ->where('product_id', $product->id)
                ->first();

            $qtySekarang = $item ? $item->qty : 0;
            if ($qtySekarang + 1 > $product->stock) {
                return redirect()->route('cart.index')->with('error', $this->pesanStok($product));
            }

            if ($item) {
                $item->increment('qty');
            } else {
                CartItem::create([
                    'user_id' => Auth::id(),
                    'product_id' => $product->id,
                    'qty' => 1,
                ]);
            }
        } else {
            $cart = session()->get('cart', []);
            $qtySekarang = isset($cart[$id]) ? $cart[$id]['qty'] : 0;
            if ($qtySekarang + 1 > $product->stock) {
                return redirect()->route('cart.index')->with('error', $this->pesanStok($product));
            }

            if (isset($cart[$id])) {
                $cart[$id]['qty']++;
            } else {
                $cart[$id] = [
                    'name' => $product->name,
                    'qty' => 1,
                    'price' => $product->price,
                    'image' => $this->getImage($product),
                ];
            }
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Produk masuk keranjang!');
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (Auth::check()) {
            $item = CartItem::where('user_id', Auth::id())
                ->where('product_id', $id)
                ->first();

            if ($item) {
                if ($request->action == 'increase') {
                    if ($product && $item->qty + 1 > $product->stock) {
                        return redirect()->route('cart.index')->with('error', $this->pesanStok($product));
                    }
                    $item->increment('qty');
                } elseif ($request->action == 'decrease' && $item->qty > 1) {
                    $item->decrement('qty');
                }
            }
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$id])) {
                if ($request->action == 'increase') {
                    if ($product && $cart[$id]['qty'] + 1 > $product->stock) {
                        return redirect()->route('cart.index')->with('error', $this->pesanStok($product));
                    }
                    $cart[$id]['qty']++;
                } elseif ($request->action == 'decrease' && $cart[$id]['qty'] > 1) {
                    $cart[$id]['qty']--;
                }
                session()->put('cart', $cart);
            }
        }

        return redirect()->route('cart.index');
    }

    public function remove($id)
    {
        if (Auth::check()) {
            CartItem::where('user_id', Auth::id())
                ->where('product_id', $id)
                ->delete();
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
        }

        return redirect()->route('cart.index')->with('success', 'Produk dihapus.');
    }
}