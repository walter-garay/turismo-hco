<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destino extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'ubicacion',
        'historia',
        'categoria',
    ];

    public function actividades()
    {
        return $this->hasMany(Actividad::class);
    }

    public function paquetes()
    {
        return $this->hasMany(PaqueteTuristico::class);
    }

    public function resenas()
    {
        return $this->hasMany(Resena::class);
    }

    public function fotos()
    {
        return $this->hasMany(FotoDestino::class);
    }
}
