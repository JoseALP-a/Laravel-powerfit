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
        <h2 style="font-size:2rem; font-weight:700; color:#ff6600; margin-bottom:10px;">
            {{ $rutina->nombre }}
        </h2>
        <p style="color:#e5e7eb; margin-bottom:20px;">{{ $rutina->descripcion }}</p>

        @foreach ($rutina->dias as $dia)
            <div style="border-top:1px solid rgba(255,255,255,0.2); padding-top:15px; margin-bottom:20px;">
                <h3 style="font-size:1.2rem; font-weight:600; color:#ffa500; margin-bottom:10px;">
                    📅 Día {{ $loop->iteration }} - {{ $dia->grupo_muscular }}
                </h3>

                @foreach ($dia->ejercicios as $ejercicioRutina)
                    <div style="margin-left:10px; margin-bottom:12px; padding:10px; border-radius:12px; background: rgba(255,255,255,0.05); transition: background 0.3s; cursor:default;"
                         onmouseover="this.style.background='rgba(255,255,255,0.1)'" 
                         onmouseout="this.style.background='rgba(255,255,255,0.05)'">
                        <p style="font-size:1.05rem; font-weight:600; color:white;">🏋️ {{ $ejercicioRutina->ejercicio->nombre }}</p>
                        <p style="color:#d1d5db; margin:2px 0;">Series: {{ $ejercicioRutina->series }}</p>
                        <p style="color:#d1d5db; margin:2px 0;">
                            Repeticiones: {{ is_array($ejercicioRutina->repeticiones) ? implode(',', $ejercicioRutina->repeticiones) : $ejercicioRutina->repeticiones }}
                        </p>
                        <p style="font-size:0.85rem; font-style:italic; color:#9ca3af; margin-top:4px;">
                            {{ $ejercicioRutina->recomendacion }}
                        </p>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
@endsection
