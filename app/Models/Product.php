<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'sku', 'description', 'price', 'stock'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function isOutOfStock(): bool
    {
        return $this->stock <= 0;
    }
}
