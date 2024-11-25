<?php

namespace Database\Seeders;

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Beschikbaarheid;
use Carbon\Carbon;

class BeschikbaarheidSeeder extends Seeder
{
    public function run()
    {
        // Verwijder bestaande beschikbaarheden
        Beschikbaarheid::truncate();

        // Genereer 10 beschikbaarheden voor de komende 3 weken
        for ($i = 0; $i < 10; $i++) {
            $date = Carbon::now()->addDays(rand(0, 21)); // Datum binnen de komende 3 weken
            $time = Carbon::createFromTime(rand(8, 17), 0, 0); // Tijd tussen 08:00 en 17:00

            Beschikbaarheid::create([
                'datum' => $date->format('Y-m-d'),
                'tijd' => $time->format('H:i'),
                'beschikbaar' => (bool)rand(0, 1), // Willekeurig beschikbaar of niet
            ]);
        }
    }
}