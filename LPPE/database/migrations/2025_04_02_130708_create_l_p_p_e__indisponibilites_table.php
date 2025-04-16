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
        Schema::create('l_p_p_e__indisponibilites', function (Blueprint $table) {
            $table->id('id_indispo');
            $table->text('motif');
            $table->text('statut');
            $table->unsignedBigInteger('id_entraineur');
            $table->unsignedBigInteger('id_seance');
            $table->unsignedBigInteger('id_entraineur_remplacant')->nullable();
            $table->timestamps();

        
        $table->foreign('id_entraineur')
        ->references('id_entraineur')
        ->on('l_p_p_e__entraineurs')
        ->onDelete('cascade');

        $table->foreign('id_seance')
        ->references('id_seance')
        ->on('l_p_p_e__seances')
        ->onDelete('cascade');

        $table->foreign('id_entraineur_remplacant')
        ->references('id_entraineur')
        ->on('l_p_p_e__entraineurs')
        ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('l_p_p_e__indisponibilites');
    }
};
