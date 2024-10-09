<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportGameRequest;
use App\Models\Game;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Http\Resources\GameResource;
use App\Imports\GamesImport;
use App\Models\Numbers;
use App\Services\GameService;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;

class GameController extends Controller
{


    public function __construct(protected GameService $gameService) {}


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $games = $this->gameService->getAllGames();

        return GameResource::collection($games);
    }


    /**
     * Create a new game.
     *
     * This method is used to create a new game.
     */
    public function store(StoreGameRequest $request)
    {
        $this->gameService->createGame($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Game created successfully',
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        return new GameResource($game);
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


    public function active(int $game)
    {
        try {
            $this->gameService->activeGame($game);

            return response()->json([
                'success' => true,
                'message' => 'Game activated successfully',
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }


    /**
     * Import games from a file.
     *
     * This method is used to import games from a file.
     * You can download the file [here](https://lotery-production.up.railway.app/assets/import-games.csv)
     */
    public function import(ImportGameRequest $request)
    {
        Excel::import(new GamesImport, $request->file('file'));

        return response()->json([
            'success' => true,
            'message' => 'Games imported successfully',
        ], Response::HTTP_OK);
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
