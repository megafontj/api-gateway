<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'username' => ['required', 'string'],
            'name' => ['required', 'string'],
            'password' => ['required', 'confirmed'],
            'password_confirmation' => ['required']
        ];
    }
}
