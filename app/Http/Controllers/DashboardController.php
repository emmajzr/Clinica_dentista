<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Tratamiento;
use App\Models\Pago;
use App\Models\Paciente;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Verificar si el usuario es paciente y tiene registro en tabla pacientes
        if ($user->rol === 'paciente') {
            $paciente = $user->paciente;
            
            if (!$paciente) {
                // Redirigir al formulario de registro de paciente con mensaje
                return redirect()->route('paciente.register')
                    ->with('warning', 'Por favor completa tu registro para acceder al dashboard.');
            }
        }

        // Si es admin o dentista, o paciente con registro completo, continuar normal
        $miembro_desde = $user->created_at->diffForHumans();

        // Resto de consultas según rol (las que ya tenías)
        if ($user->rol == 'paciente') {
            $citas = Cita::where('id_paciente', $paciente->id)
                ->where('estado', 'completada')
                ->count();

            $proxima_cita = Cita::where('id_paciente', $paciente->id)
                ->where('estado', 'pendiente')
                ->where('fecha', '>=', now()->toDateString())
                ->orderBy('fecha', 'asc')
                ->orderBy('hora', 'asc')
                ->first();

            $tratamientos_realizados = Tratamiento::whereHas('citas', function ($q) use ($paciente) {
                $q->where('id_paciente', $paciente->id)->where('estado', 'completada');
            })->count();

            // Últimas 3 atenciones
            $ultimas_atenciones = Cita::with(['dentista.user', 'tratamientos'])
                ->where('id_paciente', $paciente->id)
                ->where('estado', 'confirmada')
                ->orderBy('fecha', 'desc')
                ->orderBy('hora', 'desc')
                ->take(3)
                ->get();


            // Últimos 3 pagos + total pagado
            $ultimos_pagos = Pago::whereHas('cita', function ($q) use ($paciente) {
                $q->where('id_paciente', $paciente->id);
            })->orderBy('fecha_pago', 'desc')->take(3)->get();

            $total_pagado = Pago::whereHas('cita', function ($q) use ($paciente) {
                $q->where('id_paciente', $paciente->id);
            })->sum('monto');

            return view('dashboard.paciente', compact(
                'miembro_desde', 'citas', 'proxima_cita', 'tratamientos_realizados',
                'ultimas_atenciones', 'ultimos_pagos', 'total_pagado'
            ));
        }
        
    }
}