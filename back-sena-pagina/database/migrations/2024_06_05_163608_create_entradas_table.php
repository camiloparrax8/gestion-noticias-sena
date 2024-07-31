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
        Schema::create('entradas', function (Blueprint $table) {
            $table->id(); 
            $table->string('titulo');
            $table->string('titulo_ingles');
            $table->string('titulo_emb');
            $table->text('descripcion_corta'); 
            $table->text('descripcion_larga');
            $table->text('descripcion_corta_ingles');
            $table->text('descripcion_larga_ingles');
            $table->text('descripcion_corta_emb');
            $table->text('descripcion_larga_emb');
            $table->foreignId('id_autor')->constrained('autores'); 
            $table->foreignId('id_usuario')->constrained('users'); 
            $table->string('miniatura'); 
            $table->timestamps();
            $table->boolean('is_delete')->nullable()->default(0);
            $table->timestamp('delete_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entradas');
    }
};
