<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.dashboard', compact('products'));
    }

    public function orders()
    {
        $orders = Order::latest()->get();
        return view('admin.orders', compact('orders'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'images' => 'nullable|array|max:30',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:8192',
            'video' => 'nullable|mimetypes:video/mp4,video/webm,video/quicktime,video/x-msvideo|max:51200',
        ]);

        $data = $request->only(['name', 'price', 'stock', 'description', 'category_id']);
        $data['slug'] = Str::slug($request->name) . '-' . time();
        $data['is_active'] = 1;

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('products', 'public');
            }
        }
        $data['images'] = json_encode(array_values(array_unique($imagePaths)));

        if ($request->hasFile('video')) {
            $data['video'] = $request->file('video')->store('products', 'public');
        }

        $product = Product::create($data);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Produk berhasil ditambahkan (' . count($imagePaths) . ' foto varian)!')
            ->with('last_product_id', $product->id);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'images' => 'nullable|array|max:30',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:8192',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'string',
            'replace_images' => 'nullable|boolean',
            'video' => 'nullable|mimetypes:video/mp4,video/webm,video/quicktime,video/x-msvideo|max:51200',
        ]);

        $product = Product::findOrFail($id);
        $data = $request->only(['name', 'price', 'stock', 'description', 'category_id']);

        $existing = is_array($product->images)
            ? $product->images
            : (json_decode($product->images ?? '[]', true) ?: []);
        $existing = array_values(array_filter($existing, fn($p) => is_string($p) && trim($p) !== ''));

        $toDelete = $request->input('delete_images', []);
        if (is_array($toDelete) && !empty($toDelete)) {
            foreach ($toDelete as $delPath) {
                if (in_array($delPath, $existing, true)) {
                    $clean = ltrim($delPath, '/');
                    if (str_starts_with($clean, 'products/') && Storage::disk('public')->exists($clean)) {
                        Storage::disk('public')->delete($clean);
                    }
                }
            }
            $existing = array_values(array_diff($existing, $toDelete));
        }

        if ($request->boolean('replace_images') && $request->hasFile('images')) {
            foreach ($existing as $oldPath) {
                $clean = ltrim($oldPath, '/');
                if (str_starts_with($clean, 'products/') && Storage::disk('public')->exists($clean)) {
                    Storage::disk('public')->delete($clean);
                }
            }
            $existing = [];
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $existing[] = $image->store('products', 'public');
            }
        }

        $data['images'] = json_encode(array_values(array_unique($existing)));

        if ($request->hasFile('video')) {
            if (!empty($product->video)) {
                $cleanVid = ltrim((string) $product->video, '/');
                if (str_starts_with($cleanVid, 'products/') && Storage::disk('public')->exists($cleanVid)) {
                    Storage::disk('public')->delete($cleanVid);
                }
            }
            $data['video'] = $request->file('video')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Produk berhasil diupdate (' . count($existing) . ' foto aktif di slider)!')
            ->with('last_product_id', $product->id);
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Produk berhasil dihapus!');
    }
}