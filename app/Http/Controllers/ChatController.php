<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use App\Models\Message;  // Đảm bảo rằng lớp Message đã được khai báo ở đây

class ChatController extends Controller
{
   // ChatController.php
public function sendMessage(Request $request)
{
    $validated = $request->validate([
        'receiver_id' => 'required|exists:users,id',
        'message' => 'required|string',
    ]);

    // Lưu tin nhắn vào database
    $message = Message::create([
        'sender_id' => auth()->id(),
        'receiver_id' => $validated['receiver_id'],
        'message' => $validated['message'],
    ]);

    // Trả về tin nhắn vừa gửi
    return response()->json(['message' => $message]);
}




public function searchUsers(Request $request)
{
    $searchTerm = $request->get('search');
    $users = User::where('name', 'LIKE', "%$searchTerm%")->get();

    return response()->json(['users' => $users]);
}

// ChatController.php
public function showChat()
{
    return view('chat'); // Hoặc nếu có truyền dữ liệu gì đó thì truyền vào
}


}
