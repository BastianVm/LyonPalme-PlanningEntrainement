<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LPPE_Indisponibilites>
 */
class LPPEIndisponibilitesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_indispo' => $this->faker->unique()->numberBetween(1, 1000),
            'motif' => $this->faker->sentence(),
            'statut' => $this->faker->randomElement(['active', 'inactive']),
            'id_entraineur' => $this->faker->numberBetween(1, 100),
            'id_seance' => $this->faker->numberBetween(1, 100),
            'id_entraineur_remplacant' => $this->faker->numberBetween(1, 100),
        ];
    }
}
