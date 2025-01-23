<?php

namespace Database\Factories;

use App\Models\Factuur;
use Illuminate\Database\Eloquent\Factories\Factory;

class FactuurFactory extends Factory
{
    protected $model = Factuur::class;

    public function definition(): array
    {
        return [
            'persoon_id' => 3,
            'beschrijving' => $this->faker->sentence,
            'vervaldatum' => $this->faker->date,
            'btw' => $this->faker->randomFloat(2, 0, 21),
            'totaal_bedrag' => $this->faker->randomFloat(2, 100, 1000),
        ];
    }
}
