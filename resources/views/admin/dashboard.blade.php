@extends('admin.layout')
@section('title','Panel de Administración')

@section('content')
<div class="p-6">

    {{-- Encabezado --}}
    <div class="flex items-center gap-2 mb-8 border-b border-blue-200 pb-3">
        <i data-lucide="layout-dashboard" class="w-6 h-6 text-blue-600"></i>
        <h1 class="text-2xl font-bold text-gray-800">Panel del Administrador</h1>
    </div>

    {{-- Métricas principales --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
        <div class="bg-white rounded-xl shadow-sm p-5 text-center border border-gray-100 hover:shadow-md transition">
            <i data-lucide="users" class="w-8 h-8 mx-auto text-blue-500 mb-2"></i>
            <p class="text-gray-500 text-sm">Usuarios</p>
            <h2 class="text-3xl font-bold text-gray-800">{{ $totalUsuarios }}</h2>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-5 text-center border border-gray-100 hover:shadow-md transition">
            <i data-lucide="shield" class="w-8 h-8 mx-auto text-indigo-500 mb-2"></i>
            <p class="text-gray-500 text-sm">Administradores</p>
            <h2 class="text-3xl font-bold text-gray-800">{{ $totalAdmins }}</h2>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-5 text-center border border-gray-100 hover:shadow-md transition">
            <i data-lucide="activity" class="w-8 h-8 mx-auto text-cyan-500 mb-2"></i>
            <p class="text-gray-500 text-sm">Rutinas</p>
            <h2 class="text-3xl font-bold text-gray-800">{{ $totalRutinas }}</h2>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-5 text-center border border-gray-100 hover:shadow-md transition">
            <i data-lucide="dumbbell" class="w-8 h-8 mx-auto text-green-500 mb-2"></i>
            <p class="text-gray-500 text-sm">Ejercicios</p>
            <h2 class="text-3xl font-bold text-gray-800">{{ $totalEjercicios }}</h2>
        </div>
    </div>

    {{-- Gráfica de usuarios --}}
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <div class="flex items-center gap-2 mb-4">
            <i data-lucide="bar-chart-3" class="w-5 h-5 text-blue-600"></i>
            <h3 class="text-lg font-semibold text-gray-800">Usuarios registrados por mes</h3>
        </div>

        <div id="chart-data"
            data-months='@json($months ?? [])'
            data-users='@json($usersPerMonth ?? [])'>
        </div>

        <div class="relative h-80">
            <canvas id="usersChart"></canvas>
        </div>
    </div>
</div>

{{-- Scripts de Chart.js y Lucide --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();

    document.addEventListener('DOMContentLoaded', function () {
        const chartEl = document.getElementById('chart-data');
        const months = JSON.parse(chartEl.dataset.months || '[]');
        const usersPerMonth = JSON.parse(chartEl.dataset.users || '[]');

        const ctx = document.getElementById('usersChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Nuevos usuarios',
                    data: usersPerMonth,
                    backgroundColor: 'rgba(59,130,246,0.6)',
                    borderColor: 'rgba(59,130,246,1)',
                    borderWidth: 1,
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false } },
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 },
                        grid: { color: 'rgba(0,0,0,0.05)' }
                    }
                }
            }
        });
    });
</script>
@endsection
