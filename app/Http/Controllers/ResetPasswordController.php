<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password as PasswordRule;

class ResetPasswordController extends Controller
{
    public function showResetForm($token)
    {
        // Truyền token vào view để form biết token nào đang reset
        return view('auth.passwords.reset-password', ['myToken' => $token]);
    
    }

    public function resetPassword(Request $request)
    {
        // 1. Validate dữ liệu từ form
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => ['required', 'confirmed', PasswordRule::min(8)],
        ], [
            'email.required' => 'Email bắt buộc',
            'email.email' => 'Email không hợp lệ',
            'email.exists' => 'Email không tồn tại',
            'password.required' => 'Mật khẩu bắt buộc',
            'password.confirmed' => 'Xác nhận mật khẩu không trùng khớp',
            'password.min' => 'Mật khẩu phải ít nhất 8 ký tự',
        ]);

        // 2. Gọi Password::reset để cập nhật mật khẩu
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
