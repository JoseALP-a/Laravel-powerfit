@extends('admin.layout')
@section('title','Nuevo Ejercicio')
@section('content')
<div class="p-6 max-w-3xl mx-auto bg-white rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">🏋️ Agregar nuevo ejercicio</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.ejercicios.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="block font-semibold">Nombre</label>
            <input type="text" name="nombre" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-3">
            <label class="block font-semibold">Descripción</label>
            <textarea name="descripcion" class="w-full border rounded p-2"></textarea>
        </div>

        <div class="mb-3">
            <label class="block font-semibold">Nivel</label>
            <select name="nivel" class="w-full border rounded p-2">
                <option value="">-- Selecciona --</option>
                <option value="Principiante">Principiante</option>
                <option value="Intermedio">Intermedio</option>
                <option value="Avanzado">Avanzado</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="block font-semibold">Objetivo</label>
            <select name="objetivo" class="w-full border rounded p-2">
                <option value="">-- Selecciona --</option>
                <option value="Aumento de masa muscular">Aumento de masa muscular</option>
                <option value="Pérdida de peso">Pérdida de peso</option>
                <option value="Mantenimiento y tonificación">Mantenimiento y tonificación</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="block font-semibold">Categoría</label>
            <input type="text" name="categoria" class="w-full border rounded p-2" placeholder="Ej. Pecho, Piernas...">
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Video del ejercicio (opcional)</label>
            <input type="file" name="video" accept="video/*" class="w-full border p-2 rounded">
            <p class="text-sm text-gray-500 mt-1">Formatos permitidos: MP4, MOV, AVI, WEBM. Máx: 40MB</p>
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('admin.ejercicios.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Guardar</button>
        </div>
    </form>
</div>
@endsection
