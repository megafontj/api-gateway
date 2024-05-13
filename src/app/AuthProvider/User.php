<?php

namespace App\AuthProvider;

use Illuminate\Contracts\Auth\Authenticatable;

class User implements Authenticatable
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public ?string $created_at,
        public ?string $updated_at
    )
    {
    }

    public function getAuthIdentifierName()
    {
        return $this->email;
    }

    public function getAuthIdentifier()
    {
        return $this->id;
    }

    public function getAuthPasswordName()
    {
    }

    public function getAuthPassword()
    {
        return '';
    }

    public function getRememberToken()
    {
    }

    public function setRememberToken($value)
    {
    }

    public function getRememberTokenName()
    {
    }
}
