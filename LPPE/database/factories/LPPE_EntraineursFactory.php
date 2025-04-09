<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LPPE_Entraineurs>
 */
class LPPE_EntraineursFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->lastname(),
            'prenom' => $this->faker->firstName(),
            'email' => $this->faker->unique()->safeEmail(),
            'identifiant' => $this->faker->unique()->userName(),
            'mdp' => $this->faker->password(),
            'rôle' => $this->faker->randomElement(['admin', 'user'])
        ];
    }
}
