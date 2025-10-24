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
        Schema::create('materiais', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_materiais_coletado');
            $table->unsignedBigInteger('id_ponto_de_coleta');
            $table->timestamps();

            $table->foreign('id_materiais_coletado')
            ->references('id')
            ->on('mateirais_coletados')
            ->onDelete('cascade');

            $table->foreign('id_ponto_de_coleta')
            ->references('id')
            ->on('ponto_de_coletas')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materiais');
    }
};
