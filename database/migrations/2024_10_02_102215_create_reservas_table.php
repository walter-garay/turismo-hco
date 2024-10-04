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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('paquete_id')->constrained('paquetes_turisticos')->onDelete('cascade');

            $table->enum('estado', ['confirmada', 'cancelada', 'pendiente de pago']);
            $table->dateTime('fecha_reserva');
            $table->integer('num_personas');
            $table->decimal('precio_total', 8, 2);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
