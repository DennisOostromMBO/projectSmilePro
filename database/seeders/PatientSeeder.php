<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Patient;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Patient::create([
            'Nummer' => 'P001',
            'MedischDossier' => 'Allergieën: Penicilline, Vorige behandelingen: Geen',
        ]);

        Patient::create([
            'Nummer' => 'P002',
            'MedischDossier' => 'Allergieën: Pinda, Vorige behandelingen: Chirurgie 2022',
        ]);
    }
}
