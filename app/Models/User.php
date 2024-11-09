<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


      // Relación con productos (un usuario puede tener muchos productos)
      public function products()
      {
          return $this->hasMany(Product::class);
      }
  
      // Relación con órdenes (un usuario puede tener muchas órdenes)
      public function orders()
      {
          return $this->hasMany(Order::class);
      }
  
      // Relación con direcciones de envío (un usuario puede tener muchas direcciones)
      public function shippingAddresses()
      {
          return $this->hasMany(ShippingAddress::class);
      }

}
