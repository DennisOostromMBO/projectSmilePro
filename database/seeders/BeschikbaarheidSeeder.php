<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Beschikbaarheid;
use App\Models\Medewerker;
use Carbon\Carbon;

class BeschikbaarheidSeeder extends Seeder
{
    public function run()
    {
        // Verwijder bestaande beschikbaarheden
        Beschikbaarheid::truncate();

        // Haal alle medewerkers op
        $medewerkers = Medewerker::all();

        // Genereer 10 beschikbaarheden voor de komende 3 weken voor elke medewerker
        foreach ($medewerkers as $medewerker) {
            for ($i = 0; $i < 5; $i++) {
                $datumVanaf = Carbon::now()->addDays(rand(0, 21)); // Datum binnen de komende 3 weken
                $datumTotMet = $datumVanaf->copy()->addHours(rand(1, 8)); // Einddatum binnen dezelfde dag
                $tijdVanaf = Carbon::createFromTime(rand(8, 17), 0, 0); // Tijd tussen 08:00 en 17:00
                $tijdTotMet = $tijdVanaf->copy()->addHours(rand(1, 3)); // Eindtijd binnen 1 tot 3 uur

                Beschikbaarheid::create([
                    'medewerkerId' => $medewerker->id,
                    'datumVanaf' => $datumVanaf->format('Y-m-d'),
                    'DatumTotMet' => $datumTotMet->format('Y-m-d'),
                    'tijdVanaf' => $tijdVanaf->format('H:i:s'),
                    'TijdTotMet' => $tijdTotMet->format('H:i:s'),
                    'status' => ['Aanwezig', 'Afwezig', 'Verlof', 'Ziek'][rand(0, 3)], // Willekeurige status
                    'isActief' => (bool)rand(0, 1), // Willekeurig actief of niet
                    'opmerking' => 'Opmerking ' . ($i + 1)
                ]);
            }
        }
    }
}