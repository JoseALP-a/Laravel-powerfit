<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Rutina;
use App\Models\ProgresoSemanal;

class UserPanelController extends Controller
{
    /**
     * 🏠 Panel principal del usuario
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user instanceof User) {
            return redirect()->route('login')->with('error', 'Por favor, inicia sesión para continuar.');
        }

        // Obtener o crear el progreso semanal
        $progreso = ProgresoSemanal::firstOrCreate(['user_id' => $user->id]);

        return view('user.panel', compact('user', 'progreso'));
    }

    /**
     * ✅ Marca o desmarca un día de entrenamiento
     */
    public function toggleProgreso($dia)
    {
        $user = Auth::user();
        $progreso = ProgresoSemanal::firstOrCreate(['user_id' => $user->id]);

        if (!in_array($dia, ['lunes','martes','miercoles','jueves','viernes','sabado','domingo'])) {
            return back()->with('error', 'Día inválido.');
        }

        $progreso->$dia = !$progreso->$dia;
        $progreso->save();

        return back()->with('success', 'Progreso actualizado correctamente.');
    }

    /**
     * 🧾 Muestra el formulario de completar registro físico
     */
    public function registro()
    {
        $user = Auth::user();

        if (!$user instanceof User) {
            return redirect()->route('login')->with('error', 'Por favor, inicia sesión antes de continuar.');
        }

        return view('user.registro', compact('user'));
    }

    /**
     * 💾 Guarda los datos físicos y asigna la rutina ideal
     */
    public function guardarRegistro(Request $request)
    {
        $user = Auth::user();

        if (!$user instanceof User) {
            return redirect()->route('login')->with('error', 'Debe iniciar sesión antes de continuar.');
        }

        // 🔹 Validar datos físicos (con mensajes personalizados)
        $validated = $request->validate(
            [
                'edad' => 'required|integer|min:10|max:100',
                'peso' => 'required|numeric|min:30|max:200',
                'altura' => 'required|numeric|min:1|max:2.5',
                'sexo' => 'required|in:M,F,Otro',
                'nivel_experiencia' => 'required|in:Principiante,Intermedio,Avanzado',
                'objetivo' => 'required|in:Aumento de masa muscular,Pérdida de peso,Mantenimiento y tonificación',
                'tiempo_disponible' => 'required|in:2 días,3 días,5 días',
            ],
            [
                'altura.min' => '⚠️ La altura debe ser al menos 1 metro (usa metros, no centímetros).',
                'altura.max' => '⚠️ La altura debe estar en metros, por ejemplo: 1.70 (no 170).',
                'altura.required' => '⚠️ Por favor, ingresa tu altura en metros.',
            ]
        );

        // 🔸 Validación adicional: altura ingresada en centímetros (por ejemplo 170)
        if ($request->altura > 3) {
            return back()
                ->withInput()
                ->with('error', '⚠️ La altura debe estar en metros (por ejemplo, 1.75). Por favor corrige el campo.');
        }

        try {
            // Guardar datos del usuario
            foreach ($validated as $key => $value) {
                $user->$key = $value;
            }
            $user->save();

            // Buscar una rutina compatible
            $rutina = Rutina::where('nivel', $user->nivel_experiencia)
                ->where('objetivo', $user->objetivo)
                ->where('duracion', $user->tiempo_disponible)
                ->first();

            if ($rutina) {
                $user->rutina_id = $rutina->id;
                $user->save();

                return redirect()->route('user.rutina')
                    ->with('success', 'Registro completado y rutina asignada correctamente.');
            } else {
                return redirect()->route('user.panel')
                    ->with('error', 'Por el momento no hay rutinas disponibles para tu perfil.');
            }
        } catch (\Throwable $e) {
            return back()->with('error', 'Error al guardar los datos: ' . $e->getMessage());
        }
    }

    /**
     * 💪 Muestra la rutina asignada con sus ejercicios
     */
    public function rutina()
    {
        $user = Auth::user();

        if (!$user instanceof User) {
            return redirect()->route('login')->with('error', 'Por favor, inicia sesión.');
        }

        // Verificar que haya completado su registro
        $campos = ['edad', 'peso', 'altura', 'sexo', 'nivel_experiencia', 'objetivo', 'tiempo_disponible'];
        foreach ($campos as $campo) {
            if (empty($user->$campo)) {
                return redirect()->route('user.registro')
                    ->with('error', '⚠️ Antes de continuar, por favor completa tu registro.');
            }
        }

        if (!$user->rutina_id) {
            return redirect()->route('user.panel')
                ->with('error', '🔸 No se ha asignado ninguna rutina.');
        }

        $rutina = Rutina::with(['dias.ejercicios.ejercicio'])->find($user->rutina_id);

        if (!$rutina) {
            return redirect()->route('user.panel')
                ->with('error', '❌ No se encontró la rutina asignada.');
        }

        return view('user.rutina', compact('rutina', 'user'));
    }

    /**
     * 🎥 Muestra los videos de los ejercicios de la rutina del usuario
     */
    public function videos()
    {
        $user = Auth::user();

        if (!$user instanceof User) {
            return redirect()->route('login')->with('error', 'Por favor, inicia sesión para continuar.');
        }

        $campos = ['edad', 'peso', 'altura', 'sexo', 'nivel_experiencia', 'objetivo', 'tiempo_disponible'];
        foreach ($campos as $campo) {
            if (empty($user->$campo)) {
                return redirect()->route('user.registro')
                    ->with('error', '⚠️ Debes completar tu registro antes de ver los videos.');
            }
        }

        if (!$user->rutina_id) {
            return redirect()->route('user.panel')
                ->with('error', '🔸 No tienes una rutina asignada.');
        }

        $rutina = Rutina::with(['dias.ejercicios.ejercicio'])->find($user->rutina_id);

        if (!$rutina) {
            return redirect()->route('user.panel')
                ->with('error', '❌ No se encontró tu rutina.');
        }

        $ejercicios = collect();
        foreach ($rutina->dias as $dia) {
            foreach ($dia->ejercicios as $detalle) {
                if ($detalle->ejercicio && $detalle->ejercicio->video_url) {
                    $ejercicios->push($detalle->ejercicio);
                }
            }
        }
        $ejercicios = $ejercicios->unique('id');

        return view('user.videos', compact('ejercicios', 'user'));
    }

    /**
 * 💬 Página de asesoría virtual (con datos desde la BD)
 */
public function asesoria()
{
    $asesoria = \App\Models\Asesoria::where('activo', true)->first();

    if ($asesoria) {
        $numero = preg_replace('/[^0-9]/', '', $asesoria->numero_whatsapp); // limpia el número
        $whatsapp = "https://wa.me/{$numero}?text=" . urlencode($asesoria->mensaje_default);
        $mensaje = $asesoria->mensaje_default;
        $activo = true;
    } else {
        $whatsapp = "#";
        $mensaje = "En este momento no hay asesorías disponibles. Intenta más tarde.";
        $activo = false;
    }

    return view('user.asesoria', compact('whatsapp', 'mensaje', 'activo'));
}

    /**
     * 🚪 Cierra la sesión del usuario
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
            ->with('status', 'Sesión cerrada correctamente.');
    }
}
