<?php

namespace App\Http\Controllers\ApiV1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tweets\CreateTweetRequest;
use App\Http\Requests\Tweets\UpdateTweetRequest;
use App\Http\Resources\TweetResource;
use App\Services\Tweets\TweetApiService;
use App\Support\Requests\SearchRequest;
use App\Support\Resources\EmptyResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TweetController extends Controller
{
    public function __construct(
        private TweetApiService $tweetApiService
    )
    {}

    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request): AnonymousResourceCollection
    {
        $response = $this->tweetApiService->search($request->validated());

        return TweetResource::collection($response->getData())->additional(['meta' => $response->getMeta()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTweetRequest $request): TweetResource
    {
        return new TweetResource($this->tweetApiService->createTweet($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): TweetResource
    {
        return new TweetResource($this->tweetApiService->getTweet($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, UpdateTweetRequest $request): TweetResource
    {
        return new TweetResource($this->tweetApiService->updateTweet($id, $request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): EmptyResource
    {
        $this->tweetApiService->destroy($id);

        return new EmptyResource();
    }
}
