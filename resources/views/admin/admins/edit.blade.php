@extends('admin.layout')

@section('title', 'Editar Administrador')

@section('content')
<div class="p-6 max-w-3xl mx-auto bg-white rounded-xl shadow-lg border border-gray-200">

    {{-- Título principal --}}
    <div class="flex items-center gap-3 mb-6 border-b border-blue-200 pb-3">
        <i data-lucide="user-cog" class="w-7 h-7 text-blue-600"></i>
        <h2 class="text-2xl font-bold text-gray-800">Editar Administrador</h2>
    </div>

    {{-- Formulario --}}
    <form action="{{ route('admin.admins.update', $admin) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        {{-- Nombre --}}
        <div>
            <label class="block text-gray-700 font-semibold mb-1">
                <i data-lucide="user" class="inline w-4 h-4 text-blue-600 mr-1"></i>
                Nombre
            </label>
            <input type="text" name="name" value="{{ old('name', $admin->name) }}"
                   class="w-full border border-gray-300 rounded-lg p-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   required>
        </div>

        {{-- Correo --}}
        <div>
            <label class="block text-gray-700 font-semibold mb-1">
                <i data-lucide="mail" class="inline w-4 h-4 text-blue-600 mr-1"></i>
                Correo electrónico
            </label>
            <input type="email" name="email" value="{{ old('email', $admin->email) }}"
                   class="w-full border border-gray-300 rounded-lg p-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   required>
        </div>

        {{-- Contraseña --}}
        <div>
            <label class="block text-gray-700 font-semibold mb-1">
                <i data-lucide="lock" class="inline w-4 h-4 text-blue-600 mr-1"></i>
                Nueva contraseña (opcional)
            </label>
            <input type="password" name="password"
                   class="w-full border border-gray-300 rounded-lg p-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        {{-- Confirmar contraseña --}}
        <div>
            <label class="block text-gray-700 font-semibold mb-1">
                <i data-lucide="lock-keyhole" class="inline w-4 h-4 text-blue-600 mr-1"></i>
                Confirmar contraseña
            </label>
            <input type="password" name="password_confirmation"
                   class="w-full border border-gray-300 rounded-lg p-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        {{-- Botones --}}
        <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
            <a href="{{ route('admin.admins.index') }}"
               class="flex items-center gap-1 text-gray-600 hover:text-gray-800 font-semibold transition">
                <i data-lucide="x-circle" class="w-4 h-4"></i> Cancelar
            </a>
            <button type="submit"
                    class="flex items-center gap-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg shadow transition">
                <i data-lucide="save" class="w-4 h-4"></i> Actualizar
            </button>
        </div>
    </form>
</div>

{{-- Script de iconos Lucide --}}
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
@endsection
