<?php

namespace App\Services\Accounts;

use App\DTO\Accounts\AccountDto;
use App\Services\ApiProxy;
use Illuminate\Support\Facades\Auth;

class AccountApiService extends ApiProxy
{
    public function __construct()
    {
        parent::__construct(config('microservices.accounts.base_uri'));
    }

    public function getAccountByAuthId(int $authId): AccountDto
    {
        return new AccountDto($this->getJson('users/byauth/' . $authId)->getData());
    }
}
