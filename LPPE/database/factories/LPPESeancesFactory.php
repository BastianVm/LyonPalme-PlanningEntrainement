<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LPPE_Seances>
 */
class LPPESeancesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_seance' => $this->faker->unique()->numberBetween(1, 1000),
            'date_seance' => $this->faker->date(),
            'heure_debut' => $this->faker->time(),
            'heure_fin' => $this->faker->time(),
            'id_planning' => $this->faker->numberBetween(1, 100),
            'id_entraineur' => $this->faker->numberBetween(1, 100)
        ];
    }
}
