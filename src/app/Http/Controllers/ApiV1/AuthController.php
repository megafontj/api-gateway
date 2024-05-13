<?php

namespace App\Http\Controllers\ApiV1;

use App\DTO\UserDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\TokenResource;
use App\Http\Resources\UserResource;
use App\Services\AuthApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(
        readonly private AuthApiService $authApiService
    )
    {
    }

    public function register(RegisterRequest $request): UserResource
    {
        return new UserResource($this->authApiService->register($request->validated()));
    }

    public function login(LoginRequest $request): TokenResource
    {
        return new TokenResource($this->authApiService->login($request->validated()));
    }

    public function current(): UserResource
    {
        return new UserResource(Auth::user());
    }
}
