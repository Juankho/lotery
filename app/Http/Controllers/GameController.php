<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportGameRequest;
use App\Models\Game;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Http\Resources\GameResource;
use App\Imports\GamesImport;
use App\Services\GameService;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;

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
     * Store a newly created resource in storage.
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
}
