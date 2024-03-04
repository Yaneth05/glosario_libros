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
        Schema::create('terminos', function (Blueprint $table) {//lo dejare como termino
            $table->id();//clave
            $table->string('nombre',255);//era termino
            $table->string('autor',255);//era descripcion
            $table->string('fechaPublicacion', 255);//nuevo
            $table->string('editorial', 255);//nuevo
            $table->string('imagen')->nullable(); // Permitir valores nulos en el campo 'imagen'-->portada
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('terminos');
    }
};