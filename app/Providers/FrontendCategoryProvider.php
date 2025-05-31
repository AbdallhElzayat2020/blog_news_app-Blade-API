<?php

namespace App\Providers;

use App\Interfaces\CategoryInterface;
use App\Repositories\CategoryRepository;
use Illuminate\Support\ServiceProvider;

class FrontendCategoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryInterface::class,CategoryRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
