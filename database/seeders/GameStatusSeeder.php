<?php

namespace Database\Seeders;

use App\Models\GameStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GameStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GameStatus::create([
            'name' => 'Pendiente',
            'description' => 'El juego está pendiente de ser jugado.',
        ]);

        GameStatus::create([
            'name' => 'En curso',
            'description' => 'El juego está en curso.',
        ]);

        GameStatus::create([
            'name' => 'Finalizado',
            'description' => 'El juego ha finalizado.',
        ]);
    }
}
