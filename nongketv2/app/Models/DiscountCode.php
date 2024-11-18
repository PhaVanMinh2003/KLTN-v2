<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    use HasFactory;

    protected $table = 'discount_codes';
    protected $primaryKey = 'discount_code_id';

    protected $fillable = [
        'code',
        'description',
        'discount_type',
        'discount_value',
        'min_purchase_amount',
        'start_date',
        'end_date',
        'status'
    ];

    protected $dates = ['start_date', 'end_date'];

    public function orderDiscounts()
    {
        return $this->hasMany(OrderDiscount::class, 'discount_code_id', 'discount_code_id');
    }
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'id');
    }
}
