<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Beschikbaarheid;
use App\Models\Medewerker;
use Carbon\Carbon;

class BeschikbaarheidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Voeg de beschikbaarheden voor een medewerker toe
        Beschikbaarheid::create([
            'medewerkerId' => 1, // Medewerker ID (pas aan op basis van jouw gegevens)
            'datumVanaf' => '2024-12-01', // Startdatum van de beschikbaarheid
            'DatumTotMet' => '2024-12-01', // Einddatum van de beschikbaarheid
            'tijdVanaf' => '09:00:00', // Starttijd van de beschikbaarheid
            'TijdTotMet' => '17:00:00', // Eindtijd van de beschikbaarheid
            'status' => 'Aanwezig', // De status van de medewerker
            'isActief' => 1, // Actief (1 betekent actief)
            'opmerking' => 'Opmerking 1', // Opmerking bij de beschikbaarheid
        ]);

        Beschikbaarheid::create([
            'medewerkerId' => 2,
            'datumVanaf' => '2024-12-02',
            'DatumTotMet' => '2024-12-02',
            'tijdVanaf' => '10:00:00',
            'TijdTotMet' => '16:00:00',
            'status' => 'Afwezig',
            'isActief' => 1,
            'opmerking' => 'Opmerking 2',
        ]);
        Beschikbaarheid::create([
            'medewerkerId' => 3,
            'datumVanaf' => '2024-12-03',
            'DatumTotMet' => '2024-12-03',
            'tijdVanaf' => '08:00:00',
            'TijdTotMet' => '12:00:00',
            'status' => 'Verlof',
            'isActief' => 0,
            'opmerking' => 'Opmerking 3',
        ]);
           // Voeg de beschikbaarheden voor een medewerker toe
           Beschikbaarheid::create([
            'medewerkerId' => 11, // Medewerker ID (pas aan op basis van jouw gegevens)
            'datumVanaf' => '2024-12-19', // Startdatum van de beschikbaarheid
            'DatumTotMet' => '2024-12-19', // Einddatum van de beschikbaarheid
            'tijdVanaf' => '09:00:00', // Starttijd van de beschikbaarheid
            'TijdTotMet' => '17:00:00', // Eindtijd van de beschikbaarheid
            'status' => 'Aanwezig', // De status van de medewerker
            'isActief' => 1, // Actief (1 betekent actief)
            'opmerking' => 'Opmerking 1', // Opmerking bij de beschikbaarheid
        ]);
        Beschikbaarheid::create([
            'medewerkerId' => 10, // Medewerker ID (pas aan op basis van jouw gegevens)
            'datumVanaf' => '2024-12-18', // Startdatum van de beschikbaarheid
            'DatumTotMet' => '2024-12-18', // Einddatum van de beschikbaarheid
            'tijdVanaf' => '09:00:00', // Starttijd van de beschikbaarheid
            'TijdTotMet' => '17:00:00', // Eindtijd van de beschikbaarheid
            'status' => 'Aanwezig', // De status van de medewerker
            'isActief' => 1, // Actief (1 betekent actief)
            'opmerking' => 'Opmerking 1', // Opmerking bij de beschikbaarheid
        ]);

        Beschikbaarheid::create([
            'medewerkerId' => 7,
            'datumVanaf' => '2024-12-017',
            'DatumTotMet' => '2024-12-017',
            'tijdVanaf' => '10:00:00',
            'TijdTotMet' => '18:00:00',
            'status' => 'Afwezig',
            'isActief' => 1,
            'opmerking' => 'Opmerking 2',
        ]);

        Beschikbaarheid::create([
            'medewerkerId' => 3,
            'datumVanaf' => '2024-12-15',
            'DatumTotMet' => '2024-12-15',
            'tijdVanaf' => '08:00:00',
            'TijdTotMet' => '12:00:00',
            'status' => 'Verlof',
            'isActief' => 0,
            'opmerking' => 'Opmerking 3',
        ]);
        Beschikbaarheid::create([
            'medewerkerId' => 2,
            'datumVanaf' => '2024-11-12',
            'DatumTotMet' => '2024-11-12',
            'tijdVanaf' => '10:00:00',
            'TijdTotMet' => '16:00:00',
            'status' => 'Afwezig',
            'isActief' => 1,
            'opmerking' => 'Opmerking 2',
        ]);
        // Voeg meer beschikbaarheden toe zoals nodig
        // Bijvoorbeeld voor medewerker 4, 5, etc.
    }
}
