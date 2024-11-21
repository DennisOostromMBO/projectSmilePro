<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RolModel;

class RolSeeder extends Seeder
{
    public function run()
    {
        RolModel::create([
            'Naam' => 'Praktijkmanagement',
            'Comments' => 'Manager van de Praktijk',
        ]);

        RolModel::create([
            'Naam' => 'Tandarts',
            'Comments' => 'Tandarts van de Praktijk',
        ]);

        RolModel::create([
            'Naam' => 'Mondhygiënist',
            'Comments' => 'Mondhygiënist van de Praktijk',
        ]);

        RolModel::create([
            'Naam' => 'Assistent',
            'Comments' => 'Assistent van de Praktijk',
        ]);

        RolModel::create([
            'Naam' => 'Patient',
            'Comments' => 'Patient van de Praktijk',
        ]);
    }
}
