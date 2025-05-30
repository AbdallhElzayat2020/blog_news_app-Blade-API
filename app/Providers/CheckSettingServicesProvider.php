<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\RelatedSite;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class CheckSettingServicesProvider extends ServiceProvider
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

        $getSetting = Setting::firstOr(function () {
            return Setting::create([
                'site_name' => 'Default Site Name',
                'site_email' => 'web_default@gmail.com',
                'site_phone' => '1234567890',
                'site_address' => '123 Default St, Default City, Default Country',
                'site_description' => 'This is a default description for the site.',
                'site_logo' => 'Frontend/img/logo.png',
                'site_favicon' => 'Frontend/img/logo.png',
                'city' => 'Default City',
                'street' => 'Default Street',
                'country' => 'Default Country',
                'facebook_link' => 'https://facebook.com/default',
                'x_link' => 'https://x.com/default',
                'instagram_link' => 'https://instagram.com/default',
                'linkedin_link' => 'https://linkedin.com/default',
                'youtube_link' => 'https://youtube.com/default',
                'tiktok_link' => 'https://tiktok.com/default',
                'whatsapp_link' => 'https://wa.me/1234567890',
                'telegram_link' => 'https://t.me/default',
            ]);
        });

        $links = RelatedSite::select('name', 'url', 'id')->get();

        $categories = Category::latest()->select('name', 'id', 'slug')->limit(10)->get();
        view()->share([
            'getSetting' => $getSetting,
            'links' => $links,
            'categories' => $categories,
        ]);
    }
}
