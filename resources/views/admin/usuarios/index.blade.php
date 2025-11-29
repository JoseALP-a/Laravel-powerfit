@extends('admin.layout')
@section('title','Usuarios')

@section('content')
<div class="p-6">

    {{-- Encabezado --}}
    <div class="flex justify-between items-center mb-6 border-b border-blue-200 pb-3">
        <div class="flex items-center gap-2">
            <i data-lucide="users" class="w-6 h-6 text-blue-600"></i>
            <h2 class="text-2xl font-bold text-gray-800">Gestión de Usuarios</h2>
        </div>
    </div>

    {{-- Tabla --}}
    <div class="overflow-x-auto bg-white rounded-xl shadow border border-gray-200">
        <table class="min-w-full text-gray-700">
            <thead class="bg-blue-50 text-blue-700 uppercase text-sm">
                <tr>
                    <th class="px-4 py-3 text-left border-b">ID</th>
                    <th class="px-4 py-3 text-left border-b">Nombre</th>
                    <th class="px-4 py-3 text-left border-b">Correo</th>
                    <th class="px-4 py-3 text-left border-b">Nivel</th>
                    <th class="px-4 py-3 text-left border-b">Rutina</th>
                    <th class="px-4 py-3 text-center border-b">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $u)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="px-4 py-2">{{ $u->id }}</td>
                        <td class="px-4 py-2">{{ $u->name }}</td>
                        <td class="px-4 py-2">{{ $u->email }}</td>
                        <td class="px-4 py-2">{{ $u->nivel_experiencia ?? '-' }}</td>
                        <td class="px-4 py-2">{{ optional($u->rutina)->nombre ?? 'Sin rutina' }}</td>
                        <td class="px-4 py-2 text-center space-x-3">
                            <a href="{{ route('admin.usuarios.show', $u->id) }}"
                               class="text-blue-600 hover:text-blue-700 font-semibold">
                                <i data-lucide="eye" class="w-4 h-4 inline"></i> Ver
                            </a>
                            <a href="{{ route('admin.usuarios.edit', $u->id) }}"
                               class="text-orange-500 hover:text-orange-600 font-semibold">
                                <i data-lucide="edit-3" class="w-4 h-4 inline"></i> Editar
                            </a>
                            <form action="{{ route('admin.usuarios.destroy', $u->id) }}" method="POST" class="inline"
                                  onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-700 font-semibold">
                                    <i data-lucide="trash-2" class="w-4 h-4 inline"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-gray-500 py-4">No hay usuarios registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>

{{-- Script de iconos Lucide --}}
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
@endsection
