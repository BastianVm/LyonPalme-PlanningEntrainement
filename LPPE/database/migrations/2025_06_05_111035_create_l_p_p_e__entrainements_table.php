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
        Schema::create('l_p_p_e__entrainements', function (Blueprint $table) {
            $table->id('id_entrainement');
            $table->string('titre');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('id_seance')->unique();
            $table->unsignedBigInteger('id_entraineur');
            $table->timestamps();

            $table->foreign('id_seance')
                ->references('id_seance')
                ->on('l_p_p_e__seances')
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
        Schema::dropIfExists('l_p_p_e__entrainements');
    }
};
