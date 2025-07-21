<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckUserStatus;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Đăng ký alias cho middleware
        $middleware->alias([
            'check.user.status' => CheckUserStatus::class,
        ]);
        
        // Hoặc đăng ký middleware global (chạy cho tất cả requests)
        // $middleware->append(CheckUserStatus::class);
        
        // Hoặc đăng ký middleware cho web routes
        // $middleware->web(append: [
        //     CheckUserStatus::class,
        // ]);
        
        // Hoặc đăng ký middleware cho API routes
        // $middleware->api(append: [
        //     CheckUserStatus::class,
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();