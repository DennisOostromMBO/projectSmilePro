<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Persoon>
 */
class PersoonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fixName = rand(0, 10) > 5 ? $this->faker->word() : '';

        return [
            "VolledigeNaam" => $this->faker->lastName(),
            "Geboortedatum" => $this->faker->date(),
        ];
    }
}