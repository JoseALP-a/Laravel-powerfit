<title>PowerFit - Videos</title>
@extends('layouts.main')

@section('content')
<div class="max-w-5xl mx-auto bg-black/60 text-white shadow-lg rounded-2xl p-8 mt-10 backdrop-blur-md border border-white/10">
    <h2 class="text-3xl font-bold mb-4 text-orange-400">🎥 Videos de Ejercicios</h2>
    <p class="text-gray-200 mb-6">
        Aquí podrás ver los videos de los ejercicios asignados en tu rutina, para que puedas ejecutarlos correctamente.
    </p>

    @if ($ejercicios->isEmpty())
        <div class="bg-yellow-500/20 border border-yellow-500 text-yellow-300 px-4 py-3 rounded">
            ⚠️ Aún no hay videos disponibles para los ejercicios de tu rutina.
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($ejercicios as $ejercicio)
                <div class="border border-white/10 rounded-xl p-4 shadow-sm bg-white/10 hover:bg-white/15 transition">
                    <h3 class="text-lg font-semibold mb-2 text-orange-300">{{ $ejercicio->nombre }}</h3>
                    <p class="text-sm text-gray-300 mb-3">{{ $ejercicio->descripcion }}</p>

                    @if ($ejercicio->video_url)
                        <video controls class="w-full rounded-lg border border-white/10">
                            <source src="{{ asset($ejercicio->video_url) }}" type="video/mp4">
                            Tu navegador no soporta la reproducción de video.
                        </video>
                    @else
                        <p class="text-red-400 italic text-sm">❌ No hay video disponible.</p>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
