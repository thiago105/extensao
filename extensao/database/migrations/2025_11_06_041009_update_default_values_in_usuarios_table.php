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
        Schema::table('usuarios', function (Blueprint $table) {
            $table->integer('qntd_recebida')->default(0)->change();
            $table->integer('qntd_doada')->default(0)->change();
        });
    }
    
    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->integer('qntd_recebida')->change();
            $table->integer('qntd_doada')->change();
        });
    }
    
};
