<?php

namespace App\Http\Controllers\ApiV1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Accounts\FollowOrUnfollowRequest;
use App\Http\Requests\Accounts\UpdateUserRequest;
use App\Http\Resources\AccountResource;
use App\Services\Accounts\AccountApiService;
use App\Support\Requests\SearchRequest;
use App\Support\Resources\EmptyResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AccountController extends Controller
{
    public function __construct(
        readonly private AccountApiService $accountApiService
    )
    {
    }

    public function index(SearchRequest $request): AnonymousResourceCollection
    {
        $accounts = $this->accountApiService->search($request->validated());

        return AccountResource::collection($accounts->getData())->additional(['meta' => $accounts->getMeta()]);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return new AccountResource($this->accountApiService->getAccount());
    }

    public function accountByUsername(string $username)
    {
        return new AccountResource($this->accountApiService->getAccountByUsername($username));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request)
    {
        return new AccountResource($this->accountApiService->updateAccount($request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        throw new \Exception('Просто так нельзя удалить пользователя!!');
    }

    public function followers(): AnonymousResourceCollection
    {
        $accounts = $this->accountApiService->getFollowers();

        return AccountResource::collection($accounts->getData())->additional(['meta' => $accounts->getMeta()]);
    }

    public function following(): AnonymousResourceCollection
    {
        $accounts = $this->accountApiService->getFollowing();

        return AccountResource::collection($accounts->getData())->additional(['meta' => $accounts->getMeta()]);
    }

    public function followUser(FollowOrUnfollowRequest $request): EmptyResource
    {
        $this->accountApiService->followUser($request->getUserId());

        return new EmptyResource();
    }

    public function unfollowUser(FollowOrUnfollowRequest $request): EmptyResource
    {
        $this->accountApiService->unfollowUser($request->getUserId());

        return new EmptyResource();
    }
}
