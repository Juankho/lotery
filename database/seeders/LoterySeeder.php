<?php

namespace Database\Seeders;

use App\Models\Lotery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoterySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lotery::insert([
            [
                'name' => 'Baloto',
                'description' => 'El Baloto es una lotería colombiana con grandes premios acumulados.',
                'status' => 1,
                'rules' => 'Selecciona un número de 4 cifras entre el 0000 y el 9999.'
            ],
            [
                'name' => 'Chance',
                'description' => 'El Chance es una apuesta en la que seleccionas números de 2, 3 o 4 cifras.',
                'status' => 1,
                'rules' => 'Selecciona un número de 4 cifras entre el 0000 y el 9999.'
            ],
            [
                'name' => 'Lotería de Bogotá',
                'description' => 'La Lotería de Bogotá es una de las más populares en Colombia, con sorteos semanales.',
                'status' => 1,
                'rules' => 'Selecciona un número de 4 cifras entre el 0000 y el 9999.'
            ],
            [
                'name' => 'Lotería del Valle',
                'description' => 'La Lotería del Valle es conocida por sus atractivos premios.',
                'status' => 1,
                'rules' => 'Selecciona un número de 4 cifras entre el 0000 y el 9999.'
            ],
            [
                'name' => 'Superastro',
                'description' => 'Superastro es un juego de lotería basado en la selección de signos zodiacales y números.',
                'status' => 1,
                'rules' => 'Selecciona un número de 4 cifras entre el 0000 y el 9999.'
            ]
        ]);
    }
}
