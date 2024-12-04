<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'status'];

    // Mối quan hệ với sản phẩm
    public function products()
    {
        return $this->hasMany(Product::class);
    }
 

    public function showProducts(Category $category)
    {
        // Lấy tất cả các sản phẩm thuộc danh mục này
        $products = $category->products;

        // Trả về view hiển thị sản phẩm của danh mục
        return view('categories.showProducts', compact('category', 'products'));
    }
}

