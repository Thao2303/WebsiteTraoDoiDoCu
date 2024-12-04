<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');        // Tiêu đề bài viết
            $table->text('content');       // Nội dung bài viết
            $table->unsignedBigInteger('category_id');  // Khóa ngoại tới bảng danh mục
            $table->string('image')->nullable();        // Đường dẫn ảnh (tùy chọn)
            $table->boolean('status')->default(1);      // Trạng thái bài viết (hiển thị hoặc ẩn)
            $table->unsignedBigInteger('user_id')->default(1);    // Khóa ngoại tới user đăng bài
            $table->timestamps();

            // Định nghĩa khóa ngoại
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
