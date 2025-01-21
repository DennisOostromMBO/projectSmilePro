<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Afspraak;
//php artisan make:seeder AfspraakSeeder \ php artisan db:seed --class=AfspraakSeeder\ php artisan migrate:fresh --seed


class AfspraakSeeder extends Seeder
{
    public function run()
    {
        
        Afspraak::create([
            'gebruiker_id' => 1,
            'patient_naam' => 'Kerem Akturkoglu',
            'medewerker_naam' => 'Dr. Pietersen',
            'datum' => '2025-01-21',
            'tijd' => '09:00',
            'type_afspraak' => 'Controle',
        ]);

        Afspraak::create([
            'gebruiker_id' => 2,
            'patient_naam' => 'Piet Pietersen',
            'medewerker_naam' => 'Dr. Jansen',
            'datum' => '2025-01-21',
            'tijd' => '09:45',
            'type_afspraak' => 'Controle',
        ]);


        Afspraak::create([
            'gebruiker_id' => 3,
            'patient_naam' => 'Fatih Kuzu',
            'medewerker_naam' => 'Dr. Jansen',
            'datum' => '2025-01-21',
            'tijd' => '09:30',
            'type_afspraak' => 'Overleg',
        ]);
        Afspraak::create([
            'gebruiker_id' => 3,
            'patient_naam' => 'Baris Alper Yilmaz',
            'medewerker_naam' => 'Mvr. Lima',
            'datum' => '2025-01-21',
            'tijd' => '09:44',
            'type_afspraak' => 'Overleg',
        ]);
        Afspraak::create([
            'gebruiker_id' => 4,
            'patient_naam' => 'Mauro Icardi',
            'medewerker_naam' => 'Mvr. Cabrella',
            'datum' => '2025-01-29',
            'tijd' => '12:00',
            'type_afspraak' => 'Overleg',
        ]);
    }
}
