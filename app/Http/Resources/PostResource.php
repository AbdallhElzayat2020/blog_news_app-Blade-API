<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
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
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'number_of_views' => $this->number_of_views,
            'comment_able' => $this->comment_able,
            'publisher' => $this->user_id == null ? $this->admin->name : $this->user->name,
            'meta_description' => $this->meta_description,
            'meta_title' => $this->meta_title,
            'status' => $this->status,
            'created_at' => $this->created_at->format('Y-m-d h:m a'),
            'category' => CategoryResource::make($this->category),
        ];
    }
}