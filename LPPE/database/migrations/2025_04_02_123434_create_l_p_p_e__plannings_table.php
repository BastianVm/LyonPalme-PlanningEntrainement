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
        Schema::create('l_p_p_e__plannings', function (Blueprint $table) {
            $table->id('id_planning');
            $table->date('date_création');
            $table->unsignedBigInteger('id_responsable');
            $table->timestamps();

            $table->foreign('id_responsable')
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
        Schema::dropIfExists('l_p_p_e__plannings');
    }
};
