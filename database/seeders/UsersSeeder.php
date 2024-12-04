<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Nguyễn Văn A',
            'email' => 'nguyenvana@example.com',
            'password' => bcrypt('password123'), // Mã hóa mật khẩu bằng bcrypt
            'level' => 1,  // Admin
            'profile_pic' => 'path_to_image', // Đường dẫn tới ảnh đại diện (nếu có)
            'is_active' => 1, // Người dùng này được kích hoạt
        ]);

        User::create([
            'name' => 'Trần Thị B',
            'email' => 'tranthib@example.com',
            'password' => bcrypt('password456'),
            'level' => 2,  // User thường
            'profile_pic' => 'path_to_image_b',
            'is_active' => 1,
        ]);

        User::create([
            'name' => 'Lê Quang C',
            'email' => 'lequangc@example.com',
            'password' => bcrypt('password789'),
            'level' => 2,  // User thường
            'profile_pic' => 'path_to_image_c',
            'is_active' => 0, // Người dùng này chưa được kích hoạt
        ]);
    }
}
