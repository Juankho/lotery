<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
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
            'lotery' => new LoteryResource($this->whenLoaded('lotery')),
            'gameDate' => $this->game_date,
            'totalPrize' => $this->total_prize,
            'status' => new RoleStatusResource($this->whenLoaded('status')),
            'winner' => new UserResource($this->whenLoaded('winner')),
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
