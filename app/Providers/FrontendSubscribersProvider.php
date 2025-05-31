<?php

namespace App\Providers;

use App\Interfaces\SubscribersInterface;
use App\Repositories\SubscribersRepository;
use Illuminate\Support\ServiceProvider;

class FrontendSubscribersProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(SubscribersInterface::class, SubscribersRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
