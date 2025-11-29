<title>PowerFit - Registro</title>
@extends('layouts.main')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-black/60 text-white shadow-lg rounded-2xl p-8 backdrop-blur-md border border-white/10">

    {{-- ✅ Mostrar mensajes flash de éxito o error --}}
    @if (session('success'))
        <div class="mb-4 bg-green-600/20 text-green-300 border border-green-400/40 rounded-lg p-3 text-sm font-semibold">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 bg-red-600/20 text-red-300 border border-red-400/40 rounded-lg p-3 text-sm font-semibold">
            {{ session('error') }}
        </div>
    @endif

    {{-- ✅ Mostrar errores de validación del validador --}}
    @if ($errors->any())
        <div class="mb-4 bg-red-600/20 text-red-300 border border-red-400/40 rounded-lg p-3 text-sm font-semibold">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h2 class="text-3xl font-bold mb-6 text-orange-400">
        {{ $user->edad ? 'Editar Registro' : 'Completar Registro' }}
    </h2>

    <form action="{{ route('user.registro.guardar') }}" method="POST" class="space-y-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-300 mb-1">Edad</label>
                <input type="number" name="edad" value="{{ old('edad', $user->edad) }}"
                    class="w-full bg-white/10 border border-white/20 rounded-lg p-2 text-white focus:outline-none focus:border-orange-400" required>
            </div>

            <div>
                <label class="block text-gray-300 mb-1">Peso (kg)</label>
                <input type="number" step="0.1" name="peso" value="{{ old('peso', $user->peso) }}"
                    class="w-full bg-white/10 border border-white/20 rounded-lg p-2 text-white focus:outline-none focus:border-orange-400" required>
            </div>

            <div>
                <label class="block text-gray-300 mb-1">Altura (m)</label>
                <input type="number" step="0.01" name="altura" value="{{ old('altura', $user->altura) }}"
                    class="w-full bg-white/10 border border-white/20 rounded-lg p-2 text-white focus:outline-none focus:border-orange-400" required>
            </div>

            <div>
                <label class="block text-gray-300 mb-1">Sexo</label>
                <select name="sexo" class="w-full bg-white/10 border border-white/20 rounded-lg p-2 text-white focus:outline-none focus:border-orange-400" required>
                    <option value="">Selecciona...</option>
                    <option value="M" {{ $user->sexo == 'M' ? 'selected' : '' }}>Masculino</option>
                    <option value="F" {{ $user->sexo == 'F' ? 'selected' : '' }}>Femenino</option>
                    <option value="Otro" {{ $user->sexo == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-300 mb-1">Nivel de experiencia</label>
                <select name="nivel_experiencia" class="w-full bg-white/10 border border-white/20 rounded-lg p-2 text-white focus:outline-none focus:border-orange-400" required>
                    <option value="">Selecciona...</option>
                    <option value="Principiante" {{ $user->nivel_experiencia == 'Principiante' ? 'selected' : '' }}>Principiante</option>
                    <option value="Intermedio" {{ $user->nivel_experiencia == 'Intermedio' ? 'selected' : '' }}>Intermedio</option>
                    <option value="Avanzado" {{ $user->nivel_experiencia == 'Avanzado' ? 'selected' : '' }}>Avanzado</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-300 mb-1">Objetivo</label>
                <select name="objetivo" class="w-full bg-white/10 border border-white/20 rounded-lg p-2 text-white focus:outline-none focus:border-orange-400" required>
                    <option value="">Selecciona...</option>
                    <option value="Aumento de masa muscular" {{ $user->objetivo == 'Aumento de masa muscular' ? 'selected' : '' }}>Aumento de masa muscular</option>
                    <option value="Pérdida de peso" {{ $user->objetivo == 'Pérdida de peso' ? 'selected' : '' }}>Pérdida de peso</option>
                    <option value="Mantenimiento y tonificación" {{ $user->objetivo == 'Mantenimiento y tonificación' ? 'selected' : '' }}>Mantenimiento y tonificación</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-300 mb-1">Tiempo disponible</label>
                <select name="tiempo_disponible" class="w-full bg-white/10 border border-white/20 rounded-lg p-2 text-white focus:outline-none focus:border-orange-400" required>
                    <option value="">Selecciona...</option>
                    <option value="2 días" {{ $user->tiempo_disponible == '2 días' ? 'selected' : '' }}>2 días</option>
                    <option value="3 días" {{ $user->tiempo_disponible == '3 días' ? 'selected' : '' }}>3 días</option>
                    <option value="5 días" {{ $user->tiempo_disponible == '5 días' ? 'selected' : '' }}>5 días</option>
                </select>
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit"
                class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition">
                {{ $user->edad ? '💾 Actualizar registro' : '✅ Guardar y asignar rutina' }}
            </button>
        </div>
    </form>
</div>

<style>
    select {
        color: white !important;
        background-color: rgba(31, 41, 55, 0.9) !important;
    }

    option {
        background-color: #1f2937;
        color: white;
    }

    option:hover {
        background-color: #ff6600;
        color: #fff;
    }
</style>
@endsection
