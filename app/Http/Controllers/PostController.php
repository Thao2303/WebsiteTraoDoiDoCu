<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['category', 'products'])->paginate(10); // Phân trang 10 bài viết
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $products = Product::all();
        return view('posts.create', compact('categories', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'product_ids' => 'nullable|array',
            'product_ids.*' => 'exists:products,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
    
        $data = $request->only(['title', 'content', 'category_id', 'status']);
    
        // Đặt giá trị mặc định cho user_id, nếu không sử dụng đăng nhập
        $data['user_id'] = 1; // Hoặc một giá trị cố định nếu không có hệ thống người dùng
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;
        }
    
        $post = Post::create($data);
    
        // Liên kết các sản phẩm với bài viết nếu có
        if ($request->has('product_ids')) {
            $post->products()->attach($request->input('product_ids'));
        }
    
        return redirect()->route('posts.index')->with('success', 'Bài viết đã được thêm thành công');
    }
    
    


    public function edit($id)
    {
        $post = Post::with('products')->findOrFail($id);
        $categories = Category::all();
        $products = Product::all();
        return view('posts.edit', compact('post', 'categories', 'products'));
    }

    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu yêu cầu
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'product_ids' => 'nullable|array', // Thêm sản phẩm nếu có
            'product_ids.*' => 'exists:products,id', // Kiểm tra từng sản phẩm có tồn tại không
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Kiểm tra ảnh nếu có
        ]);
    
        $post = Post::findOrFail($id); // Lấy bài viết theo ID
    
        // Kiểm tra nếu người dùng hiện tại có quyền sửa bài viết
        if ($post->user_id !== auth()->id()) {
            return redirect()->route('posts.index')->with('error', 'Bạn không có quyền sửa bài viết này');
        }
    
        // Chỉ lấy dữ liệu cần thiết để cập nhật
        $data = $request->only(['title', 'content', 'category_id', 'status']);
    
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($post->image && \Storage::exists('public/' . $post->image)) {
                \Storage::delete('public/' . $post->image);
            }
        
            // Lưu ảnh mới
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;  // Cập nhật ảnh mới vào dữ liệu
        }
        
    
        // Cập nhật bài viết
        $post->update($data);
    
        // Nếu có sản phẩm được chọn, đồng bộ chúng với bài viết
        if ($request->has('product_ids')) {
            $post->products()->sync($request->input('product_ids'));
        }
    
        return redirect()->route('posts.index')->with('success', 'Bài viết đã được cập nhật');
    }
    

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->image) {
            \Storage::delete('public/' . $post->image);
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Bài viết đã bị xóa');
    }
}
