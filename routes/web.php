<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Route tìm kiếm người dùng (trả về dữ liệu JSON)
Route::get('/search-users', [ChatController::class, 'searchUsers']);  // Tìm kiếm người dùng
Route::get('/search_chat', [ChatController::class, 'searchUsers']);
// Route cho trang chat (hiển thị view)
Route::get('/chat', [ChatController::class, 'showChat'])->name('chat.show');
// Routes cho tin nhắn (đã có middleware auth)
Route::middleware('auth')->group(function () {
    Route::post('/send-message', [MessageController::class, 'sendMessage']);
    Route::get('/get-messages', [MessageController::class, 'getMessages']);
});

// Định nghĩa route lấy tin nhắn
Route::get('/messages', [MessageController::class, 'getMessages']);
Route::get('/api/messages', [MessageController::class, 'getMessages']);

