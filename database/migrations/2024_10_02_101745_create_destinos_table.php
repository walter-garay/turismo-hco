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
        Schema::create('destinos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->index(); // Index para búsquedas rápidas por nombre
            $table->text('descripcion')->nullable();
            $table->string('ubicacion')->nullable();
            $table->string('direccion')->nullable(); // Campo 'direccion'
            $table->decimal('latitud', 10, 7)->nullable(); // Campo 'latitud' para coordenadas
            $table->decimal('longitud', 10, 7)->nullable(); // Campo 'longitud' para coordenadas
            $table->text('historia')->nullable();
            $table->string('categoria', 100)->index(); // Índice para buscar por categoría
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinos');
    }
};
