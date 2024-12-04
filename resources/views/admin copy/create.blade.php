@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Thêm Người Dùng</h2>
    <form action="{{ route('admin.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Tên Người Dùng</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
            <label for="password">Mật Khẩu</label>
            <input type="password" name="password" class="form-control" required>
            @error('password') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
            <label for="password_confirmation">Xác Nhận Mật Khẩu</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="level">Vai Trò</label>
            <select name="level" class="form-control" required>
                <option value="admin" {{ old('level') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ old('level') == 'user' ? 'selected' : '' }}>User</option>
            </select>
            @error('level') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
            <label for="is_active">Kích Hoạt</label>
            <select name="is_active" class="form-control" required>
                <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Thêm Người Dùng</button>
    </form>
</div>
@endsection
