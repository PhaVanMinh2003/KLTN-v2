<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDiscount extends Model
{
    use HasFactory;

    protected $table = 'order_discounts';

    protected $primaryKey = 'order_discount_id';

    protected $fillable = [
        'order_id',
        'discount_code_id',
        'discount_amount'
    ];

    protected $dates = ['created_at'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function discountCode()
    {
        return $this->belongsTo(DiscountCode::class, 'discount_code_id', 'discount_code_id');
    }
}

