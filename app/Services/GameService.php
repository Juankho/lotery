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


    /**
     * Get a game by id
     *
     * @param integer $id
     * @return Game
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
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


    public function activeGame(int $id): Game
    {
        $game = $this->getGameById($id);

        if ($game->status_id === 2) {
            throw new \Exception('Game already active');
        }

        if ($game->status_id === 3) {
            throw new \Exception('Game already finished');
        }

        $game->status_id = 2;
        $game->save();

        return $game;
    }

    public function updateGame(array $data) {}


    public function deleteGame() {}
}
