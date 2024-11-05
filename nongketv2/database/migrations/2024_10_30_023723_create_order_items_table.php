<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id(); // Cột khóa chính tự động tăng
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // Tham chiếu tới order_id
            $table->foreignId('product_id')->constrained('products', 'product_id')->onDelete('cascade'); // Tham chiếu tới product_id
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};
