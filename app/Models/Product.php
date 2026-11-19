<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $fillable = ['category_id', 'name', 'slug', 'price', 'stock', 'description', 'image', 'images', 'video', 'is_active'];
    protected $casts = ['images' => 'array'];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}