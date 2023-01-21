<?php

namespace App\Providers;

use App\Services\GoogleMaps\GoogleApiService;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GoogleApiService::class, function($app) {
            return new GoogleApiService(new Client([
                'base_uri' => config('services.google.key')
            ]));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
