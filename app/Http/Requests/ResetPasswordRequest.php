<?php

// namespace App\Http\Requests;

// use Illuminate\Foundation\Http\FormRequest;
// use Illuminate\Validation\Rules\Password as PasswordRule;

// class ResetPasswordRequest extends FormRequest
// {
//     /**
//      * Determine if the user is authorized to make this request.
//      */
//     public function authorize(): bool
//     {
//         return true;
//     }

//     /**
//      * Get the validation rules that apply to the request.
//      *
//      * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
//      */
//     public function rules(): array
//     {
//         return [
//             'token' => 'required',
//             'email' => 'required|email|exists:users,email',
//             'password' => ['required', 'confirmed', PasswordRule::min(8)],
//         ];
//     }
//     public function messages()
//     {
//         return [
//             'email.required' => 'Email bắt buộc',
//             'email.email' => 'Email không hợp lệ',
//             'email.exists' => 'Email không tồn tại',
//             'password.required' => 'Mật khẩu bắt buộc',
//             'password.confirmed' => 'Xác nhận mật khẩu không trùng khớp',
//             'password.min' => 'Mật khẩu phải ít nhất 8 ký tự',
//         ];
//     }
// }
