@extends('admin.layout')
@section('title','Usuarios')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📋 Detalles de Rutina: {{ $rutina->nombre }}
        </h2>
    </x-slot>

    <div class="py-8 px-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <p><strong>Nivel:</strong> {{ $rutina->nivel }}</p>
            <p><strong>Objetivo:</strong> {{ $rutina->objetivo }}</p>
            <p><strong>Duración:</strong> {{ $rutina->duracion }} semanas</p>
            <p class="mt-2"><strong>Descripción:</strong> {{ $rutina->descripcion }}</p>
        </div>

        <div class="mt-6">
            <h3 class="text-lg font-semibold mb-2">Días de Rutina</h3>

            @forelse ($rutina->dias as $dia)
                <div class="bg-gray-50 border rounded p-4 mb-3">
                    <h4 class="font-semibold">{{ $dia->grupo_muscular }}</h4>
                    <ul class="list-disc list-inside text-sm mt-2">
                        @foreach ($dia->ejercicios as $ejercicio)
                            <li>
                                {{ $ejercicio->ejercicio->nombre }} —
                                {{ $ejercicio->series }}x{{ $ejercicio->repeticiones }}
                                <small class="text-gray-500">({{ $ejercicio->recomendacion }})</small>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @empty
                <p class="text-gray-500">Esta rutina aún no tiene días registrados.</p>
            @endforelse
        </div>

        <div class="mt-4">
            <a href="{{ route('admin.rutinas.index') }}" class="text-blue-600 hover:underline">⬅ Volver</a>
        </div>
    </div>
@endsection
