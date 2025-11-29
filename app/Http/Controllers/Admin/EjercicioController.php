<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ejercicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EjercicioController extends Controller
{
    public function index()
    {
        $ejercicios = Ejercicio::paginate(20);
        return view('admin.ejercicios.index', compact('ejercicios'));
    }

    public function create()
    {
        return view('admin.ejercicios.create');
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'nombre'=>'required|string|max:255',
        'descripcion'=>'nullable|string',
        'nivel'=>'nullable|string',
        'objetivo'=>'nullable|string',
        'categoria'=>'nullable|string',
        'video'=>'nullable|file|mimes:mp4,mov,avi,webm|max:512000', // hasta 500MB
    ]);

    if ($request->hasFile('video')) {
        $file = $request->file('video');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('videos/ejercicios'), $filename);
        $data['video_url'] = '/videos/ejercicios/' . $filename;
    }

    Ejercicio::create($data);
    return redirect()->route('admin.ejercicios.index')->with('success', 'Ejercicio creado correctamente.');
}

    public function edit(Ejercicio $ejercicio) { return view('admin.ejercicios.edit', compact('ejercicio')); }

    public function update(Request $request, Ejercicio $ejercicio)
{
    $data = $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
        'nivel' => 'nullable|string',
        'objetivo' => 'nullable|string',
        'categoria' => 'nullable|string',
        'video' => 'nullable|file|mimes:mp4,mov,avi,webm|max:512000',
        'eliminar_video' => 'nullable|in:0,1',
    ]);

    // ✅ Si el usuario decide eliminar el video actual
    if ($request->eliminar_video == '1' && $ejercicio->video_url) {
        if (file_exists(public_path($ejercicio->video_url))) {
            unlink(public_path($ejercicio->video_url));
        }
        $data['video_url'] = null;
    }

    // ✅ Si hay un nuevo video cargado
    if ($request->hasFile('video')) {
        if ($ejercicio->video_url && file_exists(public_path($ejercicio->video_url))) {
            unlink(public_path($ejercicio->video_url));
        }

        $file = $request->file('video');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('videos/ejercicios'), $filename);
        $data['video_url'] = '/videos/ejercicios/' . $filename;
    }

    $ejercicio->update($data);

    return redirect()
        ->route('admin.ejercicios.edit', $ejercicio->id)
        ->with('success', 'Ejercicio actualizado correctamente.');
}


    public function destroy(Ejercicio $ejercicio)
    {
        if($ejercicio->video_url){
            $old = str_replace('/storage/','',$ejercicio->video_url);
            Storage::disk('public')->delete($old);
        }
        $ejercicio->delete();
        return redirect()->route('admin.ejercicios.index')->with('success','Ejercicio eliminado.');
    }
}
