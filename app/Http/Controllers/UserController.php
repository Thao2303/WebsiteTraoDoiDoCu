<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Hiển thị danh sách người dùng
    public function index()
    {
        $users = User::all();
        return view('admin.index', compact('users'));
    }

    // Hiển thị form thêm người dùng
    public function create()
    {
        return view('admin.create');
    }

    // Lưu người dùng mới
    public function store(Request $request)
    {
        $level = $request->level == 'admin' ? 1 : 2;
        // Kiểm tra đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'level' => 'required|string|in:admin,user', // Kiểm tra level là 'admin' hoặc 'user'
            'is_active' => 'required|boolean',
        ]);
    
        // Tạo người dùng mới
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'level' => $request->level == 'admin' ? 1 : 2,  // Admin là 1, User là 2
            'is_active' => (bool) $request->is_active,
        ]);
        
    
        return redirect()->route('admin.index')->with('success', 'User created successfully.');
    }
    
    



    
    

    // Hiển thị form sửa người dùng
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit', compact('user'));
    }

    // Cập nhật thông tin người dùng
    public function update(Request $request, $id)
    {
  
        $user = User::findOrFail($id);

        // Kiểm tra và chuyển đổi giá trị level
        $level = $request->level == 'admin' ? 1 : 2;
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id, // Email phải duy nhất, trừ người dùng hiện tại
            'level' => 'required|string|in:admin,user', // Kiểm tra level là 'admin' hoặc 'user'
            'is_active' => 'required|boolean', // Không kiểm tra role nữa
        ]);
    
        // Cập nhật thông tin người dùng
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'level' => $request->level == 'admin' ? 1 : 2,  // Admin là 1, User là 2
            'is_active' => $request->is_active,
        ]);
    
        return redirect()->route('admin.index')->with('success', 'User updated successfully.');
    }
    
    

    // Kích hoạt hoặc vô hiệu hóa người dùng
    public function toggleActive($id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_active' => !$user->is_active]);

        return redirect()->route('admin.index')->with('success', 'User status updated.');
    }

    // Xóa người dùng
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.index')->with('success', 'User deleted successfully.');
    }
}
