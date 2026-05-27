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
        return $this->belongsTo(Paciente::class, 'id_paciente');
    }

    // Relación muchos a uno con Dentista
    public function dentista()
    {
        return $this->belongsTo(Dentista::class, 'id_dentista');
    }

    public function tratamientos()
{
    return $this->belongsToMany(Tratamiento::class, 'cita_tratamiento', 'id_cita', 'id_tratamiento');
}

    
    // Relación uno a uno con Pago
    public function pagos()
    {
        return $this->hasOne(Pago::class, 'id_cita');
    }
}
