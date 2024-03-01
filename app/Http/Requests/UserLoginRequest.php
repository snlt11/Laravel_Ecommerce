<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone' => 'required|digits_between:7,11',
            'password' => 'required|min:8'
        ];
    }
    public function messages()
    {
        return [
            'phone.required' => 'Please enter a phone number',
            'phone.digits_between' => 'Number must be between 7 and 11 digits',
            'password.required' => 'Please enter a password',
            'password.min' => 'Password must be at least 8'
        ];
    }
}
