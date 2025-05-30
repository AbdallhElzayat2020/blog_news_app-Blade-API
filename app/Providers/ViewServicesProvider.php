<?php

namespace App\Providers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;
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
//        Cache::forget('latest_posts');

        if (!Cache::has('latest_posts')) {
            $latest_posts = Post::with('images')->select('id', 'title', 'slug', 'description')->latest()->take(5)->get();
            Cache::remember('latest_posts', 3600, function () use ($latest_posts) {
                return $latest_posts;
            });
        }
        $latest_posts = Cache::get('latest_posts');

        if (!Cache::has('latest_comments')) {
            $popular_posts = Post::with('images')
                ->withCount('comments')
                ->orderBy('comments_count', 'desc')
                ->take(5)
                ->get();
            Cache::remember('popular_posts', 3600, function () use ($popular_posts) {
                return $popular_posts;
            });
        }
        $popular_posts = Cache::get('popular_posts');

        // Share the latest and popular posts with all views
        view()->share([
            'popular_posts' => $popular_posts,
            'latest_posts' => $latest_posts,
        ]);
    }
}
