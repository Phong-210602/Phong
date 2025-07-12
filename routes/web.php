<?php

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', [ClientController::class, 'index']);
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users', [UserController::class, 'store'])->name('store.users');
// Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
// Route::get('/hello', [HelloController::class, 'show']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register',[RegisterController::class, 'register']);
