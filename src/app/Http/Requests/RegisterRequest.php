<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', ],
            'password' => ['required', 'confirmed'],
            'password_confirmation' => ['required']
        ];
    }
}
