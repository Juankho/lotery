<?php

namespace App\Services;

use App\Models\Game;

class GameService
{

    public function getAllGames(array $filters = [])
    {
        return Game::with('status', 'lotery', 'winner')
            ->get();
    }


    public function getGameById(int $id): Game
    {
        return Game::with('status', 'lotery', 'winner')
            ->findOrFail($id);
    }

    public function createGame(array $data): Game
    {
        return Game::create([
            'lotery_id' => $data['loteryId'],
            'game_date' => $data['gameDate'],
            'total_prize' => $data['totalPrize'],
        ]);
    }

    public function updateGame(array $data) {}


    public function deleteGame() {}
}
