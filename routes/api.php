<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/send-message', [ChatController::class, 'sendMessage']);
Route::middleware('auth')->get('/chat', [ChatController::class, 'showChat'])->name('chat');

Route::get('/search-users', [ChatController::class, 'searchUsers']);
Route::get('/chat-history/{receiverId}', [ChatController::class, 'chatHistory']);
// api.php (dành cho API)
Route::middleware('auth:api')->get('/messages', [MessageController::class, 'getMessages']);  // Lấy tin nhắn
