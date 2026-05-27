<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Paciente;
use App\Models\Pago;
use App\Models\Tratamiento;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Verificar si el usuario es paciente y tiene registro en tabla pacientes
        if ($user->rol === 'paciente') {
            $paciente = $user->paciente;

            if (! $paciente) {
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

            $proxima_cita = Cita::with('dentista.user')
                ->where('id_paciente', $paciente->id)
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

            // Pagos agrupados últimos 3 meses desde hoy
            $ultimos_pagos = Pago::whereHas('cita', function ($q) use ($paciente) {
                $q->where('id_paciente', $paciente->id);
            })
                ->where('fecha_pago', '>=', now()->subMonths(3))
                ->select(
                    DB::raw('YEAR(fecha_pago) as anio'),
                    DB::raw('MONTH(fecha_pago) as mes'),
                    DB::raw('SUM(monto) as total_mes')
                )
                ->groupBy('anio', 'mes')
                ->orderBy('anio', 'desc')
                ->orderBy('mes', 'desc')
                ->take(3)
                ->get();

            // Total pagado acumulado en el año actual
            $total_pagado = Pago::whereHas('cita', function ($q) use ($paciente) {
                $q->where('id_paciente', $paciente->id);
            })
                ->whereYear('fecha_pago', now()->year)
                ->sum('monto');

            return view('dashboard', compact(
                'citas',
                'proxima_cita',
                'tratamientos_realizados',
                'ultimas_atenciones',
                'ultimos_pagos',
                'total_pagado',
                'miembro_desde'
            ));
        }

    }
}
