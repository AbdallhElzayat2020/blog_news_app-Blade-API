<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var \App\Models\User $this->resource */

        return [
            'user_name' => $this->name,
            'joined_at' => $this->created_at->diffForHumans(),
            'status' => $this->status,
        ];
    }
}