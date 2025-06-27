<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class ViewServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Check if categories table exists before querying
        if (!Schema::hasTable('categories')) {
            return;
        }

//        Cache::forget('latest_posts');

        $categories = Category::withCount('posts')->latest()->select('name', 'id', 'slug')->limit(10)->get();

        // Share the latest and popular posts with all views
        view()->share([
            'categories' => $categories,
        ]);
    }
}
