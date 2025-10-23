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
        Schema::create('item_doados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_materiais_coletado');
            $table->timestamps();

            $table->foreign('id_materiais_coletado')
            ->references('id')
            ->on('mateirais_coletados')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_doados');
    }
};
