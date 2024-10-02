<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itinerario extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'nombre',
        'fecha_creacion',
        'destino_id',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function destino()
    {
        return $this->belongsTo(Destino::class);
    }

    public function actividades()
    {
        return $this->belongsToMany(Actividad::class, 'itinerario_actividades');
    }
}
