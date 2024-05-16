<?php

namespace App\Http\Controllers\ApiV1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\TokenResource;
use App\Http\Resources\AuthResource;
use App\Services\Auth\AuthApiService;
use App\Support\Resources\EmptyResource;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(
        readonly private AuthApiService $authApiService
    )
    {
    }

    public function register(RegisterRequest $request): AuthResource
    {
        return new AuthResource($this->authApiService->register($request->validated()));
    }

    public function login(LoginRequest $request): TokenResource
    {
        return new TokenResource($this->authApiService->login($request->validated()));
    }

    public function current(): AuthResource
    {
        return new AuthResource(Auth::user());
    }

    public function logout(): EmptyResource
    {
        $this->authApiService->logout();
        return new EmptyResource();
    }
}
