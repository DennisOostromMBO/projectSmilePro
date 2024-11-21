<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Persoon;

class PersoonSeeder extends Seeder
{
    public function run()
    {
        Persoon::create([
            'Voornaam' => 'Pieter',
            'Tussenvoegsel' => 'van',
            'Achternaam' => 'Loen',
            'Geboortedatum' => '1990-01-01',
        ]);

        Persoon::create([
            'Voornaam' => 'Thomas',
            'Tussenvoegsel' => null,
            'Achternaam' => 'Kranenburg',
            'Geboortedatum' => '1985-05-15',
        ]);
    }
}
