<?php

namespace App\Http\Resources;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Comment $this ->resource */
        return [
            'comment' => $this->comment,
            'user_name' => $this->user->name,
            'user_image' => asset($this->user->avatar),
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
