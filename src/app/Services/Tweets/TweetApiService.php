<?php

namespace App\Services\Tweets;

use App\DTO\Accounts\AccountDto;
use App\DTO\DtoCollection;
use App\DTO\Tweets\TweetDto;
use App\Services\Accounts\AccountApiService;
use App\Services\ApiProxy;
use App\Services\ApiResponse;
use Illuminate\Support\Facades\Auth;

class TweetApiService extends ApiProxy
{
    public function __construct(
        private readonly AccountApiService $accountApiService
    )
    {
        parent::__construct(config('microservices.tweets.base_uri'));
    }

    public function getTweet(int $tweetId): TweetDto
    {
        $tweet = new TweetDto($this->getJson("tweets/$tweetId")->getData());
        $tweet->owner = $this->accountApiService->getAccountById($tweet->user_id);

        return $tweet;
    }

    public function createTweet(array $data)
    {
        $data['user_id'] = Auth::user()->account->id;

        $tweetDto = new TweetDto($this->postJson('tweets', $data)->getData());
        $tweetDto->owner = Auth::user()->account;

        return $tweetDto;
    }

    public function search(array $data): DtoCollection
    {
        $response = $this->postJson('tweets/search', $data);
        $tweets = TweetDto::collection($response->getData(), $response->getMeta());

        return $this->mergeWithAccounts($tweets);
    }

    public function updateTweet(int $id, array $data): TweetDto
    {
        $tweet = new TweetDto($this->patchJson("tweets/$id", $data)->getData());

        $tweet->owner = $this->accountApiService->getAccountById($tweet->user_id);

        return $tweet;
    }

    public function destroy(int $id): ApiResponse
    {
        return $this->delete("tweets/$id");
    }

    private function mergeWithAccounts($tweets)
    {
        $ownerIds = array_values(array_unique(array_column($tweets->getData(), 'user_id')));

        $ownersKeyBy = []; // owners by id: [account_id => AccountDto]
        collect($this->loadOwners($ownerIds))->each(function (AccountDto $account) use (&$ownersKeyBy) {
            $ownersKeyBy[$account->id] = $account;
        });

        // связ твитов с создателями
        collect($tweets->getData())->map(function (TweetDto $tweet) use ($ownersKeyBy) {
            $tweet->owner = $ownersKeyBy[$tweet->user_id] ?? null;
            return $tweet;
        });

        return $tweets;
    }

    /**
     * @param array $ownerIds
     * @return AccountDto[]
     */
    private function loadOwners(array $ownerIds): array
    {
        return $this->accountApiService->search([
            'filter' => [
                'id' => $ownerIds
            ]
        ])->getData();
    }

}
