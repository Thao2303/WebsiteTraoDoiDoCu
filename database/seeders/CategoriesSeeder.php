<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category; 

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'Electronics', 'description' => 'Electronic products', 'status' => 1],
            ['name' => 'Furniture', 'description' => 'Furniture products', 'status' => 1],
            ['name' => 'Clothing', 'description' => 'Clothing products', 'status' => 1],
        ]);
    }
}
