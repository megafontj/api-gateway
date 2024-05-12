<?php

namespace App\DTO;

class UserDto extends DtoMapper
{
    public string $name;

    public string $email;

    public ?string $created_at = null;

    public ?string $updated_at = null;

    public function __construct(array $data)
    {
        parent::__construct($data);
    }
}
