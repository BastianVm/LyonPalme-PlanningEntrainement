<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LPPE_Entraineurs;

class LPPEEntraineursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LPPEEntraineurs::factory(10)->create();
    }
}
