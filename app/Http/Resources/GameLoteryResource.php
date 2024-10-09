<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameLoteryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'gameDate' => $this->game_date,
            'totalPrize' => $this->total_prize,
            'description' => $this->description,

            'rules' => $this->rules,

            'idGame' => $this->idGame,

        ];
    }
}
