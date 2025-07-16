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


        $data = [
            'category_id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'status' => $this->status,
            'created_at' => $this->created_at->format('Y-m-d h:m a'),
        ];

        if (!$request->is('api/posts/show/*') && !$request->is('api/categories')) {
            $data['posts'] = PostResource::collection($this->posts);
        }

        return $data;
    }
}