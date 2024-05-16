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
    Route::get('accounts', [AccountController::class, 'show']);
    Route::get('accounts/{username}', [AccountController::class, 'accountByUsername']);
    Route::patch('accounts', [AccountController::class, 'update']);
    Route::delete('accounts', [AccountController::class, 'destroy']);
    Route::get('accounts/followers', [AccountController::class, 'followers']);
    Route::get('accounts/following', [AccountController::class, 'following']);
    Route::post('accounts/follow', [AccountController::class, 'followUser']);
    Route::post('accounts/unfollow', [AccountController::class, 'unfollowUser']);

    Route::post('tweets/search', [TweetController::class, 'index']);
    Route::apiResource('tweets', TweetController::class);
});
