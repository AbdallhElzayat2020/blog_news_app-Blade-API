<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RelatedSiteResource;
use App\Http\Resources\SettingsResource;
use App\Models\RelatedSite;
use App\Models\Setting;
use Illuminate\Http\Request;
use function App\Http\Helpers\apiResponse;

class SettingController extends Controller
{
    public function getSettings()
    {
        $settings = Setting::first();

        if (!$settings) {
            return apiResponse(404, 'Settings is empty');
        }
        return apiResponse('200', SettingsResource::make($settings));
    }


    public function relatedSites()
    {
        $relatedSites = RelatedSite::select(['name', 'url'])->first();
        if (!$relatedSites) {
            return apiResponse(404, 'Related sites is empty');
        }
        return apiResponse(200, null, RelatedSiteResource::make($relatedSites));
    }

}
