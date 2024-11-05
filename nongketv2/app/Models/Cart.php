<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $fillable = [
        'created_at',
        'updated_at',
    ];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
