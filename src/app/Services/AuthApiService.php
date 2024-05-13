<?php

namespace App\Services;

use App\DTO\TokenDto;
use App\DTO\UserDto;
use App\AuthProvider\User;

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
