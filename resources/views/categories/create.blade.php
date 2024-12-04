@extends('layouts.admin')

@section('title', 'Thêm Danh Mục')

@section('content')
    <div class="container">
        <h1>Thêm Danh Mục Mới</h1>

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Tên danh mục:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Mô tả:</label>
                <textarea id="description" name="description" class="form-control" rows="4"></textarea>
            </div>

            <button type="submit">Thêm Mới</button>
        </form>
    </div>
@endsection
