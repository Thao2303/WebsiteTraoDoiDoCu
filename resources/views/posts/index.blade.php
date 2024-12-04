@extends('layouts.admin')

@section('title', 'Danh Sách Bài Viết')

@section('content')
<div class="container">
    <style>
        /* CSS được tích hợp trực tiếp */
        .image-cell {
            width: 120px;
            height: 120px; /* Chiều cao cố định */
            vertical-align: middle; /* Căn giữa nội dung */
        }

        .image-cell img {
            max-width: 100%; /* Đảm bảo ảnh vừa khung */
            max-height: 100%; /* Không vượt quá chiều cao */
            border-radius: 5px; /* Bo góc */
        }
    </style>

    <h1 class="text-center my-4">Danh Sách Bài Viết</h1>

    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Thêm Bài Viết Mới</a>

    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Danh mục</th>
                    <th>Sản phẩm</th>
                    <th>Trạng thái</th>
                    <th class="image-cell">Ảnh</th> <!-- Đặt lớp đặc biệt cho cột -->
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->category->name }}</td>
                    <td>
                        @if ($post->products->isNotEmpty())
                            <ul class="list-unstyled mb-0">
                                @foreach ($post->products as $product)
                                    <li>{{ $product->name }}</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-muted">Không có sản phẩm</span>
                        @endif
                    </td>
                    <td class="text-{{ $post->status ? 'success' : 'danger' }}">
                        {{ $post->status ? 'Hiển thị' : 'Ẩn' }}
                    </td>
                    <td class="image-cell">
                        @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Ảnh bài viết" class="img-thumbnail">

                        @else
                            <span class="text-muted">Chưa có ảnh</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Chưa có bài viết nào.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
</div>
@endsection
