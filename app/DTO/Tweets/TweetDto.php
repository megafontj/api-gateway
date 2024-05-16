<?php

namespace App\DTO\Tweets;

use App\DTO\Accounts\AccountDto;
use App\DTO\DtoMapper;

class TweetDto extends DtoMapper
{
    public int $id;

    public string $content;

    public ?string $created_at;

    public ?string $updated_at;

    public int $user_id;

    public ?AccountDto $owner = null;

    public function __construct(array $data)
    {
        parent::__construct($data);
    }
}
