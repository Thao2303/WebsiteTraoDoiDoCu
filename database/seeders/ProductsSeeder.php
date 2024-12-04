<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product; // Đảm bảo bạn đã tạo model Product

class ProductsSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Sản phẩm 1',
            'description' => 'Mô tả sản phẩm 1',
            'price' => 100000
            
        ]);

        Product::create([
            'name' => 'Sản phẩm 2',
            'description' => 'Mô tả sản phẩm 2',
            'price' => 200000
        ]);

        Product::create([
            'name' => 'Sản phẩm 3',
            'description' => 'Mô tả sản phẩm 3',
            'price' => 300000
        ]);
    }
}

