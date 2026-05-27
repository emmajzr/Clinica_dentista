{{-- resources/views/dashboard/paciente.blade.php --}}
<x-app-layout>
<div class="space-y-6">
    {{-- Tarjeta de bienvenida personalizada --}}
    <div class="bg-gradient-to-r from-cyan-500 to-blue-600 rounded-2xl shadow-lg p-6 text-white">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <p class="text-cyan-100 text-sm">
                    <i class="fas fa-star-of-life mr-1"></i> Miembro desde {{$miembro_desde}}
                </p>
                <h2 class="text-2xl font-bold mt-1">¡Hola, {{ Auth::user()->nombre }}!</h2>
                <p class="text-cyan-100 mt-2">Tu salud dental es nuestra prioridad</p>
                <button class="mt-4 bg-white text-cyan-600 px-4 py-2 rounded-lg font-semibold text-sm hover:bg-gray-100 transition">
                    <i class="fas fa-calendar-plus mr-2"></i>Agendar nueva cita
                </button>
            </div>
            <div class="text-7xl opacity-80">
                <i class="fas fa-smile-wink"></i>
            </div>
        </div>
    </div>

    {{-- Estadísticas personales --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Citas Completadas</p>
                    <p class="text-3xl font-bold text-slate-800 mt-1">{{ $citas }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
    @if($proxima_cita)
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">
                    <i class="fas fa-calendar-check text-green-500 mr-1"></i> Próxima Cita
                </p>
                <p class="text-xl font-bold text-slate-800 mt-1">
                    {{ \Carbon\Carbon::parse($proxima_cita->fecha)->isoFormat('LL') }}
                </p>
                <div class="flex items-center gap-2 mt-1">
                    <p class="text-gray-500 text-xs">
                        <i class="fas fa-clock mr-1"></i> {{ date('h:i A', strtotime($proxima_cita->hora)) }}
                    </p>
                    @if($proxima_cita->dentista)
                        <p class="text-xs text-cyan-600">
                            <i class="fas fa-user-md mr-1"></i> {{ $proxima_cita->dentista->nombre }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="w-12 h-12 bg-gradient-to-br from-orange-400 to-orange-600 rounded-lg flex items-center justify-center shadow-md">
                <i class="fas fa-calendar-alt text-white text-xl"></i>
            </div>
        </div>
        
        {{-- Contador de días restantes --}}
        @php
            $dias_restantes = now()->diffInDays(\Carbon\Carbon::parse($proxima_cita->fecha), false);
        @endphp
        @if($dias_restantes >= 0)
            <div class="mt-3 bg-cyan-50 rounded-lg p-2">
                <p class="text-xs text-cyan-700 text-center">
                    <i class="fas fa-hourglass-half mr-1"></i>
                    @if($dias_restantes == 0)
                        ¡Es hoy! 🎉
                    @elseif($dias_restantes == 1)
                        Mañana es tu cita
                    @else
                        Faltan {{ $dias_restantes }} días
                    @endif
                </p>
            </div>
        @endif
        
        <div class="mt-3 flex gap-2">
            <a href="#" 
               class="flex-1 text-center px-3 py-2 bg-cyan-600 text-white text-xs rounded-lg hover:bg-cyan-700 transition">
                <i class="fas fa-eye mr-1"></i> Ver detalles
            </a>
            <a href="{{ route('citas.reprogramar', $proxima_cita->id) }}" 
               class="px-3 py-2 bg-gray-100 text-gray-700 text-xs rounded-lg hover:bg-gray-200 transition">
                <i class="fas fa-edit"></i>
            </a>
        </div>
    @else
        <div class="text-center py-6">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-calendar-times text-2xl text-gray-400"></i>
            </div>
            <p class="text-gray-500 font-medium">No hay citas programadas</p>
            <p class="text-gray-400 text-xs mt-1">Agenda tu primera cita dental</p>
            <a href="#" 
               class="inline-flex items-center gap-2 mt-4 px-4 py-2 bg-cyan-600 text-white text-sm rounded-lg hover:bg-cyan-700 transition shadow-sm">
                <i class="fas fa-plus-circle"></i>
                Agendar nueva cita
            </a>
        </div>
    @endif
</div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Tratamientos Realizados</p>
                    <p class="text-3xl font-bold text-slate-800 mt-1">{{ $tratamientos_realizados }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-stethoscope text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Próximas citas --}}
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-semibold text-slate-800">
                <i class="fas fa-calendar-week text-cyan-600 mr-2"></i>Mis Próximas Citas
            </h3>
            <a href="#" class="text-cyan-600 text-sm hover:underline">Ver historial</a>
        </div>
        
        @if(true)
        <div class="space-y-3">
            @foreach([1,2] as $cita)
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center gap-4">
                    <div class="w-16 text-center">
                        <p class="text-2xl font-bold text-cyan-600">25</p>
                        <p class="text-xs text-gray-500">Ene</p>
                    </div>
                    <div>
                        <p class="font-semibold text-slate-800">Consulta de seguimiento</p>
                        <p class="text-sm text-gray-500">
                            <i class="fas fa-clock mr-1"></i> 10:00 AM - 
                            <i class="fas fa-tooth mr-1 ml-2"></i> Dra. Laura Martínez
                        </p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button class="px-3 py-1 bg-cyan-100 text-cyan-700 rounded-lg text-sm hover:bg-cyan-200 transition">
                        <i class="fas fa-edit"></i> Reprogramar
                    </button>
                    <button class="px-3 py-1 bg-red-100 text-red-700 rounded-lg text-sm hover:bg-red-200 transition">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-8">
            <i class="fas fa-calendar-times text-5xl text-gray-300 mb-3"></i>
            <p class="text-gray-500">No tienes citas programadas</p>
            <button class="mt-3 text-cyan-600 hover:underline">Agendar una cita</button>
        </div>
        @endif
    </div>

    {{-- Historial de tratamientos --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <h3 class="font-semibold text-slate-800 mb-4">
                <i class="fas fa-history text-cyan-600 mr-2"></i>Últimas atenciones
            </h3>
            <div class="space-y-3">
                @foreach($ultimas_atenciones as $atencion)
<div class="flex items-center justify-between p-3 border-b border-gray-100">
    <div>
        <p class="font-medium text-slate-800">
            {{ $atencion->tratamientos->pluck('nombre_tratamiento')->implode(', ') }} 
            / {{$atencion->fecha}}
        </p>
        <p class="text-xs text-gray-500">
            Atendido por: {{ $atencion->dentista->user->nombre ?? 'N/A' }} {{ $atencion->dentista->user->apellido_paterno ?? 'N/A' }}
        </p>
    </div>
    <button class="text-cyan-600 text-sm">
        <i class="fas fa-file-pdf"></i> Ver detalles
    </button>
</div>
@endforeach
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <h3 class="font-semibold text-slate-800 mb-4">
                <i class="fas fa-credit-card text-cyan-600 mr-2"></i>Historial de Pagos
            </h3>
            <div class="space-y-3">
                @foreach(['Ene 2024 - $120.00', 'Dic 2023 - $350.00', 'Nov 2023 - $200.00'] as $pago)
                <div class="flex items-center justify-between p-3 border-b border-gray-100">
                    <div>
                        <p class="font-medium text-slate-800">{{ $pago }}</p>
                        <p class="text-xs text-green-600">
                            <i class="fas fa-check-circle"></i> Pagado
                        </p>
                    </div>
                    <span class="text-gray-500 text-sm">#FAC-{{ rand(1000,9999) }}</span>
                </div>
                @endforeach
            </div>
            <div class="mt-4 p-3 bg-cyan-50 rounded-lg">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Total pagado este año:</span>
                    <span class="font-bold text-cyan-600">$670.00</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Consejos de salud dental --}}
    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl p-6 border border-cyan-100">
        <div class="flex items-start gap-3">
            <div class="text-3xl">🦷</div>
            <div>
                <h4 class="font-semibold text-slate-800">Consejo de salud dental</h4>
                <p class="text-gray-600 text-sm mt-1">Recuerda cepillar tus dientes después de cada comida y usar hilo dental diariamente. ¡Tu sonrisa es importante!</p>
                <button class="mt-2 text-cyan-600 text-sm hover:underline">
                    Ver más consejos <i class="fas fa-arrow-right ml-1"></i>
                </button>
            </div>
        </div>
    </div>
</div>
</x-app-layout>