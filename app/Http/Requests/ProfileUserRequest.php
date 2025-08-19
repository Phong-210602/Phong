<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:30',
            'last_name'  => 'required|string|max:20',
            'address'    => 'required|string|max:200',
        ];
    }
    public function messages(): array
    {
        return [
            'first_name.required' => 'Họ là bắt buộc',
            'first_name.max'      => 'Họ không được vượt quá 30 ký tự',
            'last_name.required' => 'Tên là bắt buộc',
            'last_name.max'      => 'Họ không được vượt quá 20 ký tự',
            'address.required' => 'Địa chỉ là bắt buộc',
            'address.max'      => 'Địa chỉ không được vượt quá 200 ký tự',
        ];
    }
}
