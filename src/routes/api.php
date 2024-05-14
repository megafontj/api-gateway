<?php

use App\Http\Controllers\ApiV1\AuthController;
use App\Http\Middleware\OnlyGuestAccessMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
});
