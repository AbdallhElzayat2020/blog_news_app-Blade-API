<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var \App\Models\Setting $this ->resource */
        return [
            'site_name' => $this->site_name,
            'site_email' => $this->site_email,
            'site_phone' => $this->site_phone,
            'site_address' => $this->site_address,
            'site_description' => $this->site_description,
            'site_logo' => $this->site_logo ? asset($this->site_logo) : null,
            'site_favicon' => $this->site_favicon ? asset($this->site_favicon) : null,
            'facebook_link' => $this->facebook_link,
            'x_link' => $this->x_link,
            'instagram_link' => $this->instagram_link,
            'linkedin_link' => $this->linkedin_link,
            'youtube_link' => $this->youtube_link,
            'tiktok_link' => $this->tiktok_link,
            'whatsapp_link' => $this->whatsapp_link,
            'telegram_link' => $this->telegram_link,
            'city' => $this->city,
            'country' => $this->country,
        ];
    }
}
