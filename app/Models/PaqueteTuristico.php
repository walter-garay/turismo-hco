<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaqueteTuristico extends Model
{
    use HasFactory;

    protected $table = 'paquetes_turisticos';


    protected $fillable = [
        'nombre',
        'descripcion',
        'precio_individual',
        'duracion',
        'destino_id',
    ];

    public function actividades()
    {
        return $this->belongsToMany(Actividad::class, 'paquete_actividades', 'paquete_id', 'actividad_id');
    }

    public function destino()
    {
        return $this->belongsTo(Destino::class);
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
}
