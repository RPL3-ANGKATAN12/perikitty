<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach($cart as $item) { $total += $item['price'] * $item['qty']; }
        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['qty']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "qty" => 1,
                "price" => $product->price,
                "image" => $product->images ? json_decode($product->images)[0] : 'produk1.jpg'
            ];
        }
        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Produk masuk keranjang!');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        if($request->action == 'increase') {
            $cart[$id]['qty']++;
        } elseif($request->action == 'decrease' && $cart[$id]['qty'] > 1) {
            $cart[$id]['qty']--;
        }
        session()->put('cart', $cart);
        return redirect()->route('cart.index');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) { unset($cart[$id]); session()->put('cart', $cart); }
        return redirect()->route('cart.index')->with('success', 'Produk dihapus.');
    }
}