<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\LoteryController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\NumbersController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::post('/email/verification-notification', [AuthController::class, 'sendEmailVerificationNotification'])
    ->middleware(['auth:sanctum', 'throttle:6,1']);

Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])
    ->middleware(['auth:sanctum', 'signed'])->name('verification.verify');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('logout-all', [AuthController::class, 'logoutAll']);
    Route::get('user', [AuthController::class, 'user']);

    Route::apiResource('users', UserController::class);
    Route::post('users/import', [UserController::class, 'import']);

    Route::get('lotery', [LoteryController::class, 'index']);
    Route::post('lotery', [LoteryController::class, 'store']);
    Route::patch('lotery/{lotery}', [LoteryController::class, 'update']);
    Route::post('lotery/import', [LoteryController::class, 'import']);

    Route::post('number', [NumbersController::class, 'store']);

    Route::post('notifications', [NotificationsController::class, 'store']);

    Route::apiResource('games', GameController::class)->except(['destroy', 'update']);
    Route::post('games/import', [GameController::class, 'import']);
    Route::post('games/active/{game}', [GameController::class, 'active']);

    Route::post('closeGames', [GameController::class, 'closeGames']);
});
