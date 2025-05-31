<?php

namespace App\Providers;

use App\Interfaces\ContactInterface;
use App\Repositories\ContactRepository;
use Illuminate\Support\ServiceProvider;

class FrontendContactProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ContactInterface::class, ContactRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
