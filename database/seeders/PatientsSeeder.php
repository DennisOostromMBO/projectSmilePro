<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Patient;

class PatientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Patient::create([
            'persoon_id' => 1,
            'nummer' => 'P001',
            'medisch_dossier' => 'Allergieën: Penicilline, Vorige behandelingen: Geen',
        ]);

        Patient::create([
            'persoon_id' => 2,
            'nummer' => 'P002',
            'medisch_dossier' => 'Allergieën: Pinda, Vorige behandelingen: Chirurgie 2022',
        ]);
    }
}