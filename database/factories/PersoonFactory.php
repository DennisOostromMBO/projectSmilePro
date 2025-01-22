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
        $tussenvoegsel = rand(0, 1) ? $this->faker->word() : '';

        return [
            'voornaam' => $this->faker->firstName(),
            'tussenvoegsel' => $tussenvoegsel,
            'achternaam' => $this->faker->lastName(),
            'geboortedatum' => $this->faker->date(),

        ];
    }
}