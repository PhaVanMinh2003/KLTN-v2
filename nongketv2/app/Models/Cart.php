<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $fillable = [
        'consumer_id',
        'created_at',
        'updated_at',
        'discount_code_id',
        'discount_amount',
        'final_total'
    ];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function discountCode()
    {
        return $this->belongsTo(DiscountCode::class, 'discount_code_id', 'discount_code_id');
    }

}
