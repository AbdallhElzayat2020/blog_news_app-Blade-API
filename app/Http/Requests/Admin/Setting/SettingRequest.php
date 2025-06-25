<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'site_name' => ['required', 'string', 'max:255', 'min:3'],
            'site_email' => ['required', 'email', 'max:255'],
            'site_phone' => ['required', 'string', 'max:255'],
            'site_address' => ['required', 'string', 'max:255'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:255', 'min:3'],
            'site_logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:3000'],
            'site_favicon' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:3000'],
            'facebook_link' => ['nullable', 'url', 'max:255'],
            'twitter_link' => ['nullable', 'url', 'max:255'],
            'instagram_link' => ['nullable', 'url', 'max:255'],
            'linkedin_link' => ['nullable', 'url', 'max:255'],
            'youtube_link' => ['nullable', 'url', 'max:255'],
            'tiktok_link' => ['nullable', 'url', 'max:255'],
            'street' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
        ];
    }
}
