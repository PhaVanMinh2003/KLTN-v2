<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
      // Tên bảng (nếu không theo chuẩn Laravel, bạn có thể chỉ định tên bảng)
      protected $table = 'product_types';

      // Các thuộc tính có thể gán (Mass Assignment)
      protected $fillable = ['type_name'];

      // Quan hệ với bảng `products`
      public function products()
      {
          return $this->hasMany(Product::class, 'product_type_id');
      }
}
