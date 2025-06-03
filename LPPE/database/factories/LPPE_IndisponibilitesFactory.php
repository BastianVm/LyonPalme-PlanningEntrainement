<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LPPE_Indisponibilites>
 */
class LPPE_IndisponibilitesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'motif' => $this->faker->sentence(),
            'statut' => $this->faker->randomElement(['active', 'inactive']),
            'id_entraineur' => $this->faker->numberBetween(1, 10),
            'id_seance' => $this->faker->numberBetween(1, 10),
            'id_entraineur_remplacant' => $this->faker->numberBetween(1, 10),
        ];
    }
}
