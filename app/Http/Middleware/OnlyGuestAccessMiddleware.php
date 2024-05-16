<?php

namespace App\Http\Middleware;

use App\Services\Auth\AuthApiService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OnlyGuestAccessMiddleware
{
    public function __construct(
        private AuthApiService $authApiService
    )
    {
    }

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();
        if ($token && $this->authApiService->currentUser($token)->id) {
            abort(403, 'You are already logged in');
        }

        return $next($request);
    }
}
