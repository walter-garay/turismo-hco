<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItinerarioActividad extends Model
{
    use HasFactory;

    protected $table = 'itinerario_actividades';

    protected $fillable = [
        'itinerario_id',
        'actividad_id',
        'fecha',
        'hora_inicio',
        'hora_fin',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    public function itinerario()
    {
        return $this->belongsTo(Itinerario::class);
    }

    public function actividad()
    {
        return $this->belongsTo(Actividad::class);
    }
}
