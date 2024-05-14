<?php

namespace App\DTO\Accounts;

use App\DTO\DtoMapper;

class AccountDto extends DtoMapper
{
    public int $id;

    public ?string $username;

    public ?string $name;

    public string $email;

    public ?int $followers_count = null;

    public ?int $following_count = null;

    public ?string $created_at;

    public ?string $updated_at;

    public ?array $followers = null;

    public ?array $following = null;

    public function __construct(array $data)
    {
        parent::__construct($data);
    }
}
