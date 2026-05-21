<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $table = 'citas';

    protected $fillable = [
        'fecha',
        'hora',
        'estado',
        'motivo',
        'id_paciente',
        'id_dentista',
    ];

    // Relación muchos a uno con Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    // Relación muchos a uno con Dentista
    public function dentista()
    {
        return $this->belongsTo(Dentista::class);
    }

    // Relación muchos a muchos con Tratamiento
    public function tratamientos()
    {
        return $this->hasMany(Tratamiento::class);
    }
    
    // Relación uno a uno con Pago
    public function pagos()
    {
        return $this->hasOne(Pago::class);
    }
}
