<?php

namespace App\Providers;

use App\Services\BinderbyteService;
use App\Services\GoapiService;
use App\Services\WilayahService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // $this->app->bind(WilayahService::class, BinderbyteService::class);
        $this->app->bind(WilayahService::class, GoapiService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
