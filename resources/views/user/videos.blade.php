@extends('layouts.main')

@section('content')
<div style="display:flex; justify-content:center; padding-top:40px;">

    <div style="
        background: rgba(0,0,0,0.7);
        border-radius:20px;
        padding:25px;
        width:100%;
        max-width:800px;
        color:white;
        box-shadow:0 8px 30px rgba(0,0,0,0.6);
        backdrop-filter: blur(6px);
        border:1px solid rgba(255,255,255,0.1);
    ">
        <h2 style="font-size:2rem; font-weight:700; color:#ff6600; margin-bottom:10px;">🎥 Videos de Ejercicios</h2>
        <p style="color:#e5e7eb; margin-bottom:20px;">
            Aquí podrás ver los videos de los ejercicios asignados en tu rutina, para que puedas ejecutarlos correctamente.
        </p>

        @if ($ejercicios->isEmpty())
            <div style="background: rgba(255,193,7,0.2); color:#fbbf24; padding:10px; border-radius:10px; border:1px solid rgba(255,193,7,0.4); margin-bottom:10px;">
                ⚠️ Aún no hay videos disponibles para los ejercicios de tu rutina.
            </div>
        @else
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:15px;">
                @foreach ($ejercicios as $ejercicio)
                    <div style="padding:12px; border-radius:12px; background: rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1); transition: background 0.3s;"
                         onmouseover="this.style.background='rgba(255,255,255,0.1)'" onmouseout="this.style.background='rgba(255,255,255,0.05)'">
                        <h3 style="font-size:1.1rem; font-weight:600; color:#ffa500; margin-bottom:6px;">{{ $ejercicio->nombre }}</h3>
                        <p style="color:#d1d5db; font-size:0.9rem; margin-bottom:8px;">{{ $ejercicio->descripcion }}</p>

                        @if ($ejercicio->video_url)
                            <video controls style="width:100%; border-radius:10px; border:1px solid rgba(255,255,255,0.1);">
                                <source src="{{ asset($ejercicio->video_url) }}" type="video/mp4">
                                Tu navegador no soporta la reproducción de video.
                            </video>
                        @else
                            <p style="color:#f87171; font-size:0.85rem; font-style:italic;"> No hay video disponible.</p>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
