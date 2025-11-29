@extends('admin.layout')

@section('title', 'Editar Rutina')

@section('content')
<div class="py-8 px-6">
    <div class="max-w-6xl mx-auto bg-white shadow rounded-2xl p-8 border border-gray-100">
        <div class="flex items-center mb-6">
            <i data-lucide="pencil" class="w-6 h-6 text-blue-600 mr-2"></i>
            <h2 class="text-2xl font-semibold text-gray-800">Editar Rutina</h2>
        </div>

        {{-- Mensajes --}}
        @if($errors->any())
            <div class="flex items-start bg-red-50 text-red-700 p-4 rounded-lg mb-4 border border-red-200">
                <i data-lucide="alert-triangle" class="w-6 h-6 mr-3 text-red-600"></i>
                <div>
                    <p class="font-semibold mb-1">Revisa los siguientes campos:</p>
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form id="rutinaForm" action="{{ route('admin.rutinas.update', $rutina->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nivel, duración y objetivo (solo lectura) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nivel</label>
                    <input type="text" value="{{ $rutina->nivel }}" class="w-full border border-gray-300 rounded-lg p-2 bg-gray-100" readonly>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Duración</label>
                    <input type="text" value="{{ $rutina->duracion }}" class="w-full border border-gray-300 rounded-lg p-2 bg-gray-100" readonly>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Objetivo</label>
                    <input type="text" value="{{ $rutina->objetivo }}" class="w-full border border-gray-300 rounded-lg p-2 bg-gray-100" readonly>
                </div>
            </div>

            <div class="mb-8">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Descripción</label>
                <textarea name="descripcion" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-300 focus:outline-none" rows="3">{{ old('descripcion', $rutina->descripcion) }}</textarea>
            </div>

            {{-- Campo oculto para eliminaciones --}}
            <input type="hidden" name="eliminados" id="eliminados" value="[]">

            {{-- Días y ejercicios --}}
            <div id="daysContainer">
                @foreach($rutina->dias as $dia)
                    <div class="day border border-gray-200 rounded-xl p-5 mb-6 bg-blue-50/40" data-dia-id="{{ $dia->id }}">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                <i data-lucide="calendar" class="w-5 h-5 mr-2 text-blue-500"></i>
                                Día {{ $dia->dia_numero }}
                            </h3>
                        </div>

                        {{-- Nombre del día --}}
                        <div class="mb-3">
                            <label class="block text-sm font-semibold text-gray-700">Nombre del Día</label>
                            <input type="text" name="dias[{{ $dia->id }}][grupo_muscular]" value="{{ $dia->grupo_muscular }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-300 focus:outline-none" required>
                        </div>

                        {{-- Ejercicios --}}
                        <div class="space-y-3 ejercicios">
                            @foreach($dia->ejercicios as $i => $ej)
                                <div class="ejercicio border border-gray-200 rounded-lg p-4 bg-white relative shadow-sm" data-ej-id="{{ $ej->id }}">
                                    <button type="button" class="absolute top-2 right-2 text-gray-400 hover:text-red-500 remove-ej transition">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>

                                    <input type="hidden" name="dias[{{ $dia->id }}][ejercicios][{{ $i }}][id]" value="{{ $ej->id }}">

                                    <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700">Ejercicio</label>
                                            <select name="dias[{{ $dia->id }}][ejercicios][{{ $i }}][ejercicio_id]" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-300 focus:outline-none" required>
                                                <option value="">-- Seleccionar --</option>
                                                @foreach($ejercicios as $e)
                                                    <option value="{{ $e->id }}" {{ $ej->ejercicio_id == $e->id ? 'selected' : '' }}>
                                                        {{ $e->nombre }} ({{ $e->nivel }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700">Series</label>
                                            <input type="number" name="dias[{{ $dia->id }}][ejercicios][{{ $i }}][series]" value="{{ $ej->series }}" class="border border-gray-300 rounded-lg p-2 w-full focus:ring-2 focus:ring-blue-300 focus:outline-none" required>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700">Repeticiones</label>
                                            <input type="text" name="dias[{{ $dia->id }}][ejercicios][{{ $i }}][repeticiones]" value="{{ is_array($ej->repeticiones) ? implode(',', $ej->repeticiones) : $ej->repeticiones }}" class="border border-gray-300 rounded-lg p-2 w-full focus:ring-2 focus:ring-blue-300 focus:outline-none" required>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700">Recomendación</label>
                                            <input type="text" name="dias[{{ $dia->id }}][ejercicios][{{ $i }}][recomendacion]" value="{{ $ej->recomendacion }}" class="border border-gray-300 rounded-lg p-2 w-full focus:ring-2 focus:ring-blue-300 focus:outline-none">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Botón agregar ejercicio --}}
                        <button type="button" class="mt-4 flex items-center text-blue-600 hover:text-blue-800 text-sm add-ej transition">
                            <i data-lucide="plus" class="w-4 h-4 mr-1"></i> Agregar Ejercicio
                        </button>
                    </div>
                @endforeach
            </div>

            {{-- Botones finales --}}
            <div class="flex justify-between mt-8">
                <a href="{{ route('admin.rutinas.index') }}" class="flex items-center bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg transition">
                    <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i> Volver
                </a>
                <button type="submit" class="flex items-center bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg transition">
                    <i data-lucide="save" class="w-4 h-4 mr-2"></i> Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Script dinámico --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    lucide.createIcons();

    const eliminados = document.getElementById('eliminados');

    // 🗑️ Eliminar ejercicio
    document.body.addEventListener('click', e => {
        if (e.target.closest('.remove-ej')) {
            const ej = e.target.closest('.ejercicio');
            const ejId = ej.dataset.ejId;

            if (ejId) {
                if (confirm('¿Eliminar este ejercicio?')) {
                    const current = JSON.parse(eliminados.value);
                    current.push(ejId);
                    eliminados.value = JSON.stringify(current);
                    ej.remove();
                }
            } else {
                // Si es nuevo, solo eliminar del DOM
                ej.remove();
            }
        }
    });

    // ➕ Agregar nuevo ejercicio al día correspondiente
    document.body.addEventListener('click', e => {
        if (e.target.closest('.add-ej')) {
            const day = e.target.closest('.day');
            const dayId = day.dataset.diaId;
            const ejerciciosContainer = day.querySelector('.ejercicios');
            const index = ejerciciosContainer.querySelectorAll('.ejercicio').length;

            const template = `
                <div class="ejercicio border border-gray-200 rounded-lg p-4 bg-white relative shadow-sm">
                    <button type="button" class="absolute top-2 right-2 text-gray-400 hover:text-red-500 remove-ej transition">
                        <i data-lucide='trash-2' class='w-4 h-4'></i>
                    </button>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700">Ejercicio</label>
                            <select name="dias[${dayId}][ejercicios][${index}][ejercicio_id]" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-300 focus:outline-none" required>
                                <option value="">-- Seleccionar --</option>
                                @foreach($ejercicios as $e)
                                    <option value="{{ $e->id }}">{{ $e->nombre }} ({{ $e->nivel }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700">Series</label>
                            <input type="number" name="dias[${dayId}][ejercicios][${index}][series]" class="border border-gray-300 rounded-lg p-2 w-full focus:ring-2 focus:ring-blue-300 focus:outline-none" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700">Repeticiones</label>
                            <input type="text" name="dias[${dayId}][ejercicios][${index}][repeticiones]" class="border border-gray-300 rounded-lg p-2 w-full focus:ring-2 focus:ring-blue-300 focus:outline-none" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700">Recomendación</label>
                            <input type="text" name="dias[${dayId}][ejercicios][${index}][recomendacion]" class="border border-gray-300 rounded-lg p-2 w-full focus:ring-2 focus:ring-blue-300 focus:outline-none">
                        </div>
                    </div>
                </div>
            `;
            ejerciciosContainer.insertAdjacentHTML('beforeend', template);
            lucide.createIcons();
        }
    });
});
</script>

{{-- Lucide icons CDN --}}
<script src="https://unpkg.com/lucide@latest"></script>
@endsection

