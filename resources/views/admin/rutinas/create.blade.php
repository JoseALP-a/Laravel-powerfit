@extends('admin.layout')
@section('title','Nueva Rutina')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Crear nueva rutina completa</h2>
    </x-slot>

    <div class="py-8 px-6">
        <div class="max-w-5xl mx-auto bg-white p-6 shadow rounded-lg">
            {{-- Mensajes de error --}}
            @if ($errors->any())
                <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Formulario principal --}}
            <form id="rutinaForm" action="{{ route('admin.rutinas.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div>
                        <label class="font-semibold">Nivel</label>
                        <select name="nivel" id="nivel" class="w-full border p-2 rounded">
                            @foreach($niveles as $n)
                                <option value="{{ $n }}">{{ $n }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="font-semibold">Duración</label>
                        <select name="duracion" id="duracion" class="w-full border p-2 rounded">
                            @foreach($duraciones as $d)
                                <option value="{{ $d }}">{{ $d }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="font-semibold">Objetivo</label>
                        <select name="objetivo" class="w-full border p-2 rounded">
                            @foreach($objetivos as $o)
                                <option value="{{ $o }}">{{ $o }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="font-semibold">Descripción</label>
                    <textarea name="descripcion" class="w-full border p-2 rounded"></textarea>
                </div>

                <div class="mb-4">
                    <label class="font-semibold">Nombre generado</label>
                    <input type="text" id="nombre_generado" readonly class="w-full border p-2 rounded bg-gray-50">
                </div>

                <div id="daysContainer" class="space-y-4 mb-6"></div>

                <div class="flex justify-end gap-4">
                    <a href="{{ route('admin.rutinas.index') }}"
                       class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">
                        Cancelar
                    </a>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        Guardar rutina
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- 🔹 Sección oculta para pasar los ejercicios al JS -->
    <div id="ejercicios-data"
         data-ejercicios='@json($ejercicios)'
         style="display:none;"></div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        // ✅ Obtener ejercicios sin usar directivas dentro del <script>
        let ejercicios = [];
        try {
            const raw = document.getElementById('ejercicios-data').dataset.ejercicios;
            ejercicios = JSON.parse(raw);
        } catch (e) {
            console.error('Error al cargar ejercicios:', e);
            ejercicios = [];
        }

        const nivelSelect = document.getElementById('nivel');
        const duracionSelect = document.getElementById('duracion');
        const nombreInput = document.getElementById('nombre_generado');
        const daysContainer = document.getElementById('daysContainer');

        function parseDays(duracion) {
            const n = parseInt(duracion);
            return isNaN(n) ? 0 : n;
        }

        function buildName() {
            return `Rutina ${nivelSelect.value} ${duracionSelect.value}`;
        }

        function ejerciciosPorNivel(nivel) {
            return ejercicios.filter(e => e.nivel === nivel);
        }

        function crearEjercicioRow(dayIndex, ejIndex, nivelActual) {
            const fila = document.createElement('div');
            fila.className = 'grid grid-cols-6 gap-2 items-end';

            const select = document.createElement('select');
            select.name = `days[${dayIndex}][ejercicios][${ejIndex}][ejercicio_id]`;
            select.className = 'col-span-2 border p-2 rounded';
            ejerciciosPorNivel(nivelActual).forEach(ej => {
                const opt = document.createElement('option');
                opt.value = ej.id;
                opt.textContent = ej.nombre;
                select.appendChild(opt);
            });

            const series = document.createElement('select');
            series.name = `days[${dayIndex}][ejercicios][${ejIndex}][series]`;
            [2, 3, 4].forEach(s => {
                const opt = document.createElement('option');
                opt.value = s;
                opt.textContent = `${s} series`;
                series.appendChild(opt);
            });
            series.className = 'border p-2 rounded';

            const repeticiones = document.createElement('input');
            repeticiones.name = `days[${dayIndex}][ejercicios][${ejIndex}][repeticiones]`;
            repeticiones.placeholder = '12 o 12,10,8';
            repeticiones.required = true;
            repeticiones.className = 'border p-2 rounded';

            const recomendacion = document.createElement('input');
            recomendacion.name = `days[${dayIndex}][ejercicios][${ejIndex}][recomendacion]`;
            recomendacion.placeholder = 'Recomendación';
            recomendacion.className = 'col-span-2 border p-2 rounded';

            fila.append(select, series, repeticiones, recomendacion);
            return fila;
        }

        function renderDays() {
            daysContainer.innerHTML = '';
            const dur = parseDays(duracionSelect.value);
            const nivel = nivelSelect.value;
            nombreInput.value = buildName();

            for (let i = 0; i < dur; i++) {
                const dayDiv = document.createElement('div');
                dayDiv.className = 'border rounded p-4 bg-gray-50';

                const gmLabel = document.createElement('label');
                gmLabel.textContent = `Grupo muscular (día ${i + 1})`;

                const gmInput = document.createElement('input');
                gmInput.name = `days[${i}][grupo_muscular]`;
                gmInput.required = true;
                gmInput.className = 'w-full border p-2 rounded mb-3';

                const ejContainer = document.createElement('div');
                ejContainer.className = 'space-y-2';
                ejContainer.appendChild(crearEjercicioRow(i, 0, nivel));

                const addBtn = document.createElement('button');
                addBtn.type = 'button';
                addBtn.textContent = 'Agregar otro ejercicio';
                addBtn.className = 'bg-green-600 text-white px-3 py-1 rounded mt-2';

                let ejIndex = 1;
                addBtn.addEventListener('click', () => {
                    ejContainer.appendChild(crearEjercicioRow(i, ejIndex++, nivel));
                });

                dayDiv.append(gmLabel, gmInput, ejContainer, addBtn);
                daysContainer.appendChild(dayDiv);
            }
        }

        duracionSelect.addEventListener('change', renderDays);
        nivelSelect.addEventListener('change', renderDays);
        renderDays(); // Inicializa al cargar
    });
    </script>
@endsection
