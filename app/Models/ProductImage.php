<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'image_path',
    ];

    // Relación con producto (una imagen pertenece a un producto)
    public function product()
{
    return $this->belongsTo(Product::class);
}
}
