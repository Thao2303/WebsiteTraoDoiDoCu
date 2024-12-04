<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'category_id', 'stock', 'status'];

    // Mối quan hệ với danh mục
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    // Mô hình Post
// Mô hình Post
public function posts()
{
    return $this->belongsToMany(Post::class, 'post_product');
}




}
