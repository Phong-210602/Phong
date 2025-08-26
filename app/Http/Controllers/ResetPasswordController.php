<?php

namespace App\Http\Controllers;

use App\Http\Requests\Password\ResetPasswordRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function showResetForm($token)
    {
        // Truyền token vào view để form biết token nào đang reset
        return view('auth.passwords.reset-password', ['myToken' => $token]);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        // 3. Kiểm tra kết quả và redirect
        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', 'Mật khẩu đã được đặt lại thành công!');
        } else {
            return back()->withErrors(['email' => __($status)]);
        }
    }
}
