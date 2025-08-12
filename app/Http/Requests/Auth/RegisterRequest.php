<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

/**
 * class RegisterRequest
 * 
 * Mục đích: Xử lý VALIDATION cho form đăng ký
 * - kiểm tra dữ liệu đầu vào có đúng format không
 * - không chứa logic xử lý nghiệp vụ
 */
class RegisterRequest extends FormRequest
{
    /**
     * Xác định xem request có được phép thực hiện không
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Định nghĩa các quy tắc validation
     * Đây là VALIDATION - chỉ kiểm tra dữ liệu format dữ liệu
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',                      // Họ: bắt buộc, string,tối đa 255 ký tự
            'last_name' => 'required|string|max:255',                        // Tên: bắt buộc, string, tối đa 255 ký tự
            'email' => 'required|string|email|max:255|unique:users,email', // email: bắt buộc, đúng format, không trùng
            'password'   => [
                'required',
                Password::min(8)->mixedCase()->symbols(), // password: bắt buộc, ít nhất 8 ký tự, hoa, thường, ký tự đặc biệt
            ],
            'address' => 'nullable|string|max:500',                         // Địa chỉ: có thể để trống, tối đa 500 ký tự
        ];
    }

    /**
     * Thông báo lỗi validation bằng tiếng Việt
     */
    public function messages(): array
    {
        return [
            'first_name.required' => 'Họ là bắt buộc',
            'last_name.required' => 'Tên là bắt buộc',
            'email.required' => 'Email là bắt buộc',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã được sử dụng',
            'password.required' => 'Mật khẩu là bắt buộc',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp',
            'password.mixedCase' => 'Mật khẩu phải có cả chữ hoa và chữ thường',
            'password.symbols'   => 'Mật khẩu phải chứa ít nhất 1 ký tự đặc biệt',
        ];
    }
}
