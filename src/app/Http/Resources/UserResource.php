<?php

namespace App\Http\Resources;

use App\DTO\UserDto;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin UserDto
 */
class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'create_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
