<?php

namespace App\Providers;

use App\Http\Middleware\HttpCacheMiddleware;
use App\Validator\RequestValidator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(HttpCacheMiddleware::class);

        $this->app->bind('reqvalid', static function ($app) {
            $config = $app->make('config')->get('reqvalid');

            return new RequestValidator($config);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
