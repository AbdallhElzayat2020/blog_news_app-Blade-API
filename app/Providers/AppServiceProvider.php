<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use function App\Http\Helpers\apiResponse;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // add paginating
        if ($this->app->environment('local') && class_exists(\Laravel\Telescope\TelescopeServiceProvider::class)) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }

        Paginator::useBootstrap();

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        $this->configureRateLimiter();

        Gate::guessPolicyNamesUsing(function (string $classModel) {

        });
    }


    protected function configureRateLimiter(): void
    {
        // Rate Limiting
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(20)->by($request->user()?->id ?: $request->ip());
        });

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(3)->by($request->user()?->id ?: $request->ip())->response(function () {
                return apiResponse(429, 'Too Many Attempts', 'You have exceeded the maximum number of login attempts. Please try again later.');
            });
        });

        RateLimiter::for('forgetPassword', function (Request $request) {
            return Limit::perMinute(1)->by($request->user()?->id ?: $request->ip())->response(function () {
                return apiResponse(429, 'Too Many Attempts', 'You have exceeded the maximum number of login attempts. Please try again later.');
            });
        });

        RateLimiter::for('verify', function (Request $request) {
            return Limit::perMinute(5)->by($request->user()?->id ?: $request->ip())->response(function () {
                return apiResponse(429, 'Too Many Attempts', 'You have exceeded the maximum number of login attempts. Please try again later.');
            });
        });

        RateLimiter::for('resendOtp', function (Request $request) {
            return Limit::perMinute(2)->by($request->user()?->id ?: $request->ip())->response(function () {
                return apiResponse(429, 'Too Many Attempts', 'You have exceeded the maximum number of login attempts. Please try again after 1 minute.');
            });
        });

        RateLimiter::for('resetPassword', function (Request $request) {
            return Limit::perMinute(5)->by($request->user()?->id ?: $request->ip())->response(function () {
                return apiResponse(429, 'Too Many Attempts', 'You have exceeded the maximum number of login attempts. Please try again later.');
            });
        });

        RateLimiter::for('register', function (Request $request) {
            return Limit::perMinute(4)->by($request->user()?->id ?: $request->ip())->response(function () {
                return apiResponse(429, 'Too Many Attempts', 'You have exceeded the maximum number of registration attempts. Please try again later.');
            });
        });

        RateLimiter::for('getPosts', function (Request $request) {
            return Limit::perMinute(25)->by($request->user()?->id ?: $request->ip())->response(function () {
                return apiResponse(429, 'Too Many Attempts', 'You have exceeded the maximum number of requests for posts. Please try again later.');
            });
        });

        RateLimiter::for('contact', function (Request $request) {
            return Limit::perMinute(3)->by($request->user()?->id ?: $request->ip())->response(function () {
                return apiResponse(429, 'Too Many Attempts', 'You have exceeded the maximum number of contact requests. Please try again later.');
            });
        });

        RateLimiter::for('aboutPage', function (Request $request) {
            return Limit::perMinute(20)->by($request->user()?->id ?: $request->ip())->response(function () {
                return apiResponse(429, 'Too Many Attempts', 'You have exceeded the maximum number of requests for the about page. Please try again later.');
            });
        });

    }
}
