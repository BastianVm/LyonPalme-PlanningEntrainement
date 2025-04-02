<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LPPE_Plannings>
 */
class LPPEPlanningsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_planning' => $this->faker->unique()->numberBetween(1, 1000),
            'date_création' => $this->faker->date(),
            'id_responsable' => $this->faker->numberBetween(1, 100)
        ];
    }
}
