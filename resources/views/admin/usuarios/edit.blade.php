@extends('admin.layout')
@section('title','Editar Usuario')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 shadow-lg rounded-xl border border-gray-200">

    {{-- Encabezado --}}
    <div class="flex items-center gap-2 mb-6 border-b border-blue-200 pb-3">
        <i data-lucide="user-cog" class="w-6 h-6 text-blue-600"></i>
        <h2 class="text-2xl font-bold text-gray-800">Editar Usuario</h2>
    </div>

    {{-- Formulario --}}
    <form action="{{ route('admin.usuarios.update', $usuario->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        {{-- Nombre --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-1">Nombre</label>
            <input type="text" name="name"
                   class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                   value="{{ old('name', $usuario->name) }}" required>
        </div>

        {{-- Email --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-1">Correo electrónico</label>
            <input type="email" name="email"
                   class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                   value="{{ old('email', $usuario->email) }}" required>
        </div>

        {{-- Nivel de experiencia --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-1">Nivel de experiencia</label>
            <input type="text" name="nivel_experiencia"
                   class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                   value="{{ old('nivel_experiencia', $usuario->nivel_experiencia) }}">
        </div>

        {{-- Rutina asignada --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-1">Rutina asignada</label>
            <select name="rutina_id"
                    class="w-full border border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-blue-400 focus:outline-none">
                <option value="">Sin rutina</option>
                @foreach($rutinas as $r)
                    <option value="{{ $r->id }}" @selected($usuario->rutina_id == $r->id)>
                        {{ $r->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Botones --}}
        <div class="flex justify-between items-center pt-4 border-t border-gray-200">
            <a href="{{ route('admin.usuarios.index') }}"
               class="text-gray-600 hover:text-gray-900 font-medium flex items-center gap-1 transition">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Cancelar
            </a>

            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg transition">
                <i data-lucide="save" class="w-4 h-4 inline-block mr-1"></i>
                Guardar cambios
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
