<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaqueteActividad extends Model
{
    use HasFactory;
    
    protected $table = 'paquete_actividades';

    protected $fillable = [
        'paquete_id',
        'actividad_id',
    ];

    public function paquete()
    {
        return $this->belongsTo(PaqueteTuristico::class);
    }

    public function actividad()
    {
        return $this->belongsTo(Actividad::class);
    }
}
