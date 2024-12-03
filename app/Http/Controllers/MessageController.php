<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
class MessageController extends Controller
{

    public function getMessages(Request $request)
    {
        $receiverId = $request->query('receiver_id');
        
        if (!$receiverId) {
            return response()->json(['message' => 'Receiver ID is required'], 400);
        }

        // Giả sử bạn có model Message, lấy tin nhắn từ cơ sở dữ liệu
        $messages = Message::where('receiver_id', $receiverId)
                           ->orWhere('sender_id', $receiverId)
                           ->get();

        return response()->json($messages);
    }
    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $validated['receiver_id'],
            'message' => $validated['message'],
        ]);

        return response()->json(['message' => $message], 201);
    }


}