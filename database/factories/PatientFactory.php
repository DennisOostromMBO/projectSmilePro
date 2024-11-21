<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\Persoon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'PersoonId' => Persoon::factory(), 
            'Nummer' => 'P' . $this->faker->unique()->randomNumber(3), 
            'MedischDossier' => $this->faker->sentence(),
        ];
    }
}
