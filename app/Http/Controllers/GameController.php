<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Models\Numbers;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGameRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGameRequest $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        //
    }

    public function closeGames()
    {
        $games = Game::todaysGames();

        foreach ($games as $game) {
            $numberWinner = rand(0000, 9999);
            $winner = Numbers::getInfoByNumber($numberWinner, $game->id);
            if (isset($winner->user_id)) {
                $userId = $winner->user_id;
            } else {
                $userId = null;
            }
            Game::saveWinner($game->id, $userId, $numberWinner);
        }
        return response()->json([
            'status' => true,
            'message' => 'closed games'
        ]);
    }
}
