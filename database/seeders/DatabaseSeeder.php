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
use App\Models\Patient;

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
            FactuurSeeder::class,
            BeschikbaarheidSeeder::class,            
        ]);

        // Maak een testgebruiker aan
        User::factory()->create([
            'voornaam' => 'Praktijk',
            'tussenvoegsel' => '',
            'achternaam' => 'Manager',
            'email' => 'test@example.com',
            'password' => bcrypt('1'),
            'rol_id' => 1,
        ]);
    }
}