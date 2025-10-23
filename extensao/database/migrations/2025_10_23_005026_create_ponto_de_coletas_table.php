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
        Schema::create('ponto_de_coletas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_instituicao');
            $table->string('endereco', 200);
            $table->timestamp('data_inicio');
            $table->timestamp('data_fim');
            $table->timestamps();

            $table->foreign('id_instituicao')
            ->references('id')
            ->on('instituicaos')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ponto_de_coletas');
    }
};
