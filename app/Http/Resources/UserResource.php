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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'birthDate' => $this->birth_date,
            'status' => $this->status,
            'phone' => $this->phone,
            'notifyBy' => $this->notify_by,
            'role' => new RoleResource($this->whenLoaded('role')),
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            $this->mergeWhen($this->token, [
                'token' => $this->token,
            ]),
        ];
    }
}
