<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {   
        /** @var Guard $auth */
        $auth = Auth::getFacadeRoot();
        
        if (!$auth->check() || $auth->user()->role !== 'admin') { // nếu người dùng chưa đăng nhập || hoặc người dùng đã đăng nhập nhưng không phải role admin
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }
        return $next($request);
    }
}