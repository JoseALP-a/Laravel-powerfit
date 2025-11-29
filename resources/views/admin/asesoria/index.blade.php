@extends('admin.layout')

@section('title', 'Configuración de Asesoría')

@section('content')
<div class="p-6 max-w-2xl mx-auto bg-white rounded-xl shadow-sm border border-gray-100">
    <div class="flex items-center gap-2 mb-6 border-b border-blue-200 pb-3">
        <i data-lucide="message-circle" class="w-6 h-6 text-blue-600"></i>
        <h2 class="text-2xl font-bold text-gray-800">Configuración de Asesoría</h2>
    </div>


    {{-- ✅ Formulario de edición --}}
    @if ($asesoria)
        <form action="{{ route('admin.asesoria.update', $asesoria) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- Número de WhatsApp --}}
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Número de WhatsApp</label>
                <input type="text" name="numero_whatsapp" value="{{ old('numero_whatsapp', $asesoria->numero_whatsapp) }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="+57XXXXXXXXXX" required>
            </div>

            {{-- Mensaje por defecto --}}
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Mensaje por defecto</label>
                <textarea name="mensaje_default" rows="3"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    required>{{ old('mensaje_default', $asesoria->mensaje_default) }}</textarea>
            </div>

            {{-- Estado de la asesoría --}}
            <div class="flex items-center gap-2">
                <input type="hidden" name="activo" value="0">
                <input type="checkbox" name="activo" value="1" id="activo"
                    class="rounded text-blue-600 focus:ring-blue-500"
                    {{ $asesoria->activo ? 'checked' : '' }}>
                <label for="activo" class="text-gray-700 font-semibold">Asesoría activa</label>
            </div>

            {{-- Botones --}}
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg transition">
                    💾 Guardar cambios
                </button>
            </div>
        </form>

        {{-- Estado actual --}}
        <div class="mt-4 text-sm text-gray-600">
            <span class="font-semibold">Estado:</span>
            @if($asesoria->activo)
                <span class="text-green-600">Activo ✅</span>
            @else
                <span class="text-red-600">Inactivo ❌</span>
            @endif
        </div>

    {{-- ✅ Si no hay configuración creada aún --}}
    @else
        <p class="text-gray-500 mb-4">No hay registro de asesoría configurado aún.</p>

        <form action="{{ route('admin.asesoria.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-gray-700 font-semibold mb-1">Número de WhatsApp</label>
                <input type="text" name="numero_whatsapp" value="{{ old('numero_whatsapp') }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="+57XXXXXXXXXX" required>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1">Mensaje por defecto</label>
                <textarea name="mensaje_default" rows="3"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Ej: Hola, necesito asesoría sobre mi rutina PowerFit." required></textarea>
            </div>

            <div class="flex items-center gap-2">
                <input type="hidden" name="activo" value="0">
                <input type="checkbox" name="activo" value="1" id="activo"
                    class="rounded text-blue-600 focus:ring-blue-500" checked>
                <label for="activo" class="text-gray-700 font-semibold">Asesoría activa</label>
            </div>

            <div class="flex justify-end pt-4 border-t border-gray-100">
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-2 rounded-lg transition">
                    ➕ Crear configuración
                </button>
            </div>
        </form>
    @endif
</div>

{{-- Íconos Lucide --}}
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
@endsection

