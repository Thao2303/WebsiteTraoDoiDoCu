@extends('layouts.master')

@section('title')
    User Management
@endsection

@section('content')
    @if (isset($message))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif
    
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <table class="table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Type</th>
                <th>Remember Token</th>
                <th>Create Time</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>

            @foreach ($data as $user)

            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->password }}</td>
                <td>{{ $user->type }}</td>
                <td>{{ $user->remember_token }}</td>
                <td>{{ $user->created_at }}</td>
                <td>
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-warning mt-3">Sửa</a>
                </td>
                <td>
                    <form action="{{ route('users.destroy', $user) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Mày có chắc không?')" class="btn btn-danger mt-3">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>

    <!-- {{ $data->links() }} -->
    <div class="text-center mt-4">
        {{ $data->links('pagination::bootstrap-4') }}
    </div>
@endsection