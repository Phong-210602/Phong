<?php

namespace  App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

/**
 * class LoginRequest
 * 
 * Mục đích: Xử lý VALIDATION cho form đăng nhập
 * - Kiểm tra dữ liệu đầu vào có đúng format không
 * - Không chứa Logic xử lý nghiệp vụ
 * @property string $email
 * @property string $password
 */
class LoginRequest extends FormRequest
{
    /**
     * Xác định xem request có được phép thực hiện không 
     * Trả về true = cho phép tất cả
     */
    public function authorize(): bool
    {
        return true;
    }
    /**
     * Định nghĩa các quy tắc validation
     * Đây là VALIDATION - chỉ kiểm tra format dữ liệu
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password'   => [
                'required',
                Password::min(8)->mixedCase()->symbols(),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email là bắt buộc',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu là bắt buộc',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'password.mixedCase' => 'Mật khẩu phải có cả chữ hoa và chữ thường',
            'password.symbols'   => 'Mật khẩu phải chứa ít nhất 1 ký tự đặc biệt',
        ];
    }
}
