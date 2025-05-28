<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name',
        'site_email',
        'site_phone',
        'site_address',
        'site_description',
        'site_logo',
        'site_favicon',
        'facebook_link',
        'x_link',
        'instagram_link',
        'linkedin_link',
        'youtube_link',
        'tiktok_link',
        'whatsapp_link',
        'telegram_link',
        'city_link',
        'country_link',
    ];
}
