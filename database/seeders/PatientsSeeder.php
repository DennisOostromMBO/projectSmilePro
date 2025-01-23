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
            'straatnaam' => 'Hoofdstraat',
            'huisnummer' => 123,
            'toevoeging' => 'A',
            'postcode' => '1234AB',
            'plaats' => 'Amsterdam',
            'mobiel' => '0612345678',
            'email' => 'persoon1@example.com',
        ]);

        Patient::create([
            'persoon_id' => 2,
            'nummer' => 'P002',
            'medisch_dossier' => 'Allergieën: Pinda, Vorige behandelingen: Chirurgie 2022',
            'straatnaam' => 'Dorpsstraat',
            'huisnummer' => 456,
            'toevoeging' => 'B',
            'postcode' => '5678CD',
            'plaats' => 'Rotterdam',
            'mobiel' => '0687654321',
            'email' => 'persoon2@example.com',
        ]);
    }
}