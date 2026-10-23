<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->latest()
            ->get();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150', 'unique:products,name'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'integer', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'video' => ['nullable', 'mimes:mp4,mov,avi,webm', 'max:20480'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $imagePath = null;
        $videoPath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products/images', 'public');
        }

        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('products/videos', 'public');
        }

        Product::create([
            'category_id' => $validated['category_id'] ?? null,
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'image' => $imagePath,
            'video' => $videoPath,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Product $product)
    {
        return redirect()
            ->route('admin.products.edit', $product);
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:150',
                'unique:products,name,' . $product->id,
            ],
            'category_id' => ['nullable', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'integer', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'video' => ['nullable', 'mimes:mp4,mov,avi,webm', 'max:20480'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data = [
            'category_id' => $validated['category_id'] ?? null,
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'is_active' => $request->boolean('is_active'),
        ];

        if ($request->hasFile('image')) {

            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $data['image'] = $request
                ->file('image')
                ->store('products/images', 'public');
        }

        if ($request->hasFile('video')) {

            if ($product->video) {
                Storage::disk('public')->delete($product->video);
            }

            $data['video'] = $request
                ->file('video')
                ->store('products/videos', 'public');
        }

        $product->update($data);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        if ($product->video) {
            Storage::disk('public')->delete($product->video);
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}