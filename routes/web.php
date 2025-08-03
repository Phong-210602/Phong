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
// Route::get('/', function(){
//     return view ('test');
// });
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('dangnhap');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Routes cần kiểm tra trạng thái tài khoản
Route::middleware(['auth',  'check.user.status'])->group(function () {
    Route::get('/', [ClientController::class, 'index']);
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');

    Route::middleware(['auth', 'admin'])->group(function () {
    Route::patch('/users/{id}/approve', [UserController::class, 'approve'])->name('users.approve');
    Route::patch('/users/{id}/reject', [UserController::class, 'reject'])->name('users.reject');
    Route::patch('users{id}/block', [UserController::class, 'block'])->name('users.block');
});

    
});

// Quản lý bài viết
Route::middleware(['auth', 'check.user.status'])->group(function(){
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

