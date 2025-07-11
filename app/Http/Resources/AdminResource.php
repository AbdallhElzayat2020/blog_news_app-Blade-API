<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var \App\Models\Admin $this->resource */
        return [
            'user_name' => 'Super Admin',
            'joined_at' => $this->created_at->diffForHumans(),
            'user_status' => $this->status,
        ];
    }
}