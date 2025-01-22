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
            'datum' => '2025-01-22',
            'tijd' => '12:30',
            'type_afspraak' => 'Controle',
        ]);

        Afspraak::create([
            'gebruiker_id' => 2,
            'patient_naam' => 'Piet Pietersen',
            'medewerker_naam' => 'Dr. Jansen',
            'datum' => '2025-01-22',
            'tijd' => '12:00',
            'type_afspraak' => 'Controle',
        ]);


        Afspraak::create([
            'gebruiker_id' => 3,
            'patient_naam' => 'Fatih Kuzu',
            'medewerker_naam' => 'Mvr. Lima',
            'datum' => '2025-01-22',
            'tijd' => '13:00',
            'type_afspraak' => 'Overleg',
        ]);
        Afspraak::create([
            'gebruiker_id' => 3,
            'patient_naam' => 'Baris Alper Yilmaz',
            'medewerker_naam' => 'Mvr. Lima',
            'datum' => '2025-01-30',
            'tijd' => '12:30',
            'type_afspraak' => 'Overleg',
        ]);
        Afspraak::create([
            'gebruiker_id' => 4,
            'patient_naam' => 'Mauro Icardi',
            'medewerker_naam' => 'Mvr. Cabrella',
            'datum' => '2025-01-27',
            'tijd' => '10:30',
            'type_afspraak' => 'Overleg',

            
        ]);

        Afspraak::create([
            'gebruiker_id' => 4,
            'patient_naam' => 'Mauro Icardi',
            'medewerker_naam' => 'Mvr. Cabrella',
            'datum' => '2025-02-22',
            'tijd' => '12:30',
            'type_afspraak' => 'Overleg',

            
        ]);

        Afspraak::create([
            'gebruiker_id' => 11,
            'patient_naam' => 'Fernando Muslera',
            'medewerker_naam' => 'Mvr. Astima',
            'datum' => '2025-01-23',
            'tijd' => '08:00',
            'type_afspraak' => 'Controle',

            
        ]);

        Afspraak::create([
            'gebruiker_id' => 4,
            'patient_naam' => 'Victor Osimhen',
            'medewerker_naam' => 'Mvr. Helena',
            'datum' => '2025-01-22',
            'tijd' => '15:00',
            'type_afspraak' => 'Controle',

            
        ]);

        Afspraak::create([
            'gebruiker_id' => 8,
            'patient_naam' => 'Emelia Hansen',
            'medewerker_naam' => 'Mvr. Cabrella',
            'datum' => '2025-01-26',
            'tijd' => '08:30',
            'type_afspraak' => 'Controle',

            
        ]);

        Afspraak::create([
            'gebruiker_id' => 7,
            'patient_naam' => 'Noah Levi',
            'medewerker_naam' => 'Mvr. Lima',
            'datum' => '2025-01-28',
            'tijd' => '10:30',
            'type_afspraak' => 'Controle',

            
        ]);

        Afspraak::create([
            'gebruiker_id' => 9,
            'patient_naam' => 'Lucas Fischer',
            'medewerker_naam' => 'Dr. Jansen',
            'datum' => '2025-01-28',
            'tijd' => '09:00',
            'type_afspraak' => 'Controle',

            
        ]);
    }
}
