<?php

namespace App\Providers;

use App\Services\IPromocionService;
use App\Services\PromocionService;
use Illuminate\Support\ServiceProvider;

class PromocionProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IPromocionService::class, PromocionService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
