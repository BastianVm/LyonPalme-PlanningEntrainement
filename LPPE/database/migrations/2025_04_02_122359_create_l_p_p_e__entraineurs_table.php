<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('l_p_p_e__entraineurs', function (Blueprint $table) {
            $table->id('id_entraineur');
            $table->text('nom');
            $table->text('prenom');
            $table->text('email');
            $table->text('identifiant');
            $table->text('mdp');
            $table->text('rôle');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('l_p_p_e__entraineurs');
    }
};
