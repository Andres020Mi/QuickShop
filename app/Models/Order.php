<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'total',
    ];

    // Relación con usuario (una orden pertenece a un usuario)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con elementos de órdenes (una orden puede tener muchos elementos)
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Relación con dirección de envío (una orden puede tener una dirección de envío)
    public function shippingAddress()
    {
        return $this->hasOne(ShippingAddress::class);
    }
}
