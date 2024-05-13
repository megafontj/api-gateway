<?php

namespace App\Providers;

use App\AuthProvider\TokenUserProvider;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Auth::provider('megafon_token', function (Application $app, array $config) {
           return resolve(TokenUserProvider::class);
        });
    }
}
