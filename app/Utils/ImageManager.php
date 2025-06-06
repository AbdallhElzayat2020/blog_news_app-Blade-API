<?php

namespace App\Utils;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImageManager
{
    public static function uploadImage($request, $post): void
    {
        if ($request->hasFile('images')) {
            foreach ($request->images as $image) {
                $filename = Str::slug($request->title) . '_' . Str::uuid() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('uploads/posts', $filename, 'uploads');
                $post->images()->create([
                    'path' => $path,
                    'alt_text' => Str::slug($request->title) . '_' . Str::uuid(),
                ]);
            }
        }
    }

    public static function deleteImages($post): void
    {
        if ($post->images->count() > 0) {
            foreach ($post->images as $image) {
                if (File::exists(public_path($image->path))) {
                    File::delete(public_path($image->path));
                }
            }
        }
    }
}