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
        Schema::create('multimedia_entradas', function (Blueprint $table) {
            $table->id();
            $table->string('url'); 
            $table->string('tipo'); 
            $table->foreignId('id_entrada')->constrained('entradas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('multimedia_entradas');
    }
};
