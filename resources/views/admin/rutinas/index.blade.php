@extends('admin.layout')

@section('title', 'Rutinas')

@section('content')
<div class="p-6">

    {{-- Encabezado principal --}}
    <div class="flex justify-between items-center mb-8 border-b border-blue-200 pb-3">
        <div class="flex items-center gap-3">
            <i data-lucide="activity" class="w-7 h-7 text-blue-600"></i>
            <h2 class="text-2xl font-bold text-gray-800">Gestión de Rutinas</h2>
        </div>
        <a href="{{ route('admin.rutinas.create') }}" 
           class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow transition">
            <i data-lucide="plus-circle" class="w-5 h-5"></i>
            Nueva Rutina
        </a>
    </div>

    {{-- Tabla de rutinas --}}
    <div class="overflow-x-auto bg-white rounded-lg shadow-lg border border-gray-200">
        <table class="min-w-full text-left text-gray-700">
            <thead class="bg-blue-50 border-b border-gray-200 text-blue-700 uppercase text-sm font-semibold">
                <tr>
                    <th class="px-4 py-3">Nombre</th>
                    <th class="px-4 py-3">Nivel</th>
                    <th class="px-4 py-3">Objetivo</th>
                    <th class="px-4 py-3">Duración</th>
                    <th class="px-4 py-3 text-center">Días</th>
                    <th class="px-4 py-3 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rutinas as $r)
                    <tr class="hover:bg-blue-50 transition border-b border-gray-100">
                        <td class="px-4 py-3 font-medium">{{ $r->nombre }}</td>
                        <td class="px-4 py-3">{{ $r->nivel }}</td>
                        <td class="px-4 py-3">{{ $r->objetivo }}</td>
                        <td class="px-4 py-3">{{ $r->duracion }}</td>
                        <td class="px-4 py-3 text-center">{{ $r->dias_count }}</td>
                        <td class="px-4 py-3 text-center space-x-4">
                            {{-- Editar --}}
                            <a href="{{ route('admin.rutinas.edit', $r->id) }}" 
                               class="inline-flex items-center gap-1 text-orange-500 hover:text-orange-600 font-medium transition">
                                <i data-lucide="edit-3" class="w-4 h-4"></i> Editar
                            </a>

                            {{-- Eliminar --}}
                            <form action="{{ route('admin.rutinas.destroy', $r->id) }}" 
                                  method="POST" class="inline-block"
                                  onsubmit="return confirm('¿Estás seguro de eliminar esta rutina? Se eliminarán también sus días y ejercicios asociados.')">
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
                        <td colspan="6" class="text-center py-5 text-gray-500">
                            No hay rutinas registradas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="mt-6">
        {{ $rutinas->links() }}
    </div>
</div>

{{-- Carga de iconos Lucide --}}
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
@endsection
