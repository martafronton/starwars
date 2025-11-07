<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Planeta>
 */
class PlanetaFactory extends Factory
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
            'periodo_rotacion' => $this->faker->numberBetween(10, 50),
            'poblacion' => $this->faker->numberBetween(100000, 1000000000),
            'clima' => $this->faker->randomElement(['árido', 'templado', 'húmedo', 'frío']),
        ];
    }
}
