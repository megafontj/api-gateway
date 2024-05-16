<?php

namespace App\Http\Resources;

use App\DTO\Auth\TokenDto;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin TokenDto
 */
class TokenResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'token' => $this->token
        ];
    }
}
