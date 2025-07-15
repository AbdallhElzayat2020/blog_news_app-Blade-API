<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RelatedSiteCollection;
use App\Models\RelatedSite;
use function App\Http\Helpers\apiResponse;

class RelatedNewsController extends Controller
{
    public function index()
    {
        $related_news = RelatedSite::latest()->get();
        if (!$related_news) {
            return apiResponse(200, 'No related news found.');
        }

        return apiResponse(200, RelatedSiteCollection::make($related_news));
    }
}
