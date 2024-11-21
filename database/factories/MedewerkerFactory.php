<?php

namespace Database\Factories;

use App\Models\Persoon;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MedewerkerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "PersoonId" => Persoon::query()->inRandomOrder()->value('id'),
            "Nummer" => $this->faker->word(),
            "Medewerkertype" => $this->faker->word(),
            "Specialisatie" => $this->faker->word(),
            "Beschikbaarheid" => $this->faker->word()
        ];
    }
}