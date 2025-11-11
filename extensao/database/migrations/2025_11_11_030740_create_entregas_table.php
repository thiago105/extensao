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
        Schema::create('entrega', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('instituicaos_id');
            $table->unsignedBigInteger('pedido_de_doacao_id');
            $table->timestamps();

            $table->foreign('instituicaos_id')->references('id')->on('instituicaos')->onDelete('cascade');
            $table->foreign('pedido_de_doacao_id')->references('id')->on('pedido_de_doacao')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrega');
    }
};