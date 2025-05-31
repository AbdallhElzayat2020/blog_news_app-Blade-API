<?php

namespace App\Providers;

use App\Interfaces\HomeInterface;
use App\Repositories\HomeRepository;
use Illuminate\Support\ServiceProvider;

class FrontendHomeProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(HomeInterface::class, HomeRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
