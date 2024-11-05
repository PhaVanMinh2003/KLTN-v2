<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'order_date',
        'status',
        'total_amount',
        'created_at',
        'updated_at',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
