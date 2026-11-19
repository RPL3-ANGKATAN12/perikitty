<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Str;

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

    public function create() { $categories = Category::all(); return view('admin.create', compact('categories')); }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required', 'price' => 'required|numeric', 'stock' => 'required|numeric', 'description' => 'required', 'category_id' => 'required']);
        $data = $request->all();
        $data['slug'] = Str::slug($request->name) . '-' . time();
        $data['is_active'] = 1;
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) { $imagePaths[] = $image->store('products', 'public'); }
            $data['images'] = json_encode($imagePaths);
        }
        if ($request->hasFile('video')) { $data['video'] = $request->file('video')->store('products', 'public'); }
        Product::create($data);
        return redirect()->route('admin.dashboard')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id) { $product = Product::findOrFail($id); $categories = Category::all(); return view('admin.edit', compact('product', 'categories')); }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->all();
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) { $imagePaths[] = $image->store('products', 'public'); }
            $data['images'] = json_encode($imagePaths);
        }
        if ($request->hasFile('video')) { $data['video'] = $request->file('video')->store('products', 'public'); }
        $product->update($data);
        return redirect()->route('admin.dashboard')->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy($id) { Product::findOrFail($id)->delete(); return redirect()->route('admin.dashboard')->with('success', 'Produk berhasil dihapus!'); }
}