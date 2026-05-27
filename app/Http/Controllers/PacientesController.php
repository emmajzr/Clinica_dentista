<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacientesController extends Controller
{
    // Mostrar formulario para completar registro
    public function registro_informacion()
    {
        return view('paciente.registro');
    }

    // Guardar información del paciente
    public function guardarRegistro(Request $request)
    {
        $user = auth()->user();

        // Validación básica (ajusta según tus campos)
        $request->validate([
            'telefono' => 'required|string|max:11',
            'calle' => 'required|string|max:255',
            'numero_exterior' => 'required|string|max:10',
            'fraccionamiento' => 'required|string|max:255',
            'codigo_postal' => 'required|string|max:10',
            'genero' => 'required|in:masculino,femenino,Sin especificar',
            'fecha_nacimiento' => 'required|date',
        ]);

        // Crear registro en tabla pacientes
        Paciente::create([
            'user_id' => $user->id,
            'telefono' => $request->telefono,
            'calle' => $request->calle,
            'numero_exterior' => $request->numero_exterior,
            'fraccionamiento' => $request->fraccionamiento,
            'codigo_postal' => $request->codigo_postal,
            'genero' => $request->genero,
            'fecha_nacimiento' => $request->fecha_nacimiento,
        ]);

        return redirect()->route('dashboard')->with('success', '¡Registro completado! Bienvenido a tu panel.');
    }
}