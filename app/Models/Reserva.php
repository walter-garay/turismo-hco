<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'paquete_id',
        'estado',
        'fecha_reserva',
        'num_personas',
        'precio_total',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function paquete()
    {
        return $this->belongsTo(PaqueteTuristico::class);
    }
}
