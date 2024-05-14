<?php

namespace App\Http\Resources;

use App\DTO\Auth\UserDto;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin UserDto
 */
class AuthResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'email' => $this->email,
            'account' => new AccountResource($this->account),
            'create_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
