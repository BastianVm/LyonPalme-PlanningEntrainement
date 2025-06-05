<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class LPPEEntrainementsTableSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Récupère tous les IDs existants
        $seances = DB::table('l_p_p_e__seances')->pluck('id_seance')->toArray();
        $entraineurs = DB::table('l_p_p_e__entraineurs')->pluck('id_entraineur')->toArray();

        // Crée 20 entrainements factices
        for ($i = 0; $i < 20; $i++) {
            DB::table('l_p_p_e__entrainements')->insert([
                'titre' => $faker->sentence(3),
                'description' => $faker->paragraph(),
                'id_seance' => $faker->randomElement($seances),
                'id_entraineur' => $faker->randomElement($entraineurs),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}