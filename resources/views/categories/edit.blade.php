@extends('layouts.admin')

@section('title', 'Sửa Danh Mục')

@section('content')
    <div class="container">
        <h1 class="text-center">Sửa Danh Mục</h1>

        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Tên danh mục:</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $category->name }}" required>
            </div>

            <div class="form-group">
                <label for="description">Mô tả:</label>
                <textarea id="description" name="description" class="form-control" rows="4">{{ $category->description }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Cập Nhật</button>
        </form>

        <div class="back-link text-center mt-3">
            <a href="{{ route('categories.index') }}" class="btn btn-link">Quay lại danh sách danh mục</a>
        </div>
    </div>
@endsection
