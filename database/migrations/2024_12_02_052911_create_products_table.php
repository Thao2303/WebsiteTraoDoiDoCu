<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');             // Tên sản phẩm
            $table->text('description')->nullable(); // Mô tả sản phẩm (tùy chọn)
            $table->decimal('price', 10, 2);   // Giá sản phẩm
            $table->string('image')->nullable(); // Ảnh sản phẩm (tùy chọn)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
