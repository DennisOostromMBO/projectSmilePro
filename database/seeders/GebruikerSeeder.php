<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GebruikerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Haal de bestaande PersoonId waarden op uit de personen tabel
        $persoon = DB::table('persoon')->pluck('id')->toArray();

        // Zorg ervoor dat er genoeg personen zijn om de gebruikers te maken
        if (count($persoon) < 4) {
            throw new \Exception('Niet genoeg personen in de tabel om gebruikers te maken.');
        }

        DB::table('gebruiker')->insert([
            [
                'PersoonId' => $persoon[0], // Gebruik de eerste id
                'Gebruikersnaam' => 'johndoe',
                'Wachtwoord' => Hash::make('password123'),
                'IsActive' => 1,
                'Isingelogd' => 0,
                'Ingelogd' => 0,
                'Uitgelogd' => 1,
                'Comments' => 'First user',
            ],
            [
                'PersoonId' => $persoon[1], // Gebruik de tweede id
                'Gebruikersnaam' => 'janesmith',
                'Wachtwoord' => Hash::make('password123'),
                'IsActive' => 1,
                'Isingelogd' => 0,
                'Ingelogd' => 0,
                'Uitgelogd' => 1,
                'Comments' => 'Second user',
            ],
            [
                'PersoonId' => $persoon[2], // Gebruik de derde id
                'Gebruikersnaam' => 'alicewit',
                'Wachtwoord' => Hash::make('password123'),
                'IsActive' => 1,
                'Isingelogd' => 0,
                'Ingelogd' => 0,
                'Uitgelogd' => 1,
                'Comments' => 'Third user',
            ],
            [
                'PersoonId' => $persoon[3], // Gebruik de vierde id
                'Gebruikersnaam' => 'bobjohnson',
                'Wachtwoord' => Hash::make('password123'),
                'IsActive' => 1,
                'Isingelogd' => 0,
                'Ingelogd' => 0,
                'Uitgelogd' => 1,
                'Comments' => 'Fourth user',
            ],
        ]);
    }
}