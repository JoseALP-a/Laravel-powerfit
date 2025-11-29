@extends('admin.layout')

@section('title', 'Gestión de Ejercicios')

@section('content')
<div class="p-6">

    {{-- Encabezado principal --}}
    <div class="flex justify-between items-center mb-8 border-b border-blue-200 pb-3">
        <div class="flex items-center gap-3">
            <i data-lucide="dumbbell" class="w-7 h-7 text-blue-600"></i>
            <h2 class="text-2xl font-bold text-gray-800">Gestión de Ejercicios</h2>
        </div>
        <a href="{{ route('admin.ejercicios.create') }}" 
           class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow transition">
            <i data-lucide="plus-circle" class="w-5 h-5"></i>
            Nuevo Ejercicio
        </a>
    </div>

    {{-- Tabla de ejercicios --}}
    <div class="overflow-x-auto bg-white rounded-lg shadow-lg border border-gray-200">
        <table class="min-w-full text-left text-gray-700">
            <thead class="bg-blue-50 border-b border-gray-200 text-blue-700 uppercase text-sm font-semibold">
                <tr>
                    <th class="px-4 py-3">Nombre</th>
                    <th class="px-4 py-3">Nivel</th>
                    <th class="px-4 py-3">Categoría</th>
                    <th class="px-4 py-3 text-center">Video</th>
                    <th class="px-4 py-3 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ejercicios as $e)
                    <tr class="hover:bg-blue-50 transition border-b border-gray-100">
                        <td class="px-4 py-3 font-medium">{{ $e->nombre }}</td>
                        <td class="px-4 py-3">{{ $e->nivel ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $e->categoria ?? '-' }}</td>
                        <td class="px-4 py-3 text-center">
                            @if($e->video_url)
                                <a href="{{ $e->video_url }}" target="_blank" class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-700 font-medium">
                                    <i data-lucide="play-circle" class="w-4 h-4"></i> Ver video
                                </a>
                            @else
                                <span class="text-gray-400">Sin video</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center space-x-4">
                            {{-- Editar --}}
                            <a href="{{ route('admin.ejercicios.edit', $e) }}" 
                               class="inline-flex items-center gap-1 text-orange-500 hover:text-orange-600 font-medium transition">
                                <i data-lucide="edit-3" class="w-4 h-4"></i> Editar
                            </a>

                            {{-- Eliminar --}}
                            <form action="{{ route('admin.ejercicios.destroy', $e) }}" method="POST" 
                                  class="inline-block" onsubmit="return confirm('¿Eliminar este ejercicio?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-flex items-center gap-1 text-red-600 hover:text-red-700 font-medium transition bg-transparent border-none p-0 m-0">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-gray-500">
                            No hay ejercicios registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="mt-6">
        {{ $ejercicios->links() }}
    </div>
</div>

{{-- Carga de iconos Lucide --}}
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
@endsection
