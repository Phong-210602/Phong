<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ServiceAttributeController;    
use App\Http\Controllers\VerifyController;

// Routes không cần kiểm tra trạng thái
// Route::get('/', function(){
//     return view ('test');
// });
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('logins');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('registers');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// quên mật khẩu
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
// đặt lại mật khẩu
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');


Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
// Route::resource('/profile', ProfileController::class)->only(['edit', 'update']);

// Routes cần kiểm tra trạng thái tài khoản
Route::middleware('auth', 'admin')->group(function () {
    Route::get('/', [ClientController::class, 'index']);
    // Route::get('/users', [UserController::class, 'index'])->name('users.index');
    // Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::resource('users', UserController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::patch('/users/{id}/approve', [UserController::class, 'approve'])->name('users.approve'); // phê duyệt
    Route::patch('/users/{id}/reject', [UserController::class, 'reject'])->name('users.reject'); // từ chối
    Route::patch('users{id}/block', [UserController::class, 'block'])->name('users.block'); // bị khoá
});
// Quản lý bài viết
Route::middleware('auth')->group(function(){
    Route::resource('posts', PostController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy', 'show']);
    // Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    // Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    // Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    // Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    // Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    // Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    // Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::delete('/user/posts/delete-all', [PostController::class, 'destroyAll'])->name('posts.destroyAll');
});
Route::get('/news', [PostController::class, 'news'])->name('news.index');
Route::get('/news/{post:slug}', [PostController::class, 'newsShow'])->name('news.show');
