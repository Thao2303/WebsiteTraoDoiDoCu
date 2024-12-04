<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class PostProductSeeder extends Seeder
{
    public function run()
    {
        DB::table('post_product')->insert([
            'post_id' => 1,  // ID của bài viết
            'product_id' => 1,  // Nếu có trường degflag trong bảng trung gian
        ]);

        DB::table('post_product')->insert([
            'post_id' => 1,
            'product_id' => 2,
        ]);

        DB::table('post_product')->insert([
            'post_id' => 2,
            'product_id' => 3,
        
        ]);
    }
}
