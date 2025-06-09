<?php

namespace App\Utils;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImageManager
{
    public static function uploadImage($request, $post = null, $user = null): void
    {
        // upload multiple images
        if ($request->hasFile('images')) {
            foreach ($request->images as $image) {
                $filename = self::generateImageName($image);
                $path = self::storeImageLocal($image, 'users', $filename);
                $post->images()->create([
                    'path' => $path,
                    'alt_text' => Str::slug($request->title) . '_' . Str::uuid(),
                ]);
            }
        }

        // upload single image
        if ($request->hasFile('avatar')) {

            self::deleteImageLocal($user->avatar);

            $image = $request->file('avatar');
            $filename = self::generateImageName($image);
            $path = self::storeImageLocal($image, 'users', $filename);

            $user->update([
                'avatar' => $path,
            ]);
        }

    }

    public static function deleteImages($post): void
    {
        if ($post->images->count() > 0) {
            foreach ($post->images as $image) {
                self::deleteImageLocal($image->path);
            }
        }
    }


    public static function generateImageName($image): string
    {
        return $filename = '_' . Str::uuid() . time() . '.' . $image->getClientOriginalExtension();
    }

    public static function storeImageLocal($image, $path, $filename): string
    {
        return $path = $image->storeAs('uploads/' . $path, $filename, 'uploads');
    }

    public static function deleteImageLocal($imagePath): void
    {
        if (File::exists(public_path($imagePath))) {
            File::delete(public_path($imagePath));
        }
    }


}