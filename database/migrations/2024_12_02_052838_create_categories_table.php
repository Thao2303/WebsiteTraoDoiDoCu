<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');         // Tên danh mục
            $table->text('description')->nullable();  // Mô tả về danh mục
            $table->boolean('status')->default(1);  // Trạng thái của danh mục (active/inactive)
            $table->timestamps();  // Thời gian tạo và cập nhật
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
}