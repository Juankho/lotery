<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Numbers extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'game_id',
        'user_id',
    ];


    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getAllNumbers($gameId)
    {
        return self::select('number')
            ->where('game_id', $gameId)
            ->pluck('number')
            ->toArray();
    }

    public static function insertNumber($number, $gameId, $userId)
    {
        return self::create(
            [
                'number' => $number,
                'game_id' => $gameId,
                'user_id' => $userId,
            ]
        );
    }
}
