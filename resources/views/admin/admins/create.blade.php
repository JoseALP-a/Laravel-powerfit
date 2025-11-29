@extends('admin.layout')
@section('title','Nuevo Administrador')

@section('content')
<div class="p-6 max-w-3xl mx-auto bg-white rounded-xl shadow-sm border border-gray-100">

    {{-- Encabezado --}}
    <div class="flex items-center gap-2 mb-6 border-b border-blue-200 pb-3">
        <i data-lucide="user-plus" class="w-6 h-6 text-blue-600"></i>
        <h2 class="text-2xl font-bold text-gray-800">Agregar nuevo administrador</h2>
    </div>

    {{-- Mensajes de error --}}
    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-lg mb-5">
            <ul class="list-disc pl-5 space-y-1 text-sm">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulario --}}
    <form action="{{ route('admin.admins.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Nombre</label>
            <input type="text" name="name" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Ej: Jose Angel" required>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Correo electrónico</label>
            <input type="email" name="email" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Ej: admin@powerfit.com" required>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Contraseña</label>
            <input type="password" name="password" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Mínimo 8 caracteres" required>
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Confirmar contraseña</label>
            <input type="password" name="password_confirmation" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Repite la contraseña" required>
        </div>

        <div class="flex justify-end gap-3 pt-3 border-t border-gray-100">
            <a href="{{ route('admin.admins.index') }}" class="text-gray-600 hover:text-gray-800 font-medium">Cancelar</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg transition">
                Guardar
            </button>
        </div>
    </form>
</div>

{{-- Cargar íconos --}}
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
@endsection
