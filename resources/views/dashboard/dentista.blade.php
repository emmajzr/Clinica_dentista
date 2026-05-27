{{-- resources/views/dashboard/dentista.blade.php --}}
<div class="space-y-6">
    {{-- Tarjetas de estadísticas --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Citas Hoy</p>
                    <p class="text-3xl font-bold text-slate-800 mt-1">6</p>
                    <p class="text-blue-600 text-xs mt-2">
                        <i class="fas fa-clock"></i> 2 pendientes
                    </p>
                </div>
                <div
                    class="w-12 h-12 bg-cyan-100 rounded-lg flex items-center justify-center"
                >
                    <i class="fas fa-calendar-day text-cyan-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Pacientes Atendidos</p>
                    <p class="text-3xl font-bold text-slate-800 mt-1">142</p>
                    <p class="text-green-600 text-xs mt-2">
                        <i class="fas fa-arrow-up"></i> 8 este mes
                    </p>
                </div>
                <div
                    class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center"
                >
                    <i class="fas fa-heartbeat text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Tratamientos Realizados</p>
                    <p class="text-3xl font-bold text-slate-800 mt-1">87</p>
                    <p class="text-purple-600 text-xs mt-2">
                        <i class="fas fa-chart-line"></i> Eficiencia 94%
                    </p>
                </div>
                <div
                    class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center"
                >
                    <i class="fas fa-stethoscope text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Próxima Cita</p>
                    <p class="text-xl font-bold text-slate-800 mt-1">10:30 AM</p>
                    <p class="text-gray-500 text-xs mt-2">
                        <i class="fas fa-user"></i> Carlos Ruiz
                    </p>
                </div>
                <div
                    class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center"
                >
                    <i class="fas fa-bell text-orange-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Agenda del día --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <h3 class="font-semibold text-slate-800 mb-4">
                <i class="fas fa-calendar-alt text-cyan-600 mr-2"></i>Agenda del
                Día
            </h3>
            <div class="space-y-3">
                @foreach (['09:00', '10:30', '12:00', '15:00', '16:30'] as $hora)
                    <div
                        class="flex items-center justify-between p-3 bg-gray-50 rounded-lg"
                    >
                        <div class="flex items-center gap-3">
                            <div class="w-12 text-center">
                                <p class="font-bold text-slate-800">{{ $hora }}</p>
                            </div>
                            <div class="w-px h-8 bg-gray-300"></div>
                            <div>
                                <p class="font-medium text-slate-800">Paciente #{{ $loop->iteration }}</p>
                                <p class="text-xs text-gray-500">Consulta general</p>
                            </div>
                        </div>
                        <button
                            class="text-cyan-600 hover:text-cyan-700 text-sm"
                        >
                            <i class="fas fa-check-circle"></i> Atender
                        </button>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Últimos pacientes --}}
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <h3 class="font-semibold text-slate-800 mb-4">
                <i class="fas fa-user-friends text-cyan-600 mr-2"></i>Últimos
                Pacientes
            </h3>
            <div class="space-y-3">
                @foreach ([1,2,3,4,5] as $paciente)
                    <div
                        class="flex items-center gap-3 p-2 hover:bg-gray-50 rounded-lg transition"
                    >
                        <div
                            class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center"
                        >
                            <i class="fas fa-user text-gray-500"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-slate-800">Ana Martínez</p>
                            <p class="text-xs text-gray-500">Última visita: 2024-01-10</p>
                        </div>
                        <button class="text-cyan-600">
                            <i class="fas fa-file-medical"></i>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Próximos tratamientos --}}
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <h3 class="font-semibold text-slate-800 mb-4">
            <i class="fas fa-list-check text-cyan-600 mr-2"></i>Próximos
            Tratamientos Programados
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach (['Limpieza dental', 'Extracción', 'Blanqueamiento', 'Ortodoncia'] as $tratamiento)
                <div
                    class="flex items-center justify-between p-3 bg-gray-50 rounded-lg"
                >
                    <div>
                        <p class="font-medium text-slate-800">{{ $tratamiento }}</p>
                        <p class="text-xs text-gray-500">15 pacientes pendientes</p>
                    </div>
                    <span
                        class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs"
                    >
                        Programado
                    </span>
                </div>
            @endforeach
        </div>
    </div>
</div>
