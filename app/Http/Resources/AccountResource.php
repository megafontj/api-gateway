<?php

namespace App\Http\Resources;

use App\DTO\Accounts\AccountDto;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin AccountDto
 */
class AccountResource extends JsonResource
{
    /**
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            'username' => $this->username,
            'name' => $this->name,
            'email' => $this->email,
            'followers_count' => $this->whenNotNull($this->followers_count),
            'following_count' => $this->whenNotNull($this->following_count),
            'followers' => $this->whenNotNull($this->followers),
            'following' => $this->whenNotNull($this->following),
            'created_at' => $this->whenNotNull($this->created_at),
            'updated_at' => $this->whenNotNull($this->updated_at),
        ];
    }
}
