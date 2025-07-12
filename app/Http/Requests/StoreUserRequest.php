<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            // 'first_name' => 'required|string|max:255',
            // 'last_name'  => 'required|string|max:255',
            // 'email'      => 'required|email|unique:users,email',
            // 'password'   => 'required|min:6|confirmed',
            // 'address'    => 'nullable|string|max:255',
            // 'status'     => 'nullable|in:active,inactive',
            // 'role'       => 'nullable|string|max:50',
            'first_name' => 'required|string|max:30',
            'last_name'  => 'required|string|max:30',
            'address'    => 'nullable|string|max:255',
            'status'     => 'nullable|in:active,inactive',
            'role'       => 'nullable|string|max:50',
            'email'      => [
                'required',
                'string',
                'max:100',
                'unique:users,email',
            ],
            'password'   => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
            ],
            'status'     => 'required|in:0,1,2,3',
        ];
        
    }
}
