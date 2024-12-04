<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Afspraak;

class AfspraakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Afspraak::create([
            'gebruiker_id' => 1, // Verwijs naar een gebruiker die bestaat
            'datum' => '2024-12-05', // Voorbeeld datum
            'tijd' => '10:00', // Voorbeeld tijd
            'notities' => 'Controle afspraak',
        ]);

        Afspraak::create([
            'gebruiker_id' => 2, // Verwijs naar een gebruiker die bestaat
            'datum' => '2024-12-06',
            'tijd' => '14:00',
            'notities' => 'Follow-up na operatie',
        ]);

        Afspraak::create([
            'gebruiker_id' => 1,
            'datum' => '2024-12-07',
            'tijd' => '09:30',
            'notities' => 'Bloedonderzoek voor allergieën',
        ]);

        Afspraak::create([
            'gebruiker_id' => 3, // Verwijs naar een gebruiker die bestaat
            'datum' => '2024-12-10',
            'tijd' => '11:00',
            'notities' => 'Informatie sessie voor nieuwe behandelingen',
        ]);
    }
}
