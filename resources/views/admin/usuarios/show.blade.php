@extends('admin.layout')
@section('title','Ver Usuario')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-8 shadow-lg rounded-xl border border-gray-200">

    {{-- Encabezado --}}
    <div class="flex items-center gap-2 mb-6 border-b border-blue-200 pb-3">
        <i data-lucide="user" class="w-6 h-6 text-blue-600"></i>
        <h2 class="text-2xl font-bold text-gray-800">Detalles del Usuario</h2>
    </div>

    {{-- Datos generales --}}
    <div class="grid md:grid-cols-2 gap-4 text-gray-700">
        <p><span class="font-semibold text-gray-900">ID:</span> {{ $usuario->id }}</p>
        <p><span class="font-semibold text-gray-900">Nombre:</span> {{ $usuario->name }}</p>
        <p><span class="font-semibold text-gray-900">Correo:</span> {{ $usuario->email }}</p>
        <p><span class="font-semibold text-gray-900">Nivel de experiencia:</span> {{ $usuario->nivel_experiencia ?? 'No especificado' }}</p>
    </div>

    <hr class="my-6 border-gray-300">

    {{-- Rutina asignada --}}
    @if($usuario->rutina)
        <div class="mb-6">
            <div class="flex items-center gap-2 mb-3">
                <i data-lucide="activity" class="w-5 h-5 text-blue-600"></i>
                <h3 class="text-xl font-semibold text-gray-800">Rutina asignada: 
                    <span class="text-blue-600">{{ $usuario->rutina->nombre }}</span>
                </h3>
            </div>

            @foreach($usuario->rutina->dias as $dia)
                <div class="border rounded-lg p-4 mb-4 bg-blue-50 hover:bg-blue-100 transition">
                    <h4 class="font-semibold text-blue-700 mb-2">
                        Día {{ $dia->dia_numero }} — {{ $dia->grupo_muscular }}
                    </h4>
                    <ul class="list-disc pl-6 text-gray-700 space-y-1">
                        @foreach($dia->ejercicios as $ej)
                            <li>
                                <span class="font-medium">{{ $ej->ejercicio->nombre }}</span> —
                                {{ $ej->series }} series, repeticiones:
                                {{ is_array($ej->repeticiones) ? implode(', ', $ej->repeticiones) : $ej->repeticiones }}
                                @if($ej->recomendacion)
                                    <br>
                                    <small class="text-gray-500 italic">{{ $ej->recomendacion }}</small>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500 italic">Este usuario no tiene una rutina asignada actualmente.</p>
    @endif

    {{-- Botón volver --}}
    <div class="mt-8 text-right">
        <a href="{{ route('admin.usuarios.index') }}" 
           class="text-blue-600 hover:text-blue-800 font-semibold inline-flex items-center gap-1 transition">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Volver
        </a>
    </div>
</div>

{{-- Script de iconos Lucide --}}
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
@endsection
