<?php

use App\Http\Controllers\ApiV1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)
    ->prefix('auth')
    ->group(function () {
        Route::post('/register', 'register');
        Route::post('/login', 'login');
})->withoutMiddleware('auth:api');


Route::post('auth/current', [AuthController::class, 'current']);
