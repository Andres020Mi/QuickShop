<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'description',
        'price',
        'stock',
    ];

    // Relación con usuario (un producto pertenece a un usuario)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con categoría (un producto pertenece a una categoría)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relación con reseñas (un producto puede tener muchas reseñas)
    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    // Relación con imágenes (un producto puede tener muchas imágenes)
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    // Relación con elementos de órdenes (un producto puede estar en muchos elementos de órdenes)
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
