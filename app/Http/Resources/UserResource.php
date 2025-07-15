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
        /** @var \App\Models\User $this ->resource */
        $data = [
            'user_name' => $this->name,
            'status' => $this->status,
        ];

        if ($request->is('api/get/user')) {
            $data['email'] = $this->email;
            $data['phone'] = $this->phone;
            $data['image'] = asset($this->avatar);
        }

        return $data;

    }
}