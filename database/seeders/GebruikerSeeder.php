<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GebruikerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Haal de bestaande PersoonId waarden op uit de persoon tabel
        $personen = DB::table('persoon')->pluck('Id')->toArray();

        // Zorg ervoor dat er genoeg personen zijn om de gebruikers te maken
        if (count($personen) < 4) {
            throw new \Exception('Niet genoeg personen in de tabel om gebruikers te maken.');
        }

        DB::table('gebruiker')->insert([
            [
                'PersoonId' => $personen[0], // Gebruik de eerste id
                'name' => 'johndoe',
                'Email' => 'johndoe@example.com', // Voeg de email kolom toe
                'password' => Hash::make('Monkey123'), // Hash het wachtwoord
                'IsActive' => 1,
                'Isingelogd' => 0,
                'Comments' => 'First user',
            ],
            [
                'PersoonId' => $personen[1], // Gebruik de tweede id
                'name' => 'janesmith',
                'Email' => 'janesmith@example.com', // Voeg de email kolom toe
                'password' => Hash::make('Frikandel123'), // Hash het wachtwoord
                'IsActive' => 1,
                'Isingelogd' => 0,
                'Comments' => 'Second user',
            ],
            [
                'PersoonId' => $personen[2], // Gebruik de derde id
                'name' => 'alicejohnson',
                'Email' => 'alicejohnson@example.com', // Voeg de email kolom toe
                'password' => Hash::make('Password123'), // Hash het wachtwoord
                'IsActive' => 1,
                'Isingelogd' => 0,

                'Comments' => 'Third user',
            ],
            [
                'PersoonId' => $personen[3], // Gebruik de vierde id
                'name' => 'bobwilliams',
                'Email' => 'bobwilliams@example.com', // Voeg de email kolom toe
                'password' => Hash::make('SecurePass123'), // Hash het wachtwoord
                'IsActive' => 1,
                'Isingelogd' => 0,

                'Comments' => 'Fourth user',
            ],
        ]);
    }
}