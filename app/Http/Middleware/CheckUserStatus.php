<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserStatus;

class CheckUserStatus
{
    public function handle($request, Closure $next)
    {   
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        switch ($user->status) {
            case UserStatus::PENDING:
                Auth::logout();
                return redirect()->route('login')->withErrors(['Tài khoản của bạn đang chờ phê duyệtssssss.']);
            case UserStatus::REJECTED:
                Auth::logout();
                return redirect()->route('login')->withErrors(['Tài khoản của bạn đã bị từ chối.']);
            case UserStatus::BLOCKED:
                Auth::logout();
                return redirect()->route('login')->withErrors(['Tài khoản của bạn đã bị khoá.']);
            case UserStatus::APPROVED:
                return $next($request);
            default:
                Auth::logout();
                return redirect()->route('login')->withErrors(['Trạng thái tài khoản không hợp lệ.']);
        }
    }
}
