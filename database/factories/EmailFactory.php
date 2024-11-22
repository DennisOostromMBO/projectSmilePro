<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmailFactory extends Factory
{
    /**
     * Het bijbehorende model van de factory.
     *
     * @var string
     */
    protected $model = \App\Models\Email::class;

    /**
     * Definieer de standaard state van het model.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subject' => $this->faker->sentence(4), // Genereert een willekeurige titel
            'body' => $this->faker->paragraph(2),  // Genereert een willekeurige tekst
        ];
    }
}
