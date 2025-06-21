<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Utils\ImageManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::withCount('posts')->when($request->keyword, function (Builder $query) {
            $query->where('name', 'like', '%' . request()->keyword . '%');

        })->when(request()->status, function (Builder $query) {
            $query->where('status', request()->status);

        })->orderBy(request('sort_by', 'id'), request('order_by', 'desc'))
            ->paginate(request('limit_by', 5))->withQueryString();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:categories,name', 'max:255'],
            'status' => ['required', 'in:active,inactive'],
            'description' => ['nullable', 'string', 'max:1000'],
            'icon' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:3000'],
        ]);


        $category = Category::create($request->except('icon'));

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $filename = '_' . Str::uuid() . time() . '.' . $file->getClientOriginalExtension();
            $path = ImageManager::storeImageLocal($file, 'categories', $filename);
            $category->update([
                'icon' => $path,
            ]);
        }
        return redirect()->back()->with('success', 'Category created successfully');

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
        $request->validate([
            'name' => ['required', 'string', 'unique:categories,name,' . $category->id, 'max:255'],
            'status' => ['required', 'in:active,inactive'],
            'description' => ['nullable', 'string', 'max:1000'],
            'icon' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:3000'],
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status,
            'description' => $request->description,
        ]);
        if ($request->hasFile('icon')) {
            ImageManager::deleteImageLocal($category->icon);

            $file = $request->file('icon');
            $filename = '_' . Str::uuid() . time() . '.' . $file->getClientOriginalExtension();
            $path = ImageManager::storeImageLocal($file, 'categories', $filename);
            $category->update([
                'icon' => $path,
            ]);
        }
        return redirect()->back()->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            DB::beginTransaction();
            $category = Category::findOrFail($id);
            ImageManager::deleteImageLocal($category->icon);

            $category->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete category, please try again later.');
        }

        return redirect()->back()->with('success', 'deleted successfully');
    }


    public function changeStatus($id)
    {
        $category = Category::findOrFail($id);
        if ($category->status == 'active') {
            $category->update([
                'status' => 'inactive',
            ]);
            return redirect()->back()->with('success', 'blocked successfully');
        } else {
            $category->update([
                'status' => 'active',
            ]);
            return redirect()->back()->with('success', 'Activated successfully');
        }
    }
}
