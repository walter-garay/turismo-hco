<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'hora_inicio',
        'hora_fin',
        'duracion',
        'precio',
        'tipo',  // 'actividad' o 'evento'
        'categoria',
        'fecha_evento',
        'destino_id',
    ];

    public function destino()
    {
        return $this->belongsTo(Destino::class);
    }

    public function itinerarios()
    {
        return $this->belongsToMany(Itinerario::class, 'itinerario_actividades');
    }

    public function paquetes()
    {
        return $this->belongsToMany(PaqueteTuristico::class, 'paquete_actividades');
    }
}
