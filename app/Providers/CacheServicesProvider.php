<?php

namespace App\Providers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class CacheServicesProvider extends ServiceProvider
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
        /* read_more_posts */
        if (!Cache::has('read_more_posts')) {
            $read_more_posts = Post::select('id', 'title', 'slug')->latest()->limit(10)->get();

            Cache::remember('read_more_posts', 3600, function () use ($read_more_posts) {
                return $read_more_posts;
            });
        }

        /* latest_posts  */
        if (!Cache::has('latest_posts')) {
            $latest_posts = Post::with('images')->select('id', 'title', 'slug', 'description')->latest()->take(4)->get();
            Cache::remember('latest_posts', 3600, function () use ($latest_posts) {
                return $latest_posts;
            });
        }
        $latest_posts = Cache::get('latest_posts');

        /* popular posts */
        if (!Cache::has('latest_comments')) {
            $popular_posts = Post::with('images')
                ->withCount('comments')
                ->orderBy('comments_count', 'desc')
                ->take(4)
                ->get();
            Cache::remember('popular_posts', 3600, function () use ($popular_posts) {
                return $popular_posts;
            });
        }

        /* get data from cache */
        $read_more_posts = Cache::get('read_more_posts');
        $popular_posts = Cache::get('popular_posts');
        $latest_posts = Cache::get('latest_posts');

        /* share data in views */
        view()->share([
            'read_more_posts' => $read_more_posts,
            'popular_posts' => $popular_posts,
            'latest_posts' => $latest_posts,
        ]);
    }
}
