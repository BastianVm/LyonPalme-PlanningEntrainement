<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LPPE_Entraineurs>
 */
class LPPEEntraineursFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->name(),
            'prenom' => $this->faker->firstName(),
            'email' => $this->faker->unique()->safeEmail(),
            'telephone' => $this->faker->phoneNumber(),
            'identifiant' => $this->faker->unique()->userName(),
            'mdp' => $this->faker->password(),
            'role' => $this->faker->randomElement(['admin', 'user'])
        ];
    }
}
