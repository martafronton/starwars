<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Planeta;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Nave>
 */
class NaveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->unique()->word(),
            'modelo' => $this->faker->word(),
            'tripulacion' => $this->faker->numberBetween(1, 1000),
            'pasajeros' => $this->faker->numberBetween(0, 500),
            'clase_nave' => $this->faker->randomElement(['caza', 'transporte', 'exploración']),
            'planeta_id' => Planeta::factory(),
        ];
    }
}
