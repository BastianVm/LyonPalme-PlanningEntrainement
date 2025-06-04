<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Crypt;

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
            'email' =>  $this->faker->unique()->safeEmail(),
            'telephone' => $this->faker->phoneNumber(),
            'identifiant' => $this->faker->unique()->userName(),
            'mdp' => bcrypt('password'),
            'rôle' => $this->faker->randomElement(['admin', 'user'])
        ];
    }
}
