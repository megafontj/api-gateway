<?php

namespace App\Http\Requests\Accounts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FollowOrUnfollowRequest extends FormRequest
{
    public function rules()
    {
        return [
            'user_id' => ['required', 'integer']
        ];
    }

    public function getUserId(): int
    {
        return $this->validated()['user_id'];
    }

}
