<?php

namespace App\Services\UsersAuth;

use App\DTO\UsersAuth\TokenDto;
use App\DTO\UsersAuth\UserDto;
use App\Services\ApiProxy;

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

    public function login(array $data): TokenDto
    {
        return new TokenDto($this->postJson('auth/login', $data)->getData());
    }

    public function currentUser(string $token): UserDto
    {
        return new UserDto($this->getWithToken('auth/current', $token)->getData());
    }
}
