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
        Schema::create('actividades', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->integer('duracion'); // en minutos
            $table->decimal('precio', 8, 2);
            $table->enum('tipo', ['actividad', 'evento']);
            $table->string('categoria');
            $table->date('fecha_evento');
            $table->timestamps();

            $table->foreignId('destino_id')->constrained('destinos')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actividads');
    }
};
