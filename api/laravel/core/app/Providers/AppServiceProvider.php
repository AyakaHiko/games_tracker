<?php

namespace App\Providers;

use App\Http\Requests\AuthorizationRequest;
use App\Services\AuthorizationService;
use App\Services\GameListService;
use App\Services\GamesService;
use App\Services\HttpService;
use App\Services\Interfaces\IAuthorizationService;
use App\Services\Interfaces\IGameListService;
use App\Services\Interfaces\IGamesService;
use App\Services\Interfaces\IHttpService;
use App\Services\Interfaces\IImageService;
use App\Services\MinIoImageService;
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
        $this->app->bind(IGameListService::class, GameListService::class);
        $this->app->bind(IImageService::class, MinIoImageService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
