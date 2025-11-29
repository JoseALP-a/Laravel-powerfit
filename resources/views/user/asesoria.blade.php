@extends('layouts.main')

@section('content')
<div style="display:flex; justify-content:center; padding-top:40px;">

    <div style="
        background: rgba(0,0,0,0.7);
        border-radius:20px;
        padding:25px;
        width:100%;
        max-width:600px;
        color:white;
        box-shadow:0 8px 30px rgba(0,0,0,0.6);
        backdrop-filter: blur(6px);
        border:1px solid rgba(255,255,255,0.1);
    ">
        {{-- Encabezado --}}
        <div style="display:flex; align-items:center; gap:10px; margin-bottom:15px; border-bottom:1px solid rgba(255,255,255,0.2); padding-bottom:8px;">
            <span style="font-size:1.4rem; color:#ff6600;">💬</span>
            <h2 style="font-size:1.5rem; font-weight:700; color:white; margin:0;">Asesoría Virtual</h2>
        </div>

        {{-- Introducción --}}
        <div style="background: linear-gradient(90deg, #ff7a00, #ff5100); color:white; border-radius:12px; padding:15px; margin-bottom:15px;">
            <p style="margin:0; font-size:0.95rem; line-height:1.5;">
                En este espacio podrás recibir <strong>asesoría personalizada</strong> sobre tu rutina, tus progresos o cualquier duda relacionada con PowerFit.
                Nuestro equipo está disponible para orientarte y ayudarte a alcanzar tus objetivos de forma <strong>efectiva y segura</strong>.
            </p>
        </div>

        {{-- Mensaje dinámico --}}
        <p style="margin-bottom:15px; color:#d1d5db; font-size:0.95rem;">{{ $mensaje }}</p>

        {{-- Estado --}}
        <div style="margin-bottom:15px;">
            @if($activo)
                <span style="display:inline-flex; align-items:center; gap:5px; color:#22c55e; font-weight:600;">
                    ✅ Asesoría activa
                </span>
            @else
                <span style="display:inline-flex; align-items:center; gap:5px; color:#f87171; font-weight:600;">
                    ❌ Asesoría inactiva
                </span>
            @endif
        </div>

        {{-- Botón --}}
        @if($activo)
            <a href="{{ $whatsapp }}" target="_blank"
               style="display:inline-flex; align-items:center; gap:8px; background: linear-gradient(90deg,#ff7a00,#ff5100); color:white; font-weight:600; padding:10px 16px; border-radius:10px; text-decoration:none; transition:all 0.3s; font-size:0.95rem;"
               onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 0 15px rgba(255,123,0,0.6)';"
               onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';">
                📞 Contactar vía WhatsApp
            </a>
        @else
            <button disabled style="display:inline-flex; align-items:center; gap:8px; background:#9ca3af; color:#6b7280; font-weight:600; padding:10px 16px; border-radius:10px; cursor:not-allowed; font-size:0.95rem;">
                ⛔ No disponible
            </button>
        @endif
    </div>
</div>
@endsection
