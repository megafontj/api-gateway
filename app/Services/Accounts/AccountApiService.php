<?php

namespace App\Services\Accounts;

use App\DTO\Accounts\AccountDto;
use App\DTO\Auth\UserDto;
use App\DTO\DtoCollection;
use App\Services\ApiProxy;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    public function search(array $data): DtoCollection
    {
        $accounts = $this->postJson('users/search', $data);
        return AccountDto::collection($accounts->getData(), $accounts->getMeta());
    }

    public function getAccount(): AccountDto
    {
        $id = Auth::user()->account->id;

        return new AccountDto($this->getJson('users/' . $id)->getData());
    }

    public function getAccountById(int $id): AccountDto
    {
        return new AccountDto($this->getJson('users/' . $id)->getData());
    }

    public function getAccountByUsername(string $username): AccountDto
    {
        $account = $this->search([
            'filter' => [
                'username' => $username
            ]
        ])->getData()[0] ?? null;

        if (! $account) {
           throw new NotFoundHttpException('Account not founded by username!');
        }

        return new AccountDto($account);
    }

    public function updateAccount(array $data)
    {
        $id = Auth::user()->account->id;

        return new AccountDto($this->patchJson('users/' . $id, $data)->getData());
    }

    public function getFollowers()
    {
        $id = Auth::user()->account->id;

        $response = $this->getJson(sprintf('users/%s/followers', $id));

        return AccountDto::collection($response->getData(), $response->getMeta());
    }

    public function getFollowing()
    {
        $id = Auth::user()->account->id;

        $response = $this->getJson(sprintf('users/%s/following', $id));

        return AccountDto::collection($response->getData(), $response->getMeta());
    }

    public function followUser(int $toFollowUserId): void
    {
        $url = sprintf('users/%s/follow', $toFollowUserId);

        $this->postJson($url, ['user_id' => Auth::user()->account->id]);
    }

    public function unfollowUser(int $toUnfollowUserId): void
    {
        $url = sprintf('users/%s/unfollow', $toUnfollowUserId);

        $this->postJson($url, ['user_id' => Auth::user()->account->id]);
    }

    public function createAccount(array $data, UserDto $userDto): AccountDto
    {
        $response = $this->postJson('users', [
            'username' => $data['username'],
            'name' => $data['name'],
            'email' => $data['email'],
            'auth_id' => $userDto->id
        ]);

        return new AccountDto($response->getData());
    }

    public function getNotFollowedAccounts()
    {
        $id = Auth::user()->id;

        $response = $this->getJson("users/$id/not-followed");

        return AccountDto::collection($response->getData(), $response->getMeta());
    }

}
