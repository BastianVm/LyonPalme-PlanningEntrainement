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
            'nom' => Crypt::encryptString($this->faker->lastname()),
            'prenom' => Crypt::encryptString($this->faker->firstName()),
            'email' =>  Crypt::encryptString($this->faker->unique()->safeEmail()),
            'telephone' =>  Crypt::encryptString($this->faker->phoneNumber()),
            'identifiant' => $this->faker->unique()->userName(),
            'mdp' => $this->faker->password(),
            'rôle' => $this->faker->randomElement(['admin', 'user'])
        ];
    }
}
