<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $fillable = ['category_id', 'name', 'slug', 'price', 'stock', 'description', 'image', 'is_active'];

    // Tambahin fungsi relasi ini biar Beranda gak error
    public function category() {
        return $this->belongsTo(Category::class);
    }
}