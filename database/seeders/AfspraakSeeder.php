<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Afspraak;
//php artisan make:seeder AfspraakSeeder

class AfspraakSeeder extends Seeder
{
    public function run()
    {
        Afspraak::create([
            'gebruiker_id' => 1,
            'patient_naam' => 'Jan Jansen',
            'medewerker_naam' => 'Dr. Pietersen',
            'datum' => '2024-12-05',
            'tijd' => '10:00',
            'type_afspraak' => 'Controle afspraak',
        ]);

        Afspraak::create([
            'gebruiker_id' => 2,
            'patient_naam' => 'Piet Pietersen',
            'medewerker_naam' => 'Dr. Jansen',
            'datum' => '2024-12-06',
            'tijd' => '14:00',
            'type_afspraak' => 'Follow-up na operatie',
        ]);
    }
}
