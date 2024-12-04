<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostProductTable extends Migration
{
    public function up()
    {
        Schema::create('post_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');    // Khóa ngoại tới bảng bài viết
            $table->unsignedBigInteger('product_id'); // Khóa ngoại tới bảng sản phẩm
            $table->timestamps();

            // Định nghĩa khóa ngoại
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('post_product');
    }
}
