@extends('admin.layout')
@section('title','Editar Ejercicio')

@section('content')
<div class="p-6 max-w-3xl mx-auto bg-white rounded-xl shadow-sm border border-gray-100">

    {{-- Encabezado --}}
    <div class="flex items-center gap-2 mb-6 border-b border-blue-200 pb-3">
        <i data-lucide="dumbbell" class="w-6 h-6 text-blue-600"></i>
        <h2 class="text-2xl font-bold text-gray-800">Editar ejercicio</h2>
    </div>


    {{-- Formulario --}}
    <form action="{{ route('admin.ejercicios.update', $ejercicio) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        {{-- Nombre --}}
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Nombre del ejercicio</label>
            <input type="text" name="nombre" value="{{ old('nombre',$ejercicio->nombre) }}"
                class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                placeholder="Ej: Press de banca" required>
        </div>

        {{-- Descripción --}}
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Descripción</label>
            <textarea name="descripcion" rows="3"
                class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                placeholder="Describe brevemente cómo realizar el ejercicio">{{ old('descripcion',$ejercicio->descripcion) }}</textarea>
        </div>

        {{-- Nivel --}}
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Nivel</label>
            <select name="nivel"
                class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                <option value="">-- Selecciona --</option>
                <option value="Principiante" @selected($ejercicio->nivel=='Principiante')>Principiante</option>
                <option value="Intermedio" @selected($ejercicio->nivel=='Intermedio')>Intermedio</option>
                <option value="Avanzado" @selected($ejercicio->nivel=='Avanzado')>Avanzado</option>
            </select>
        </div>

        {{-- Objetivo --}}
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Objetivo</label>
            <select name="objetivo"
                class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                <option value="">-- Selecciona --</option>
                <option value="Aumento de masa muscular" @selected($ejercicio->objetivo=='Aumento de masa muscular')>Aumento de masa muscular</option>
                <option value="Pérdida de peso" @selected($ejercicio->objetivo=='Pérdida de peso')>Pérdida de peso</option>
                <option value="Mantenimiento y tonificación" @selected($ejercicio->objetivo=='Mantenimiento y tonificación')>Mantenimiento y tonificación</option>
            </select>
        </div>

        {{-- Categoría --}}
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Categoría</label>
            <input type="text" name="categoria" value="{{ old('categoria',$ejercicio->categoria) }}"
                class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                placeholder="Ej: Pecho, Piernas, Espalda">
        </div>

        {{-- Video --}}
        <div>
            <label class="block text-gray-700 font-semibold mb-2">Video actual</label>

            @if($ejercicio->video_url)
                <div class="mb-3">
                    <video src="{{ $ejercicio->video_url }}" controls class="w-full rounded-lg shadow-sm mb-2"></video>

                    {{-- Botón eliminar video --}}
                    <button type="button" id="btnEliminarVideo"
                        class="flex items-center gap-2 text-red-600 hover:text-red-700 text-sm font-medium transition">
                        <i data-lucide="trash-2" class="w-4 h-4"></i> Eliminar video actual
                    </button>
                    <input type="hidden" name="eliminar_video" id="eliminar_video" value="0">
                </div>
            @else
                <p class="text-gray-500 italic mb-2">No hay video cargado.</p>
            @endif

            <input type="file" name="video" accept="video/*"
                class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        {{-- Botones --}}
        <div class="flex justify-end gap-3 pt-3 border-t border-gray-100">
            <a href="{{ route('admin.ejercicios.index') }}" class="text-gray-600 hover:text-gray-800 font-medium flex items-center gap-1">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Cancelar
            </a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg transition flex items-center gap-1">
                <i data-lucide="save" class="w-4 h-4"></i> Actualizar
            </button>
        </div>
    </form>
</div>

{{-- Íconos Lucide --}}
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();

    const btnEliminar = document.getElementById('btnEliminarVideo');
    if (btnEliminar) {
        btnEliminar.addEventListener('click', () => {
            if (confirm('¿Seguro que deseas eliminar el video actual?')) {
                document.getElementById('eliminar_video').value = '1';
                btnEliminar.closest('div').remove(); // Elimina la vista previa del video
            }
        });
    }
</script>
@endsection
