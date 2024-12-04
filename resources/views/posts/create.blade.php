@extends('layouts.admin')

@section('title', 'Thêm Mới Bài Viết')

@section('content')
<div class="container">
    <h1 class="text-center">Thêm Mới Bài Viết</h1>
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
        @csrf
        <div class="form-group">
            <label for="title">Tiêu đề</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="content">Nội dung</label>
            <textarea name="content" class="form-control" rows="6" required></textarea>
        </div>

        <div class="form-group">
            <label for="category_id">Danh mục</label>
            <select name="category_id" class="form-control" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="product_id">Sản phẩm (Nếu có)</label>
            <select name="product_id" class="form-control">
                <option value="">Không chọn</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="image">Ảnh</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="form-group form-check">
            <input type="checkbox" name="status" value="1" class="form-check-input" checked>
            <label class="form-check-label" for="status">Hiển thị</label>
        </div>

        <button type="submit" class="btn btn-primary w-100">Thêm Bài Viết</button>
    </form>
</div>
@endsection
