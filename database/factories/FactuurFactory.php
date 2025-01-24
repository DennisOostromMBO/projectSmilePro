<?php

namespace Database\Factories;

use App\Models\Factuur;
use App\Models\Persoon;
use Illuminate\Database\Eloquent\Factories\Factory;

class FactuurFactory extends Factory
{
    protected $model = Factuur::class;

    public function definition(): array
    {
        return [
            // 'persoon_id' => Persoon::inRandomOrder()->first()->id, // Willekeurig een bestaand persoon_id selecteren
            // 'persoon_id' => 0, // Willekeurig een bestaand persoon_id selecteren
            // 'PersoonId' => Persoon::inRandomOrder()->first()->id, // Willekeurig een bestaand persoon_id selecteren
            "persoon_id" => Persoon::factory(),
            'beschrijving' => $this->faker->sentence,
            'vervaldatum' => $this->faker->date,
            'btw' => 21,
            'totaal_bedrag' => $this->faker->randomFloat(2, 100, 1000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}