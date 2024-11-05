<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'product_id';
    protected $fillable = [
        'farmer_id',
        'name',
        'quantity',
        'price',
        'image_url',
        'created_at',
        'updated_at',
    ];

    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
