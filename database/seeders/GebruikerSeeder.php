<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RolModel;

class GebruikerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
    }
}

class RolSeeder extends Seeder
{
    public function run()
    {
        RolModel::create([
            'Naam' => 'Praktijkmanagement',
            'Beschrijving' => 'Manager van de Praktijk',
        ]);

        RolModel::create([
            'Naam' => 'Tandarts',
            'Beschrijving' => 'Tandarts van de Praktijk',
        ]);

        RolModel::create([
            'Naam' => 'Mondhygiënist',
            'Beschrijving' => 'Mondhygiënist van de Praktijk',
        ]);

        RolModel::create([
            'Naam' => 'Assistent',
            'Beschrijving' => 'Assistent van de Praktijk',
        ]);
    }
}
