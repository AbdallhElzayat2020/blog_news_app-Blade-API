<?php

namespace App\Http\Resources;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\AdminResource;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Post $this ->resource */
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'number_of_views' => $this->number_of_views,
            'comment_able' => $this->comment_able,
            'publisher' => $this->user_id == null ? AdminResource::make($this->admin) : UserResource::make($this->user),
            'meta_description' => $this->meta_description,
            'meta_title' => $this->meta_title,
            'post_url' => route('frontend.post.show', $this->slug),
            'post_endpoint' => url('api/posts/show/' . $this->slug),
            'status' => $this->status,
            'created_at' => $this->created_at->format('Y-m-d h:m a'),
            'category' => CategoryResource::make($this->category),
        ];
    }
}