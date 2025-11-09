<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doacaos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_instituicao');
            $table->unsignedBigInteger('id_usuario');
            $table->enum('tipo', ['Material', 'Dinheiro']);
            $table->string('endereco_destino', 200);
            $table->date('data_prevista_entrega');
            $table->string('status', 50)->default('Pendente');
            $table->timestamps();

            $table->foreign('id_instituicao')->references('id')->on('instituicaos')->onDelete('cascade');
            $table->foreign('id_usuario')->references('id')->on('usuarios')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doacaos');
    }
};
