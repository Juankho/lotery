<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportLoteryRequest;
use App\Http\Requests\LoteryFilters;
use App\Models\Lotery;
use App\Http\Requests\StoreLoteryRequest;
use App\Http\Requests\UpdateLoteryRequest;
use App\Http\Resources\LoteryResource;
use App\Imports\LoteriesImport;
use App\Services\LoteryService;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;

class LoteryController extends Controller
{
    public function __construct(protected LoteryService $loteryService)
    {

        $this->middleware('admin');
    }

    /**
     * Display a listing of the loteries.
     *
     * This method is used to get all loteries.
     */
    public function index(LoteryFilters $request)
    {

        $loteries = $this->loteryService->getAllLoteries($request->all());

        return LoteryResource::collection($loteries);
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
    public function store(StoreLoteryRequest $request)
    {
        $validatedData = $request->validated();

        $lotery = $this->loteryService->createLotery($validatedData);

        return response()->json($lotery, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Lotery $lotery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lotery $lotery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLoteryRequest $request, Lotery $lotery)
    {
        // Validamos los datos actualizados
        $validatedData = $request->validated();

        // Actualizamos la lotería
        $lotery->update($validatedData);

        return response()->json($lotery);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lotery $lotery) {}


    /**
     * Import loteries from a file.
     *
     * This method is used to import users from a file.
     * You can download the file [here](https://lotery-production.up.railway.app/assets/import-loteries.xlsx)
     */
    public function import(ImportLoteryRequest $request)
    {
        Excel::import(new LoteriesImport, $request->file('file'));

        return response()->json([
            'success' => true,
            'message' => 'Loteries imported successfully',
        ], Response::HTTP_OK);
    }
}
