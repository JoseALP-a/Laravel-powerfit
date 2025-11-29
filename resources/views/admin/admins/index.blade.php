@extends('admin.layout')
@section('title','Administradores')

@section('content')
<div class="p-6">

    {{-- Encabezado --}}
    <div class="flex justify-between items-center mb-6 border-b border-blue-200 pb-3">
        <div class="flex items-center gap-2">
            <i data-lucide="users" class="w-6 h-6 text-blue-600"></i>
            <h2 class="text-2xl font-bold text-gray-800">Gestión de Administradores</h2>
        </div>
        <a href="{{ route('admin.admins.create') }}"
           class="flex items-center gap-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
            <i data-lucide="user-plus" class="w-4 h-4"></i> Nuevo Administrador
        </a>
    </div>

    {{-- Tabla --}}
    <div class="overflow-x-auto bg-white rounded-xl shadow border border-gray-200">
        <table class="min-w-full text-gray-700">
            <thead class="bg-blue-50 text-blue-700 uppercase text-sm">
                <tr>
                    <th class="px-4 py-3 text-left border-b">Nombre</th>
                    <th class="px-4 py-3 text-left border-b">Correo</th>
                    <th class="px-4 py-3 text-center border-b">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($admins as $a)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="px-4 py-2">{{ $a->name }}</td>
                        <td class="px-4 py-2">{{ $a->email }}</td>
                        <td class="px-4 py-2 text-center space-x-3">
                            <a href="{{ route('admin.admins.edit', $a) }}"
                               class="text-orange-500 hover:text-orange-600 font-semibold">
                                <i data-lucide="edit-3" class="w-4 h-4 inline"></i> Editar
                            </a>

                            <form action="{{ route('admin.admins.destroy', $a) }}" method="POST" class="inline"
                                  onsubmit="return confirm('¿Eliminar este administrador?')">
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
                        <td colspan="3" class="text-center text-gray-500 py-4">No hay administradores registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="mt-4">
        {{ $admins->links() }}
    </div>
</div>

{{-- Script de iconos Lucide --}}
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
@endsection
