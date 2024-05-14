<?php

namespace App\DTO\Auth;

use App\DTO\Accounts\AccountDto;
use App\DTO\DtoMapper;

class UserDto extends DtoMapper
{
    public int $id;

    public string $email;

    public ?string $created_at = null;

    public ?string $updated_at = null;

    public ?AccountDto $account;

    public function __construct(array $data)
    {
        parent::__construct($data);
    }
}
