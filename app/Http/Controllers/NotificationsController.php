<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotificationsRequest;
use App\Models\Notifications;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationsController extends Controller
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
     * 
     * Asignarle el identificador de notificacion al cliente logueado
     * 
     * 1. SMS
     * 2. Llamada
     * 3. Email
     * 4. Whatsapp
     */
    public function store(StoreNotificationsRequest $request)
    {
        $userId = $request->user()->id;
        $idNotification = $request->id;

        User::insertTypeNotification($userId, $idNotification);

        return response()->json([
            "status" => true,
            "message" => 'actualizado correctamente'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Notifications $notifications)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notifications $notifications)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notifications $notifications)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notifications $notifications)
    {
        //
    }
}
