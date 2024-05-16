<?php

namespace App\Services\Auth;

use App\DTO\Auth\TokenDto;
use App\DTO\Auth\UserDto;
use App\Services\Accounts\AccountApiService;
use App\Services\ApiProxy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthApiService extends ApiProxy
{
    public function __construct(
        private AccountApiService $accountApiService
    )
    {
        parent::__construct(config('microservices.users_auth.base_uri'));
    }

    public function register(array $data): UserDto
    {
        $account = $this->accountApiService->search([
            'filter' => [
                'username' => $data['username']
            ]
        ]);

        if (count($account->getData()) > 0) {
            throw ValidationException::withMessages([
                'username' => 'Username уже занято'
            ]);
        }

        return new UserDto($this->postJson('auth/register', $data)->getData());
    }

    public function login(array $data): TokenDto
    {
        return new TokenDto($this->postJson('auth/login', $data)->getData());
    }

    public function currentUser(string $token): UserDto
    {
        $user = new UserDto($this->getWithToken('auth/current', $token)->getData());

        $account = $this->accountApiService->getAccountByAuthId($user->id);
        $user->account = $account;

        return $user;
    }
}
