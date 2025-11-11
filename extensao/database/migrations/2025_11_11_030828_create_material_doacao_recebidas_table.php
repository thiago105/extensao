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
        Schema::create('material_doacao_recebida', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('material_id');
            $table->unsignedBigInteger('doacao_recebida_id');
            $table->string('estado', 100);
            $table->integer('quantidade');
            $table->timestamps();
    
            $table->foreign('doacao_recebida_id')->references('id')->on('doacao_recebida')->onDelete('cascade');
            $table->foreign('material_id')->references('id')->on('material')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itens_doacao');
    }
};
