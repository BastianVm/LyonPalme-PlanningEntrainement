<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LPPE_Indisponibilites;

class LPPEIndisponibilitesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LPPE_Indisponibilites::factory()->count(10)->create();
    }
}
