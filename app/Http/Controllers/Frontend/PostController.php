<?php

namespace App\Http\Controllers\Frontend;

use App\Events\CommentEvent;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Notifications\NewCommentNotification;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index(string $slug)
    {


        $mainPost = Post::active()->with(['category', 'images', 'comments' => function ($query) {
            $query->limit(3);
        }])->whereSlug($slug)->firstOrFail();

//        if (!$mainPost) {
//            abort(404, 'Post not found');
//        }

        $category = $mainPost->category;
        $related_posts = $category->posts()
            ->active()
            ->with('user')
            ->select('id', 'title', 'slug', 'description')
            ->where('id', '!=', $mainPost->id)
            ->with('images')
            ->latest()
            ->take(4)
            ->get();


        $mainPost->increment('number_of_views');


        return view('frontend.show-single-post', compact('mainPost', 'related_posts'));
    }

    public function getAllComments(string $slug)
    {
        $post = Post::whereSlug($slug)->firstOrFail();

//        if (!$post) {
//            abort(404, 'Post not found');
//        }
        $comments = $post->comments()->latest()->with('user')->get();
        return response()->json($comments);
    }

    public function storeComment(Request $request)
    {
        $request->validate([
            'comment' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'exists:users,id'],
        ]);
        $comment = Comment::create([
            'comment' => $request->comment,
            'user_id' => $request->user_id,
            'post_id' => $request->post_id,
            'ip_address' => $request->ip(),
        ]);

        if (!$comment) {
            return response()->json([
                'msg' => 'Failed to add comment',
            ], 404);
        }

        // get post and user for sent notification
        $post = Post::findOrFail($request->post_id);
        $user = $post->user;
        $user->notify(new NewCommentNotification($comment, $post));

        $comment->load('user');

        return response()->json([
            'msg' => 'Comment added successfully',
            'comment' => $comment,

        ], 201);
    }
}
