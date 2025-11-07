<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Nave;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mantenimiento>
 */
class MantenimientoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nave_id' => Nave::factory(),
            'fecha' => $this->faker->date(),
            'descripcion' => $this->faker->sentence(),
            'coste' => $this->faker->randomFloat(2, 1000, 100000),
        ];
    }
}
