<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rutina;
use App\Models\DiaRutina;
use App\Models\EjercicioRutina;
use App\Models\Ejercicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RutinaController extends Controller
{
    public function index()
    {
        $rutinas = Rutina::withCount('dias')->paginate(15);
        return view('admin.rutinas.index', compact('rutinas'));
    }

    public function create()
    {
        $niveles = ['Principiante', 'Intermedio', 'Avanzado'];
        $objetivos = ['Aumento de masa muscular', 'Pérdida de peso', 'Mantenimiento y tonificación'];
        $duraciones = ['2 días', '3 días', '5 días'];
        $ejercicios = Ejercicio::select('id', 'nombre', 'nivel')->get();

        return view('admin.rutinas.create', compact('niveles', 'objetivos', 'duraciones', 'ejercicios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nivel' => 'required|in:Principiante,Intermedio,Avanzado',
            'duracion' => 'required|in:2 días,3 días,5 días',
            'objetivo' => 'required',
            'descripcion' => 'nullable|string|max:2000',
            'days' => 'required|array|min:1',
            'days.*.grupo_muscular' => 'required|string|max:255',
            'days.*.ejercicios' => 'required|array|min:1',
            'days.*.ejercicios.*.ejercicio_id' => 'required|integer|exists:ejercicios,id',
            'days.*.ejercicios.*.series' => 'required|integer|in:2,3,4',
            'days.*.ejercicios.*.repeticiones' => 'required|string',
            'days.*.ejercicios.*.recomendacion' => 'nullable|string|max:1000',
        ]);

        $nombre = 'Rutina ' . $request->nivel . ' ' . $request->duracion;

        DB::beginTransaction();
        try {
            $rutina = Rutina::create([
                'nombre' => $nombre,
                'descripcion' => $request->descripcion,
                'nivel' => $request->nivel,
                'objetivo' => $request->objetivo,
                'duracion' => $request->duracion,
            ]);

            $diaNumero = 1;
            foreach ($request->days as $day) {
                $dia = DiaRutina::create([
                    'rutina_id' => $rutina->id,
                    'dia_numero' => $diaNumero,
                    'grupo_muscular' => $day['grupo_muscular'],
                ]);

                foreach ($day['ejercicios'] as $ej) {
                    EjercicioRutina::create([
                        'dia_rutina_id' => $dia->id,
                        'ejercicio_id' => $ej['ejercicio_id'],
                        'series' => $ej['series'],
                        'repeticiones' => json_encode($this->parseReps($ej['repeticiones'])),
                        'recomendacion' => $ej['recomendacion'] ?? null,
                    ]);
                }

                $diaNumero++;
            }

            DB::commit();
            return redirect()->route('admin.rutinas.index')->with('success', 'Rutina creada correctamente.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Error al crear la rutina: ' . $e->getMessage()]);
        }
    }

    public function edit(Rutina $rutina)
    {
        $rutina->load('dias.ejercicios.ejercicio');
        $niveles = ['Principiante', 'Intermedio', 'Avanzado'];
        $objetivos = ['Aumento de masa muscular', 'Pérdida de peso', 'Mantenimiento y tonificación'];
        $duraciones = ['2 días', '3 días', '5 días'];
        $ejercicios = Ejercicio::select('id', 'nombre', 'nivel')->get();

        return view('admin.rutinas.edit', compact('rutina', 'niveles', 'objetivos', 'duraciones', 'ejercicios'));
    }

    public function update(Request $request, Rutina $rutina)
{
    DB::beginTransaction();

    try {
        $data = $request->all();
        $errores = [];

        // ✅ Validar que existan días y datos obligatorios
        if (isset($data['dias']) && is_array($data['dias'])) {
            foreach ($data['dias'] as $diaId => $diaData) {
                if (empty($diaData['grupo_muscular'])) {
                    $errores[] = "El nombre del día {$diaId} es obligatorio.";
                }

                if (isset($diaData['ejercicios']) && is_array($diaData['ejercicios'])) {
                    foreach ($diaData['ejercicios'] as $index => $ej) {
                        if (empty($ej['ejercicio_id'])) {
                            $errores[] = "Falta seleccionar el ejercicio en el día {$diaId}, ejercicio #".($index+1).".";
                        }
                        if (empty($ej['series'])) {
                            $errores[] = "Faltan las series en el día {$diaId}, ejercicio #".($index+1).".";
                        }
                        if (empty($ej['repeticiones'])) {
                            $errores[] = "Faltan las repeticiones en el día {$diaId}, ejercicio #".($index+1).".";
                        }
                    }
                } else {
                    $errores[] = "Debe agregar al menos un ejercicio en el día {$diaId}.";
                }
            }
        } else {
            $errores[] = "Debe existir al menos un día con ejercicios.";
        }

        // ⚠️ Si hay errores, regresar sin guardar
        if (!empty($errores)) {
            return back()->withErrors($errores)->withInput();
        }

        // ✅ Actualizar descripción y nombre
        $rutina->update([
            'descripcion' => $data['descripcion'] ?? null,
            'nombre' => 'Rutina ' . $rutina->nivel . ' ' . $rutina->duracion,
        ]);

        // ✅ Actualizar los días y sus ejercicios
        foreach ($data['dias'] as $diaId => $diaData) {
            $dia = DiaRutina::find($diaId);
            if (!$dia || $dia->rutina_id != $rutina->id) continue;

            // Actualiza grupo muscular
            $dia->update(['grupo_muscular' => $diaData['grupo_muscular']]);

            foreach ($diaData['ejercicios'] as $ejData) {
                // Si existe, actualizar
                if (!empty($ejData['id'])) {
                    $ejercicio = EjercicioRutina::find($ejData['id']);
                    if ($ejercicio) {
                        $ejercicio->update([
                            'ejercicio_id' => $ejData['ejercicio_id'],
                            'series' => $ejData['series'],
                            'repeticiones' => json_encode($this->parseReps($ejData['repeticiones'])),
                            'recomendacion' => $ejData['recomendacion'] ?? null,
                        ]);
                    }
                } else {
                    // Si no existe (nuevo ejercicio) → crear
                    EjercicioRutina::create([
                        'dia_rutina_id' => $dia->id,
                        'ejercicio_id' => $ejData['ejercicio_id'],
                        'series' => $ejData['series'],
                        'repeticiones' => json_encode($this->parseReps($ejData['repeticiones'])),
                        'recomendacion' => $ejData['recomendacion'] ?? null,
                    ]);
                }
            }
        }

        // ✅ Eliminar los ejercicios marcados
        if ($request->filled('eliminados')) {
            $ids = json_decode($request->eliminados, true);
            if (is_array($ids) && count($ids)) {
                EjercicioRutina::whereIn('id', $ids)->delete();
            }
        }

        DB::commit();

        return redirect()
            ->route('admin.rutinas.edit', $rutina->id)
            ->with('success', '✅ Rutina actualizada correctamente.');
    } catch (\Throwable $e) {
        DB::rollBack();
        return back()->withInput()->withErrors(['error' => 'Error al actualizar la rutina: ' . $e->getMessage()]);
    }
}


    public function destroy(Rutina $rutina)
    {
        DB::transaction(function () use ($rutina) {
            foreach ($rutina->dias as $dia) {
                $dia->ejercicios()->delete();
            }
            $rutina->dias()->delete();
            $rutina->delete();
        });

        return redirect()->route('admin.rutinas.index')->with('success', 'Rutina eliminada correctamente.');
    }

    private function parseReps($raw)
    {
        if (!$raw) return [];
        $raw = trim($raw);

        if (str_starts_with($raw, '[')) {
            return json_decode($raw, true);
        }

        if (str_contains($raw, ',')) {
            return array_map('trim', explode(',', $raw));
        }

        return [$raw];
    }
}
