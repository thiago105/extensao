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
        Schema::create('itens_doacao', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_doacao');
            $table->unsignedBigInteger('id_mateirais_coletados');
            $table->integer('quantidade');
            $table->timestamps();
    
            $table->foreign('id_doacao')->references('id')->on('doacaos')->onDelete('cascade');
            $table->foreign('id_mateirais_coletados')->references('id')->on('mateirais_coletados')->onDelete('cascade');
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
