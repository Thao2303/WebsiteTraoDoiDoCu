<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'category_id',
        'user_id',
        'image',
        'status',
    ];
    

    // Quan hệ với Category (một bài viết thuộc về một danh mục)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Quan hệ với Product (một bài viết có thể có nhiều sản phẩm)
   // Mô hình Product
   public function products()
{
    return $this->belongsToMany(Product::class, 'post_product');
}
   

}
