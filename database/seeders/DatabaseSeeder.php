<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Medewerker;
use App\Models\Persoon;
use Database\Factories\MedewerkerFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Database\Factories\UserFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            persoonSeeder::class,
            RolSeeder::class, // Zorg ervoor dat de RolSeeder eerst wordt aangeroepen
            MedewerkerSeeder::class,
            PatientSeeder::class,
            ContactSeeder::class,
            EmailSeeder::class,
            BeschikbaarheidSeeder::class,
            FactuurSeeder::class,
        ]);

        // Maak een testgebruiker aan
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'rol_id' => 1,
        ]);
    }
}
