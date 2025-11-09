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
        Schema::create('mateirais_coletados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_instituicao');
            $table->string('material', 100);
            $table->string('condicao');
            $table->integer('quantidade');
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
        Schema::dropIfExists('mateirais_coletados');
    }
};
