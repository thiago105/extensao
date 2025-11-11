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
        Schema::create('estoque_instituicaos', function (Blueprint $table) {
           $table->id();
            $table->unsignedBigInteger('instituicaos_id');
            $table->unsignedBigInteger('material_id');
            $table->integer('quantidade');
            $table->timestamps();

            $table->foreign('instituicaos_id')->references('id')->on('instituicaos')->onDelete('cascade');
            $table->foreign('material_id')->references('id')->on('material')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estoque_instituicaos');
    }
};
