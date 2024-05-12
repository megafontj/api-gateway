<?php

namespace App\DTO;

class TokenDto extends DtoMapper
{
    public ?string $token;

    public function __construct(array $data)
    {
        parent::__construct($data);
    }
}
