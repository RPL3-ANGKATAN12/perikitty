<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('category')
            ->where('is_active', true)
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->when($request->filled('kategori'), function ($query) use ($request) {
                $query->where('category_id', $request->kategori);
            })
            ->latest()
            ->get();

        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        abort_unless($product->is_active, 404);

        return view('products.show', compact('product'));
    }
}