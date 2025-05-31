<?php

namespace App\Providers;

use App\Interfaces\SearchInterface;
use App\Repositories\SearchRepository;
use Illuminate\Support\ServiceProvider;

class FrontendSearchProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(SearchInterface::class, SearchRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
