{{-- resources/views/dashboard/admin.blade.php --}}
<div class="space-y-6">
    {{-- Tarjetas de estadísticas --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div
            class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-all group"
        >
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Pacientes</p>
                    <p class="text-3xl font-bold text-slate-800 mt-1">1,284</p>
                    <p class="text-green-600 text-xs mt-2">
                        <i class="fas fa-arrow-up"></i> 12% este mes
                    </p>
                </div>
                <div
                    class="w-12 h-12 bg-cyan-100 rounded-lg flex items-center justify-center group-hover:bg-cyan-600 transition"
                >
                    <i
                        class="fas fa-users text-cyan-600 text-xl group-hover:text-white"
                    ></i>
                </div>
            </div>
        </div>

        <div
            class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-all group"
        >
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Citas Hoy</p>
                    <p class="text-3xl font-bold text-slate-800 mt-1">24</p>
                    <p class="text-orange-600 text-xs mt-2">
                        <i class="fas fa-clock"></i> 8 pendientes
                    </p>
                </div>
                <div
                    class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-600 transition"
                >
                    <i
                        class="fas fa-calendar-check text-blue-600 text-xl group-hover:text-white"
                    ></i>
                </div>
            </div>
        </div>

        <div
            class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-all group"
        >
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Ingresos del Mes</p>
                    <p class="text-3xl font-bold text-slate-800 mt-1">$45,280</p>
                    <p class="text-green-600 text-xs mt-2">
                        <i class="fas fa-arrow-up"></i> 18% vs mes anterior
                    </p>
                </div>
                <div
                    class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-600 transition"
                >
                    <i
                        class="fas fa-dollar-sign text-green-600 text-xl group-hover:text-white"
                    ></i>
                </div>
            </div>
        </div>

        <div
            class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-all group"
        >
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Dentistas Activos</p>
                    <p class="text-3xl font-bold text-slate-800 mt-1">12</p>
                    <p class="text-blue-600 text-xs mt-2">
                        <i class="fas fa-user-md"></i> 3 especialistas
                    </p>
                </div>
                <div
                    class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center group-hover:bg-purple-600 transition"
                >
                    <i
                        class="fas fa-tooth text-purple-600 text-xl group-hover:text-white"
                    ></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Gráficos y tablas --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Citas por día (Gráfico) --}}
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-slate-800">
                    <i class="fas fa-chart-line text-cyan-600 mr-2"></i>Citas de
                    la Semana
                </h3>
                <select class="text-sm border rounded-lg px-2 py-1">
                    <option>Esta semana</option>
                    <option>Semana pasada</option>
                </select>
            </div>
            <div
                class="h-64 flex items-center justify-center bg-gray-50 rounded-lg"
            >
                <canvas id="citasChart" class="w-full h-full"></canvas>
            </div>
        </div>

        {{-- Próximas citas --}}
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-slate-800">
                    <i class="fas fa-calendar-week text-cyan-600 mr-2"></i
                    >Próximas Citas
                </h3>
                <a href="#" class="text-cyan-600 text-sm hover:underline"
                    >Ver todas</a
                >
            </div>
            <div class="space-y-3">
                @foreach ([1,2,3,4] as $cita)
                    <div
                        class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition"
                    >
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 bg-cyan-100 rounded-full flex items-center justify-center"
                            >
                                <i class="fas fa-user text-cyan-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-slate-800">María González</p>
                                <p class="text-xs text-gray-500">
                                    <i class="fas fa-tooth mr-1"></i> Dra. Laura
                                    Martínez
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-semibold text-slate-800">10:00 AM</p>
                            <p class="text-xs text-gray-500">Hoy</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Tabla de pacientes recientes --}}
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-semibold text-slate-800">
                <i class="fas fa-user-plus text-cyan-600 mr-2"></i>Pacientes
                Recientes
            </h3>
            <a href="#" class="text-cyan-600 text-sm hover:underline"
                >Ver todos</a
            >
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th
                            class="text-left p-3 text-xs font-semibold text-gray-500"
                        >
                            Paciente
                        </th>
                        <th
                            class="text-left p-3 text-xs font-semibold text-gray-500"
                        >
                            Email
                        </th>
                        <th
                            class="text-left p-3 text-xs font-semibold text-gray-500"
                        >
                            Teléfono
                        </th>
                        <th
                            class="text-left p-3 text-xs font-semibold text-gray-500"
                        >
                            Última cita
                        </th>
                        <th
                            class="text-left p-3 text-xs font-semibold text-gray-500"
                        >
                            Estado
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ([1,2,3,4,5] as $paciente)
                        <tr
                            class="border-b border-gray-100 hover:bg-gray-50 transition"
                        >
                            <td class="p-3">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-8 h-8 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-full flex items-center justify-center text-white text-xs font-bold"
                                    >
                                        M
                                    </div>
                                    <span class="text-sm">María López</span>
                                </div>
                            </td>
                            <td class="p-3 text-sm text-gray-600">
                                maria@email.com
                            </td>
                            <td class="p-3 text-sm text-gray-600">
                                +51 987 654 321
                            </td>
                            <td class="p-3 text-sm text-gray-600">
                                2024-01-15
                            </td>
                            <td class="p-3">
                                <span
                                    class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs"
                                >
                                    <i class="fas fa-check-circle mr-1"></i
                                    >Activo
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById("citasChart").getContext("2d");
    new Chart(ctx, {
        type: "line",
        data: {
            labels: ["Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
            datasets: [
                {
                    label: "Citas",
                    data: [12, 19, 15, 17, 14, 8],
                    borderColor: "#0ea5e9",
                    backgroundColor: "rgba(14, 165, 233, 0.1)",
                    tension: 0.4,
                    fill: true,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                },
            },
        },
    });
</script>
