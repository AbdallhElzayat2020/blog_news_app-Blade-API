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

        $data = [
            'post_id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'status' => $this->status,
            'post_images' => ImageResource::collection($this->images),
            'publisher' => $this->user_id == null ? AdminResource::make($this->admin) : UserResource::make($this->user),
            'created_at' => $this->created_at->format('Y-m-d h:m a'),
            'category_name' => $this->category->name,
        ];

        if ($request->is('api/posts/show/*')) {
            $data['description'] = $this->description;
            $data['comment_able'] = $this->comment_able;
            $data['publisher'] = $this->user_id == null ? AdminResource::make($this->admin) : UserResource::make($this->user);
            $data['meta_description'] = $this->meta_description;
            $data['meta_title'] = $this->meta_title;
            $data['number_of_views'] = $this->number_of_views;
            $data['category'] = CategoryResource::make($this->category);
        }

        return $data;
    }
}