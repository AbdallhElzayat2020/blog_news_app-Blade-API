<?php

namespace App\Providers;

use App\Interfaces\UserPostProfileInterface;
use App\Repositories\UserPostProfileRepository;
use Illuminate\Support\ServiceProvider;

class UserPostProfileProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserPostProfileInterface::class, UserPostProfileRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
