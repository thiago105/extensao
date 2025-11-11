<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doacao_recebida', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('ponto_de_coletas_id');
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('ponto_de_coletas_id')->references('id')->on('ponto_de_coletas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doacaos');
    }
};
