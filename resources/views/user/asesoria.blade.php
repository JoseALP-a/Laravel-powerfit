<title>PowerFit - Asesoría</title>
@extends('layouts.main')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-md rounded-2xl p-6 border border-orange-100">

    {{-- Encabezado --}}
    <div class="flex items-center gap-2 mb-6 border-b border-orange-200 pb-3">
        <i data-lucide="message-circle" class="w-6 h-6 text-orange-500"></i>
        <h2 class="text-2xl font-bold text-gray-800">Asesoría Virtual</h2>
    </div>

    {{-- Introducción principal --}}
    <div class="bg-gradient-to-r from-orange-400 to-orange-500 text-white rounded-lg p-5 shadow-sm mb-5">
        <p class="text-base leading-relaxed">
            En este espacio podrás recibir <span class="font-semibold">asesoría personalizada</span> sobre tu rutina, tus progresos o cualquier duda relacionada con PowerFit.  
            Nuestro equipo está disponible para orientarte y ayudarte a alcanzar tus objetivos de forma <span class="font-semibold">efectiva y segura</span>.
        </p>
    </div>

    {{-- Descripción dinámica desde la base de datos --}}
    <p class="text-gray-700 leading-relaxed mb-6">
        {{ $mensaje }}
    </p>

    {{-- Estado de la asesoría --}}
    <div class="flex items-center gap-2 mb-6">
        @if($activo)
            <span class="flex items-center gap-1 text-green-600 font-medium">
                <i data-lucide="check-circle" class="w-5 h-5"></i> Asesoría activa
            </span>
        @else
            <span class="flex items-center gap-1 text-red-600 font-medium">
                <i data-lucide="x-circle" class="w-5 h-5"></i> Asesoría inactiva
            </span>
        @endif
    </div>

    {{-- Botón de contacto --}}
    @if($activo)
        <a href="{{ $whatsapp }}" target="_blank"
            class="inline-flex items-center gap-2 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-semibold px-6 py-2.5 rounded-lg shadow-md transition">
            <i data-lucide="phone" class="w-4 h-4"></i> Contactar vía WhatsApp
        </a>
    @else
        <button disabled
            class="inline-flex items-center gap-2 bg-gray-300 text-gray-600 font-semibold px-6 py-2.5 rounded-lg cursor-not-allowed">
            <i data-lucide="slash" class="w-4 h-4"></i> No disponible
        </button>
    @endif

</div>

{{-- Íconos Lucide --}}
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
@endsection

