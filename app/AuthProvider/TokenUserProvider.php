<?php

namespace App\AuthProvider;

use App\DTO\Auth\UserDto;
use App\Services\Auth\AuthApiService;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

/**
 * @see https://laravel.com/docs/11.x/authentication#adding-custom-user-providers
 */
class TokenUserProvider implements UserProvider
{
    public function __construct(
        private AuthApiService $authApiService
    )
    {
    }

    public function retrieveById($identifier)
    {
        return null;
    }

    public function retrieveByToken($identifier, $token)
    {
        return null;
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        return null;
    }

    public function retrieveByCredentials(array $credentials)
    {
        $token = $credentials['api_token'] ?? null;

        if (! $token) {
            return null;
        }

        $userDto = $this->authApiService->currentUser($token);
        return $this->fillAuthUser($userDto);
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return null;
    }

    public function rehashPasswordIfRequired(Authenticatable $user, array $credentials, bool $force = false)
    {
        return null;
    }

    private function fillAuthUser(UserDto $user): User
    {
        return new User(
            $user->id,
            $user->email,
            $user->account,
            $user->created_at,
            $user->updated_at
        );
    }
}
