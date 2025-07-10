<?php

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ClientController;


Route::get('/', [ClientController::class, 'index']);

Route::get('/hello', function(){
    return view ('hello', ['name' => "lò vi sóng"]);
})->name ('hello');