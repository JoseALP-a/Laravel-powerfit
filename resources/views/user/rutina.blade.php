<title>PowerFit - Rutina</title>
@extends('layouts.main')

@section('content')
<div class="max-w-5xl mx-auto mt-10 bg-black/60 text-white shadow-lg rounded-2xl p-8 backdrop-blur-md border border-white/10">
    <h2 class="text-3xl font-bold mb-4 text-orange-400">{{ $rutina->nombre }}</h2>
    <p class="text-gray-200 mb-6">{{ $rutina->descripcion }}</p>

    @foreach ($rutina->dias as $dia)
        <div class="mb-6 border-t border-white/20 pt-4">
            <h3 class="text-xl font-semibold mb-3 text-orange-300">
                📅 Día {{ $loop->iteration }} - {{ $dia->grupo_muscular }}
            </h3>
            @foreach ($dia->ejercicios as $ejercicioRutina)
                <div class="ml-4 mb-4 bg-white/10 p-3 rounded-lg hover:bg-white/15 transition">
                    <p class="text-lg font-semibold text-white">
                        🏋️ {{ $ejercicioRutina->ejercicio->nombre }}
                    </p>
                    <p class="text-gray-300">Series: {{ $ejercicioRutina->series }}</p>
                    <p class="text-gray-300">
                        Repeticiones:
                        {{ is_array($ejercicioRutina->repeticiones)
                            ? implode(',', $ejercicioRutina->repeticiones)
                            : $ejercicioRutina->repeticiones }}
                    </p>
                    <p class="text-sm text-gray-400 italic mt-1">
                        {{ $ejercicioRutina->recomendacion }}
                    </p>
                </div>
            @endforeach
        </div>
    @endforeach
</div>
@endsection
