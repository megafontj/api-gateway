<?php

namespace App\Http\Controllers\ApiV1;

use App\DTO\UserDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): UserResource
    {
        return new UserResource(new UserDto([
            'name' => 'Test',
            'email' => 'test@test.com',
            'created_at' => 'test',
            'updated_at' => 'test'
        ]));
    }
}
