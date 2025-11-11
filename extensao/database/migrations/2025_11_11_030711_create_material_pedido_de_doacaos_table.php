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
        Schema::create('material_pedido_de_doacao', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('material_id');
            $table->unsignedBigInteger('pedido_de_doacao_id');
            $table->integer('quantidade');
            $table->timestamps();

            $table->foreign('material_id')->references('id')->on('material');
            $table->foreign('pedido_de_doacao_id')->references('id')->on('pedido_de_doacao');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_pedido_de_doacao');
    }
};
