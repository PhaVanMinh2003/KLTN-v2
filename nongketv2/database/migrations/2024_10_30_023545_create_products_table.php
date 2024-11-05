<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id'); // Hoặc $table->increments('id'); nếu bạn muốn sử dụng id
            $table->foreignId('farmer_id')->constrained('farmers')->onDelete('cascade');
            $table->string('name');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->string('image_url')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
