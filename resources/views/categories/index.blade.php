@extends('layouts.admin')

@section('title', 'Danh Sách Danh Mục')

@section('content')
    <div class="container">
        <h1 class="text-center">Danh Sách Danh Mục</h1>
        
        <div class="ttext-center my-4">
            <a href="{{ route('categories.create') }}" class="btn btn-primary">Thêm Danh Mục Mới</a>
        </div>

        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Mô tả</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td class="d-flex justify-content-center">
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary mx-1">Sửa</a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mx-1">Xóa</button>
                        </fdarkorm> 
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('admin.index') }}" class="btn btn-link">Quay lại trang quản lý</a>
    </div>
@endsection
