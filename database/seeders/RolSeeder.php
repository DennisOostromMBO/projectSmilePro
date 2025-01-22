<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RolModel;

class RolSeeder extends Seeder
{
    public function run()
    {
        RolModel::create([
            'id' => 1,
            'Naam' => 'Praktijkmanagement',
            'Comments' => 'Manager van de Praktijk',
        ]);

        RolModel::create([
            'id' => 2,
            'Naam' => 'Tandarts',
            'Comments' => 'Tandarts van de Praktijk',
        ]);

        RolModel::create([
            'id' => 3,
            'Naam' => 'Mondhygiënist',
            'Comments' => 'Mondhygiënist van de Praktijk',
        ]);

        RolModel::create([
            'id' => 4,
            'Naam' => 'Assistent',
            'Comments' => 'Assistent van de Praktijk',
        ]);

        RolModel::create([
            'id' => 5,
            'Naam' => 'Patient',
            'Comments' => 'Patient van de Praktijk',
        ]);

        RolModel::create([
            'id' => 6,
            'Naam' => 'Bezoeker',
            'Comments' => 'Bezoeker van de Praktijk',
        ]);
    }
}