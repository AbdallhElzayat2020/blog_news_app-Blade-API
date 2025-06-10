<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Dashboard\PostRequest;
use App\Http\Requests\Frontend\Dashboard\UpdatePostRequest;
use App\Interfaces\UserPostProfileInterface;
use App\Models\Image;
use App\Models\Post;
use App\Utils\ImageManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public $postProfile;

    public function __construct(UserPostProfileInterface $postProfile)
    {
        $this->postProfile = $postProfile;
    }

    public function index()
    {
        return $this->postProfile->index();
    }

    public function store(PostRequest $request)
    {
        return $this->postProfile->store($request);
    }


    public function destroy($id)
    {
        return $this->postProfile->destroy($id);
    }

    public function getComments($id)
    {
        return $this->postProfile->getComments($id);
    }

    public function editPost($slug): View
    {
        $post = Post::whereSlug($slug)->with(['images', 'category'])->firstOrFail();
        $user = auth()->user();
        if ($post->user_id != $user->id) {
            abort(403, 'Unauthorized action.');
        }
        $posts = $user->posts()->with(['images', 'category'])->active()->latest()->get();
        return view('frontend.dashboard.edit-post', compact('user', 'posts', 'post'));
    }


    public function updatePost(UpdatePostRequest $request)
    {
        $request->validated();

        try {
            DB::beginTransaction();
            $post = Post::findOrFail($request->post_id);
            $this->commentAble($request);
            $post->update($request->except(['images', 'post_id']));

            if ($request->hasFile('images')) {
                ImageManager::deleteImages($post);
                ImageManager::uploadImage($request, $post);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('errors', $e->getMessage());
        }


        return to_route('frontend.dashboard.profile')->with('success', 'updated successfully');

//        $post = Post::findOrFail($request->post_id);
//        $request->comment_able == 'on' ? $request->merge(['comment_able' => 'yes']) : $request->merge(['comment_able' => 'no']);
//        $post->update($request->except(['images', 'post_id']));
//
//        if ($request->hasFile('images')) {
//
//            if ($post->images()->count() > 0) {
//                foreach ($post->images as $image) {
//                    if (File::exists(public_path($image->path))) {
//                        File::delete(public_path($image->path));
//                    }
//                }
//            }
//            foreach ($request->images as $image) {
//                $filename = Str::uuid() . time() . '.' . $image->getClientOriginalExtension();
//                $path = $image->storeAs('uploads/posts', $filename, 'uploads');
//                $post->images()->create([
//                    'path' => $path,
//                    'alt_text' => Str::slug($request->title) . '_' . Str::uuid(),
//                ]);
//            }
//        }
    }


    public function deletePostImage(Request $request)
    {
        $image = Image::find($request->key);
        if (!$image) {
            return response()->json([
                'message' => 'Image not found'
            ], 404);
        }

        ImageManager::deleteImageLocal($image->path);
        $image->delete();
        return response()->json([
            'message' => 'Image deleted successfully'
        ], 200);
    }


    private function commentAble($request)
    {
        return $request->comment_able == 'on' ? $request->merge(['comment_able' => 'yes']) : $request->merge(['comment_able' => 'no']);
    }

}
