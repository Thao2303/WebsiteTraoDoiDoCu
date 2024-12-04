<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post; 

class PostsSeeder extends Seeder
{
    public function run()
    {
        Post::create([
            'title' => 'Bài viết 1',
            'content' => 'Nội dung bài viết 1',
            'category_id' => 1,  // Đảm bảo category_id đã tồn tại trong bảng categories
            'status' => 1, // Nếu có trường degflag
            'user_id' => 1,  // Giả sử người dùng có ID là 1 đã đăng bài
        ]);

        Post::create([
            'title' => 'Bài viết 2',
            'content' => 'Nội dung bài viết 2',
            'category_id' => 2,
            'status' => 1,
            'user_id' => 2,  // Giả sử người dùng có ID là 2 đã đăng bài
        ]);
    }
}

