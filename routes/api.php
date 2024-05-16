<?php

use App\Http\Controllers\ApiV1\AccountController;
use App\Http\Controllers\ApiV1\AuthController;
use App\Http\Controllers\ApiV1\TweetController;
use App\Http\Middleware\OnlyGuestAccessMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(OnlyGuestAccessMiddleware::class)
    ->controller(AuthController::class)
    ->prefix('auth')
    ->group(function () {
        Route::post('/register', 'register');
        Route::post('/login', 'login');
    });

Route::middleware('auth:api')->group(function () {
    Route::post('auth/current', [AuthController::class, 'current']);

    Route::post('accounts/search', [AccountController::class, 'index']);
    Route::get('account', [AccountController::class, 'show']);
    Route::get('accounts/{username}', [AccountController::class, 'accountByUsername']);
    Route::patch('account', [AccountController::class, 'update']);
    Route::delete('account', [AccountController::class, 'destroy']);
    Route::get('account/followers', [AccountController::class, 'followers']);
    Route::get('account/following', [AccountController::class, 'following']);
    Route::post('account/follow', [AccountController::class, 'followUser']);
    Route::post('account/unfollow', [AccountController::class, 'unfollowUser']);

    Route::post('tweets/search', [TweetController::class, 'index']);
    Route::apiResource('tweets', TweetController::class);
});
