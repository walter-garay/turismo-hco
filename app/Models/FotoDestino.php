<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoDestino extends Model
{
    use HasFactory;

    protected $fillable = ['destino_id', 'url'];

    public function destino()
    {
        return $this->belongsTo(Destino::class);
    }
}
