<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\RequestService;
use App\Repositories\RequestRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RequestService::class, function ($app) {
            return new RequestService(new RequestRepository);
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
