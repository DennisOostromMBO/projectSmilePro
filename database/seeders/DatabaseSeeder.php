<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Medewerker;
use App\Models\Persoon;
use App\Models\User;
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
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);


        $this->call([
            PersoonSeeder::class,
            MedewerkerSeeder::class,
            GebruikerSeeder::class,
            MedewerkerSeeder::class,
            PatientSeeder::class,
            PersoonSeeder::class,
            RolSeeder::class,
            ContactSeeder::class,
            EmailSeeder::class,
            BeschikbaarheidSeeder::class,
        ]);
    }
}