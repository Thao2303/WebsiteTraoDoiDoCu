<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route mặc định cho trang chủ, nếu cần thiết


// routes/web.php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return redirect()->route('categories.index'); // Redirect đến trang danh sách danh mục
});

// Các route resource
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('posts', PostController::class); 

// Đảm bảo có route cho posts
use App\Http\Controllers\UserController;

Route::prefix('admin')->group(function () {
    // Route chính cho admin (admin.index)
    Route::get('/', [UserController::class, 'index'])->name('admin.index');

    // Các route khác
    Route::get('create', [UserController::class, 'create'])->name('admin.create');
    Route::post('store', [UserController::class, 'store'])->name('admin.store');
    Route::get('edit/{user}', [UserController::class, 'edit'])->name('admin.edit');
    Route::put('update/{user}', [UserController::class, 'update'])->name('admin.update');
 

Route::patch('admin/toggle-active/{user}', [UserController::class, 'toggleActive'])->name('admin.toggleActive');

});





 



