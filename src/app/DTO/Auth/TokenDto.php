<?php

namespace App\DTO\Auth;

use App\DTO\DtoMapper;

class TokenDto extends DtoMapper
{
    public ?string $token;

    public function __construct(array $data)
    {
        parent::__construct($data);
    }
}
