<?php

namespace App\DTO\UsersAuth;

use App\DTO\DtoMapper;

class UserDto extends DtoMapper
{
    public int $id;

    public string $name;

    public string $email;

    public ?string $created_at = null;

    public ?string $updated_at = null;

    public function __construct(array $data)
    {
        parent::__construct($data);
    }
}
