<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'lotery_id',
        'game_date',
        'status_id',
        'total_prize',
        'winner_id',
    ];

    public function lotery()
    {
        return $this->belongsTo(Lotery::class);
    }

    public function winner()
    {
        return $this->belongsTo(User::class);
    }

    public static function getActiveGames()
    {
        return self::leftJoin('loteries', 'loteries.id', 'games.lotery_id')
            ->where('games.status_id', 1)
            ->select('loteries.name', 'games.total_prize', 'games.game_date', 'loteries.description', 'loteries.rules', 'games.id AS idGame')
            ->get();
    }

    public static function todaysGames()
    {
        // return Carbon::today()->format('Y/m/d');
        return self::whereDate('game_date', Carbon::today())
            ->where('status_id', 1)
            ->get();
    }

    public static function saveWinner($id, $userId, $numberWinner)
    {
        return self::where('id', $id)
            ->update([
                'winner_id' => $userId,
                'status_id' => 3,
                'winner_number' => $numberWinner
            ]);
    }
}
