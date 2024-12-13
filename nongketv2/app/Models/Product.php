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
        'product_type_id',
        'name',
        'description',
        'origin',
        'history',
        'rating',
        'quantity',
        'price',
        'image_url',
    ];
    public function productType()
    {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }

    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
