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
        Schema::create('terminos', function (Blueprint $table) {
            $table->id();
            $table->string('termino',255);
            $table->string('descripcion',255);
            $table->string('imagen')->nullable(); // Permitir valores nulos en el campo 'imagen'
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