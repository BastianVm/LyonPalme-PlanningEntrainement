<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Entraîneurs
        $entraineurs = \App\Models\LPPE_Entraineurs::factory(10)->create();

        // 2. Users (liés aux entraîneurs)
        foreach ($entraineurs as $entraineur) {
            \App\Models\User::factory()->create([
                'name' => $entraineur->prenom . ' ' . $entraineur->nom,
                'email' => $entraineur->email,
                'password' => $entraineur->mdp,
                'id_entraineur' => $entraineur->id_entraineur,
    ]);
}
        // 3. Plannings (besoin d'entraineurs)
        $this->call(LPPEPlanningsSeeder::class);
        // 4. Séances (besoin de plannings et d'entraineurs)
        $this->call(LPPESeancesSeeder::class);
        // 5. Indisponibilités (besoin de séances et d'entraineurs)
        $this->call(LPPEIndisponibilitesSeeder::class);
        $this->call(LPPEEntrainementsTableSeeder::class);
    }
}
