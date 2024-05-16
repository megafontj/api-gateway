<?php

namespace App\Http\Requests\Tweets;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @mixin Tweet
 */
class CreateTweetRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     */
    public function rules(): array
    {
        return [
            'content' => ['required', 'max:500', 'string'],
        ];
    }
}
