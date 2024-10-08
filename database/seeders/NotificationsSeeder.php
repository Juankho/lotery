<?php

namespace Database\Seeders;

use App\Models\Notifications;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Notifications::create([
            'name' => 'SMS',
        ]);

        Notifications::create([
            'name' => 'Llamada',
        ]);

        Notifications::create([
            'name' => 'Email',
        ]);

        Notifications::create([
            'name' => 'Whatsapp',
        ]);
    }
}
