<?php

namespace App\Http\Requests\Accounts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateAccountRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => ['required', 'min:3', 'max:20'],
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'auth_id' => ['required'],
        ];
    }
}
