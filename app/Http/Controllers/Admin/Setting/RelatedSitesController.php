<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\RelatedSite;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class RelatedSitesController extends Controller
{

    public function index(Request $request)
    {
        $relatedSites = RelatedSite::when($request->keyword, function (Builder $query) {
            $query->where('name', 'like', '%' . request()->keyword . '%');

        })->orderBy(request('sort_by', 'id'), request('order_by', 'desc'))
            ->paginate(request('limit_by', 5))->withQueryString();

        return view('admin.relatedSites.index', compact('relatedSites'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url|max:255',
        ]);

        RelatedSite::create([
            'name' => $request->name,
            'url' => $request->url,
        ]);

        return redirect()->route('admin.related-sites.index')->with('success', 'Related site created successfully.');
    }

    public function update(Request $request, string $id)
    {
        $relatedSite = RelatedSite::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url|max:255',
        ]);

        $relatedSite->update([
            'name' => $request->name,
            'url' => $request->url,
        ]);

        return redirect()->route('admin.related-sites.index')->with('success', 'Related site updated successfully.');
    }

    public function destroy(string $id)
    {
        $relatedSite = RelatedSite::findOrFail($id);
        $relatedSite->delete();

        return redirect()->route('admin.related-sites.index')->with('success', 'Related site deleted successfully.');
    }
}
