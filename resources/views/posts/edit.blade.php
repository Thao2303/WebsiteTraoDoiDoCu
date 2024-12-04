@extends('layouts.admin')

@section('title', 'Sửa Bài Viết')

@section('content')
<div class="container">
    <h1 class="text-center">Sửa Bài Viết</h1>
    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Tiêu đề</label>
            <input type="text" name="title" class="form-control" value="{{ $post->title }}" required>
        </div>

        <div class="form-group">
            <label for="content">Nội dung</label>
            <textarea name="content" class="form-control" rows="6" required>{{ $post->content }}</textarea>
        </div>

        <div class="form-group">
            <label for="category_id">Danh mục</label>
            <select name="category_id" class="form-control" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $post->category_id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="product_id">Sản phẩm (Nếu có)</label>
            <select name="product_id" class="form-control">
                <option value="">Không chọn</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ $product->id == $post->product_id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="image">Ảnh</label>
            <input type="file" name="image" id="imageInput" class="form-control" onchange="previewImage(event)">

            <div class="image-preview mt-3">
    @if ($post->image)
        <p><strong>Ảnh hiện tại:</strong></p>
        <img src="{{ asset('storage/' . $post->image) }}" alt="Ảnh bài viết cũ" class="img-thumbnail" style="width: 150px;">
    @endif
    <img id="newImage" class="new-image mt-3 img-thumbnail d-none" style="width: 150px;" alt="Ảnh mới sẽ hiển thị ở đây">
</div>
        </div>

        <div class="form-group form-check">
            <input type="checkbox" name="status" value="1" class="form-check-input" {{ $post->status ? 'checked' : '' }}>
            <label class="form-check-label" for="status">Hiển thị</label>
        </div>

        <button type="submit" class="btn btn-primary w-100">Cập Nhật Bài Viết</button>
    </form>

    <a href="{{ route('posts.index') }}" class="btn btn-link mt-3 d-block text-center">Quay lại danh sách bài viết</a>
</div>

<script>
    function previewImage(event) {
        const output = document.getElementById('newImage');
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function() {
                output.src = reader.result;
                output.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
