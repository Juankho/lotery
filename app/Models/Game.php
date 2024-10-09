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
        'status',
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

    public static function todaysGames()
    {

        return self::whereDate('game_date', Carbon::today())
            ->where('status', 1)
            ->get();
    }

    public static function saveWinner($id, $winnerId, $winnernumber)
    {
        return self::where('id', $id)
            ->update([
                "status" => 0,
                "winner_id" => $winnerId,
                "winner_number" => $winnernumber,
            ]);
    }
}
