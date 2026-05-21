<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita_tratamiento extends Model
{
    protected $table = 'cita_tratamiento';

    protected $fillable = [
        'id_cita',
        'id_tratamiento',
    ];

    // Relación con Cita y Tratamiento
    public function cita()
    {
        return $this->belongsTo(Cita::class);
    }

    // Relación con Tratamiento
    public function tratamiento()
    {
        return $this->belongsTo(Tratamiento::class);
    }
}
