<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class DummyDataSeeder extends Seeder
{
    public function run()
    {
        Product::query()->delete();
        Category::query()->delete();

        $c1 = Category::create(['name' => 'Peralatan Dapur', 'slug' => 'peralatan-dapur']);
        $c2 = Category::create(['name' => 'Peralatan Rumah', 'slug' => 'peralatan-rumah']);
        $c3 = Category::create(['name' => 'Fashion & Pakaian', 'slug' => 'fashion-pakaian']);
        $c4 = Category::create(['name' => 'Perawatan Diri', 'slug' => 'perawatan-diri']);
        $c5 = Category::create(['name' => 'Sendal & Aksesoris', 'slug' => 'sendal-aksesoris']);

        Product::create(['name' => 'Wajan Anti Lengket', 'slug' => 'wajan', 'price' => 150000, 'stock' => 10, 'description' => 'Wajan kualitas premium.', 'category_id' => $c1->id, 'is_active' => 1]);
        Product::create(['name' => 'Kipas Angin Mini', 'slug' => 'kipas', 'price' => 85000, 'stock' => 20, 'description' => 'Kipas hemat listrik.', 'category_id' => $c2->id, 'is_active' => 1]);
        Product::create(['name' => 'Baju Tidur Sutra', 'slug' => 'bajutidur', 'price' => 120000, 'stock' => 15, 'description' => 'Bahan adem dan elegan.', 'category_id' => $c3->id, 'is_active' => 1]);
        Product::create(['name' => 'Parfum Elegan', 'slug' => 'parfum', 'price' => 200000, 'stock' => 5, 'description' => 'Wangi tahan lama.', 'category_id' => $c4->id, 'is_active' => 1]);
        Product::create(['name' => 'Sendal Jepit Estetik', 'slug' => 'sendal', 'price' => 50000, 'stock' => 30, 'description' => 'Nyaman dipakai.', 'category_id' => $c5->id, 'is_active' => 1]);
    }
}