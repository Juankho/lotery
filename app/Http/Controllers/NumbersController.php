<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNumberRequest;
use App\Models\Numbers;
use App\Models\User;
use Illuminate\Http\Request;

class NumbersController extends Controller
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
    public function create($request) {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNumberRequest $request)
    {

        $userId = $request->user()->id;
        $amount = $request->amount;
        $gameId = $request->gameId;

        $actualNumbers = Numbers::getAllNumbers($gameId);

        $i = 0;
        $numbersUser=[];

        while ($i < $amount) {
            $randomNumber = rand(0000, 9999);

            if (!in_array($randomNumber, $actualNumbers)) {

                Numbers::insertNumber($randomNumber, $gameId, $userId);
                $i++;
                array_push($numbersUser, $randomNumber);
            }
        }


        return response()->json([
            "status"=>true,
            "message"=>'Insertados correctamente',
            "data"=>$numbersUser,
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Numbers $numbers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Numbers $numbers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Numbers $numbers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Numbers $numbers)
    {
        //
    }
}
