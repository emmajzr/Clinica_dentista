<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'pacientes';

    protected $fillable = [
        'telefono',
        'calle',
        'numero_exterior',
        'fraccionamiento',
        'codigo_postal',
        'genero',
        'fecha_nacimiento',
        'id_user',
    ];

    // Relación uno a uno con User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación uno a muchos con Cita
    public function citas()
    {
        return $this->hasMany(Cita::class);
    }

}
