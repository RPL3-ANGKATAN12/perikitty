<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class ShopCategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::query()->orderBy('name')->get();

        $counts = Product::query()
            ->where('is_active', true)
            ->selectRaw('category_id, count(*) as total')
            ->groupBy('category_id')
            ->pluck('total', 'category_id');

        return view('categories.index', compact('categories', 'counts'));
    }
}