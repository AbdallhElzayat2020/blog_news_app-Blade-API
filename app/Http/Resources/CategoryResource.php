<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var \App\Models\Category $this ->resource */
        return [
            'category_name' => $this->name,
            'category_slug' => $this->slug,
            'status' => $this->status,
            'created_date' => $this->created_at->format('y-m-d'),
            'posts' => PostResource::collection($this->posts),
        ];
    }
}