<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Medewerker;
use App\Models\Persoon;
use Database\Factories\MedewerkerFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        $this->call([
            PersoonSeeder::class,
            MedewerkerSeeder::class,
            GebruikerSeeder::class,
            MedewerkerSeeder::class,
            PatientSeeder::class,
            RolSeeder::class,
            ContactSeeder::class,
            EmailSeeder::class,
            BeschikbaarheidSeeder::class,
            FactuurSeeder::class,
        ]);
    }
}
