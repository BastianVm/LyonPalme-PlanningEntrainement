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
        Schema::create('l_p_p_e__seances', function (Blueprint $table) {
            $table->id('id_seance');
            $table->date('date_seance');
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->unsignedBigInteger('id_planning');
            $table->unsignedBigInteger('id_entraineur');
            $table->timestamps();

        $table->foreign('id_planning')
        ->references('id_planning')
        ->on('l_p_p_e__plannings')
        ->onDelete('cascade');

        $table->foreign('id_entraineur')
        ->references('id_entraineur')
        ->on('l_p_p_e__entraineurs')
        ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('l_p_p_e__seances');
    }
};
