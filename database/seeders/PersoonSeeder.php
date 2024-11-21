<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Persoon;

class PersoonSeeder extends Seeder
{
    public function run()
    {
        Persoon::create([
            'Voornaam' => 'John',
            'Tussenvoegsel' => 'van',
            'Achternaam' => 'Doe',
            'Geboortedatum' => '1990-01-01',
        ]);

        Persoon::create([
            'Voornaam' => 'Jane',
            'Tussenvoegsel' => null,
            'Achternaam' => 'Smith',
            'Geboortedatum' => '1985-05-15',
        ]);
    }
}
