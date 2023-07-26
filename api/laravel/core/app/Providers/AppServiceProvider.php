<?php

namespace App\Providers;

use App\Http\Requests\AuthorizationRequest;
use App\Services\AuthorizationService;
use App\Services\GamesService;
use App\Services\HttpService;
use App\Services\Interfaces\IAuthorizationService;
use App\Services\Interfaces\IGamesService;
use App\Services\Interfaces\IHttpService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IGamesService::class, GamesService::class);
        $this->app->bind(IHttpService::class, HttpService::class);
        $this->app->bind(IAuthorizationService::class, AuthorizationService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
