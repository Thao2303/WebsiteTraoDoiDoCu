@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Sửa Người Dùng</h2>
    <form action="{{ route('admin.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Tên Người Dùng</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>
        <div class="form-group">
            <label for="level">Vai Trò</label>
            <select name="level" class="form-control" required>
                <option value="admin" {{ $user->level == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ $user->level == 'user' ? 'selected' : '' }}>User</option>
            </select>
        </div>
        <div class="form-group">
            <label for="is_active">Kích Hoạt</label>
            <select name="is_active" class="form-control" required>
                <option value="1" {{ $user->is_active ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !$user->is_active ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        
        <!-- Thêm trường nhập mật khẩu -->
        <div class="form-group">
            <label for="password">Mật Khẩu Mới (Nếu có)</label>
            <input type="password" name="password" class="form-control">
        </div>
        
        <button type="submit" class="btn btn-primary">Cập Nhật Người Dùng</button>
    </form>
</div>
@endsection
