<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Message;
class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
        'created_at',
        'updated_at',
    ];
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
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

