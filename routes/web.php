<?php

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PostController;

// Routes không cần kiểm tra trạng thái
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Routes cần kiểm tra trạng thái tài khoản
Route::middleware(['auth',  \App\Http\Middleware\CheckUserStatus::class])->group(function () {
    Route::get('/', [ClientController::class, 'index']);
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
});

Route::middleware(['auth', \App\Http\Middleware\CheckUserStatus::class])->group(function(){
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
});


// Sử dụng method logout từ LoginController thay vì closure
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Xóa dòng này vì không sử dụng package có sẵn
// Auth::routes();