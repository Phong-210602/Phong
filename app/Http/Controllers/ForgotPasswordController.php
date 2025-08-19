<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use Illuminate\Http\Request;
// use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Password;
// use 'App\Http\Controllers\toastr

class ForgotPasswordController extends Controller
{  
    public function showForgotPasswordForm()
    {   
        return view('auth.forgot-password');
    }
    public function sendResetLink(Request $request)
    {
       
            // return view('test');
            $status = Password::sendResetLink($request->only('email'));
            // dd(123);
             if ($status === Password::RESET_LINK_SENT){
                // dd(123);
               return back()->with('status', 'Mật khẩu đã được gửi lên email của bạn');
            }

    }

    
}
