<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Broadcast\SRS\ApiService;
use App\Broadcast\SRS\HlsService;
use App\Broadcast\SRS\RtmpService;
use App\Broadcast\SRS\SrsHookService;
use App\Broadcast\SRS\SrsService;



class SrsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
{
    $this->app->singleton(SrsService::class, function ($app) {
        return new SrsService(
            $app->make(ApiService::class),
            $app->make(RtmpService::class),
            $app->make(HlsService::class),
            $app->make(SrsHookService::class)
        );
    });
}

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
