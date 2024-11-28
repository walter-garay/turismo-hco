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
        Schema::table('reservas', function (Blueprint $table) {
            // Eliminar la llave foránea
            $table->dropForeign(['itinerario_id']);
            // Eliminar la columna itinerario_id si ya no la necesitas
            $table->dropColumn('itinerario_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservas', function (Blueprint $table) {
            // Restaurar la columna itinerario_id
            $table->foreignId('itinerario_id')->constrained('itinerarios')->onDelete('cascade');
        });
    }
};
