<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asesoria;
use Illuminate\Http\Request;

class AsesoriaController extends Controller
{
    /**
     * 📋 Mostrar configuración (crear o editar)
     */
    public function index()
    {
        $asesoria = Asesoria::first();
        return view('admin.asesoria.index', compact('asesoria'));
    }

    /**
     * 💾 Crear nueva configuración
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'numero_whatsapp' => 'required|string|max:20',
            'mensaje_default' => 'required|string|max:255',
        ]);

        // Si el checkbox viene marcado, estará presente
        $data['activo'] = $request->has('activo');

        // Si ya existe un registro, actualizamos ese en vez de duplicar
        $asesoria = Asesoria::first();
        if ($asesoria) {
            $asesoria->update($data);
        } else {
            Asesoria::create($data);
        }

        return redirect()
            ->route('admin.asesoria.index')
            ->with('success', 'Configuración de asesoría guardada correctamente.');
    }

    /**
     * 🛠️ Actualizar configuración existente
     */
    public function update(Request $request, Asesoria $asesoria)
{
    $data = $request->validate([
        'numero_whatsapp' => 'required|string|max:20',
        'mensaje_default' => 'required|string|max:255',
        'activo' => 'boolean',
    ]);

    $asesoria->update($data);

    return redirect()
        ->route('admin.asesoria.index')
        ->with('success', 'Configuración de asesoría actualizada correctamente.');
}

}
