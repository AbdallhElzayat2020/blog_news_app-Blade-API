<?php

namespace App\Utils;

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
}