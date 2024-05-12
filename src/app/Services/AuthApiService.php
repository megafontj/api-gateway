<?php

namespace App\Services;

use App\DTO\UserDto;

class AuthApiService extends ApiProxy
{
    public function __construct()
    {
        parent::__construct(config('microservices.users_auth.base_uri'));
    }

    public function register(array $data): UserDto
    {
        return new UserDto($this->postJson('auth/register', $data)->getData());
    }
}
