@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Danh Sách Người Dùng</h2>
    <a href="{{ route('admin.create') }}" class="btn btn-primary">Thêm Người Dùng</a>
    
    <!-- Hiển thị thông báo thành công hoặc thất bại -->
    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Vai Trò</th>
                <th>Trạng Thái</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <!-- Hiển thị vai trò dựa trên giá trị của trường level -->
                <td>{{ $user->level == '1' ? 'Admin' : 'User' }}</td>
                <td>{{ $user->is_active ? 'Active' : 'Inactive' }}</td>
                <td>
                    <a href="{{ route('admin.edit', $user->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('admin.toggleActive', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-danger btn-sm">
                            {{ $user->is_active ? 'Khóa' : 'Mở Khóa' }}
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
