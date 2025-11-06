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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->string('email')->unique();
            $table->string('genero');
            $table->string('cpf', 11)->unique();
            $table->string('password');
            $table->string('telefone', 11)->unique();
            $table->string('endereco', 200);
            $table->date('data_de_nascimento');
            $table->timestamps();
            $table->integer('qntd_recebida')->default(0)->change();
            $table->integer('qntd_doada')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
