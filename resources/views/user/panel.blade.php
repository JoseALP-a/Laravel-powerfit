<title>PowerFit - Inicio</title>
@extends('layouts.main')

@section('content')
    <style>
        /* Card principal y estilos (igual que antes) */
        .pf-card {
            background: rgba(0,0,0,0.7);
            color: white;
            border-radius: 14px;
            padding: 25px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.5);
            text-align: center;
        }

        .pf-title {
            color: #ff6600;
            font-weight: 800;
            font-size: 22px;
            margin-bottom: 8px;
        }

        .pf-subtitle {
            color: #e5e7eb;
            margin-bottom: 18px;
        }

        .days-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
            width: 100%;
            max-width: 520px;
            margin: 0 auto;
        }

        .day-btn {
            width: 100%;
            padding: 12px 0;
            border-radius: 10px;
            font-weight: 700;
            border: 2px solid #4b5563;
            background: transparent;
            color: #f1f1f1;
            cursor: pointer;
            transition: all .2s ease;
        }

        .day-btn:hover {
            transform: translateY(-3px);
            border-color: rgba(255,102,0,0.7);
            color: #ffddc8;
        }

        .day-active {
            border-color: #ff6600 !important;
            background: linear-gradient(90deg, #ff7a00, #ff5100) !important;
            color: #fff !important;
        }

        .progress-bar {
            width: 90%;
            max-width: 520px;
            margin: 16px auto 0 auto;
            background: #374151;
            border-radius: 999px;
            height: 12px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #ff7a00, #ff5100);
            width: 0%; /* empieza en 0% y se aplica con JS */
            border-radius: 999px;
            transition: width 0.8s ease-in-out;
        }

        .progress-text {
            margin-top: 10px;
            color: white;
            font-weight: 700;
        }

        .welcome-title {
            font-size: 28px;
            margin-bottom: 6px;
            color: white;
            font-weight: 800;
        }

        .welcome-sub {
            margin: 0;
            color: #f1f1f1;
        }

        @media (max-width: 640px) {
            .days-grid { gap: 8px; }
            .pf-card { padding: 18px; }
        }
    </style>

    {{-- Encabezado de bienvenida --}}
    <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap;">
        <div>
            <h1 class="welcome-title">¡Bienvenido, {{ $user->name }}!</h1>
            <p class="welcome-sub">Sigue tu progreso semanal y mantente constante en tu entrenamiento.</p>
        </div>

        @if($user->rutina_id)
            <div>
                <a href="{{ route('user.rutina') }}" style="background: #ff6600; color:white; padding:10px 14px; border-radius:10px; font-weight:700; text-decoration:none; transition:all 0.3s;">
                    Ver mi rutina
                </a>
            </div>
        @endif
    </div>

    <div style="height:28px;"></div>

    {{-- Contenedor del progreso --}}
    <div style="display:flex; justify-content:center; align-items:center;">
        <div style="width:100%; max-width:720px;">
            <div class="pf-card">
                <h2 class="pf-title">📅 Progreso semanal</h2>
                <p class="pf-subtitle">Marca los días que completaste tu entrenamiento.</p>

                <div class="days-grid" role="grid" aria-label="Dias de la semana">
                    @foreach (['lunes','martes','miercoles','jueves','viernes','sabado','domingo'] as $dia)
                        <form method="POST" action="{{ route('user.progreso.toggle', $dia) }}">
                            @csrf
                            @php $isActive = (bool) ($progreso->$dia ?? false); @endphp
                            <button
                                type="submit"
                                class="day-btn {{ $isActive ? 'day-active' : '' }}"
                                aria-pressed="{{ $isActive ? 'true' : 'false' }}"
                                title="{{ ucfirst($dia) }}"
                            >
                                {{ strtoupper(substr($dia,0,3)) }}
                            </button>
                        </form>
                    @endforeach
                </div>

                @php
                    $diasMarcados = collect(['lunes','martes','miercoles','jueves','viernes','sabado','domingo'])
                        ->filter(fn($d) => !empty($progreso->$d))
                        ->count();
                    $porcentaje = round(($diasMarcados / 7) * 100);
                @endphp

                {{-- barra y porcentaje: usamos data-porcentaje para evitar cualquier inyección en style --}}
                <div class="progress-bar" role="progressbar" aria-valuenow="{{ $porcentaje }}" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-fill" data-porcentaje="{{ $porcentaje }}"></div>
                </div>

                <div class="progress-text">
                    Progreso total: <span style="color:#ff6600;">{{ $porcentaje }}%</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Script pequeño y seguro que aplica el width desde data-porcentaje --}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll('.progress-fill').forEach(el => {
                const pct = Number(el.dataset.porcentaje) || 0;
                // arrancamos en 0 para que la transición funcione
                el.style.width = '0%';
                // ligera espera para forzar la animación
                setTimeout(() => el.style.width = pct + '%', 80);
            });
        });
    </script>

    {{-- Contenedor del IMC con clasificación OMS (corrección: altura en metros) --}}
<div style="height:30px;"></div>

<div style="display:flex; justify-content:center; align-items:center;">
    <div style="width:100%; max-width:720px;">
        <div class="pf-card">
            <h2 class="pf-title">⚖️ Índice de Masa Corporal (IMC)</h2>
            <p class="pf-subtitle">Conoce tu IMC y la clasificación según la Organización Mundial de la Salud.</p>

            @php
                // Tomar y normalizar valores (soporta '72,00' y '72.00')
                $peso_raw = $user->peso ?? null;
                $altura_raw = $user->altura ?? null;

                $peso = $peso_raw !== null ? floatval(str_replace(',', '.', $peso_raw)) : null;
                $altura = $altura_raw !== null ? floatval(str_replace(',', '.', $altura_raw)) : null;

                $imc = null;
                $clasificacion = null;
                $recomendacion = null;

                if ($peso && $altura && $altura > 0) {
                    // Si la altura probablemente viene en centímetros (ej.: 175), la convertimos.
                    // Si la altura ya está en metros (ej.: 1.75) la usamos directamente.
                    $altura_m = ($altura > 10) ? ($altura / 100) : $altura;

                    // Evitar división por cero
                    if ($altura_m > 0) {
                        $imc = round($peso / ($altura_m ** 2), 2);
                    } else {
                        $imc = null;
                    }

                    // Clasificación OMS completa
                    if ($imc !== null) {
                        if ($imc < 16.00) {
                            $clasificacion = "Infrapeso: Delgadez severa";
                            $recomendacion = "Se recomienda aumentar masa muscular y valorar la alimentación con un profesional.";
                        } elseif ($imc < 17.00) {
                            $clasificacion = "Infrapeso: Delgadez moderada";
                            $recomendacion = "Plan de aumento de peso sano con seguimiento nutricional.";
                        } elseif ($imc < 18.50) {
                            $clasificacion = "Infrapeso: Delgadez aceptable";
                            $recomendacion = "Enfocarse en aumentar masa muscular y consumir energía suficiente.";
                        } elseif ($imc < 25.00) {
                            $clasificacion = "Peso Normal";
                            $recomendacion = "IMC dentro del rango saludable. Mantén tonificación y buen rendimiento.";
                        } elseif ($imc < 30.00) {
                            $clasificacion = "Sobrepeso";
                            $recomendacion = "Objetivo: pérdida de grasa con mezcla de cardio y fuerza, y control dietario.";
                        } elseif ($imc < 35.00) {
                            $clasificacion = "Obeso: Tipo I";
                            $recomendacion = "Iniciar plan supervisado de reducción de peso y actividad física adaptada.";
                        } elseif ($imc <= 40.00) {
                            $clasificacion = "Obeso: Tipo II";
                            $recomendacion = "Plan integral con apoyo médico y nutricional.";
                        } else {
                            $clasificacion = "Obeso: Tipo III (mórbida)";
                            $recomendacion = "Buscar atención médica especializada y plan de salud personalizado.";
                        }
                    }
                }
            @endphp

            @if ($peso && $altura && $imc !== null)
                <div style="margin-top:15px; font-size:18px; font-weight:700;">
                    Tu IMC es: <span style="color:#ff6600;">{{ number_format($imc, 2, '.', '') }}</span>
                </div>
                <div style="margin-top:6px; font-size:16px; color:#f1f1f1;">
                    Clasificación: <strong>{{ $clasificacion }}</strong>
                </div>
                <div style="margin-top:10px; font-size:15px; color:#d1d5db;">
                    💡 {{ $recomendacion }}
                </div>

                <div style="margin-top:20px;">
                    <table style="width:100%; border-collapse:collapse; color:#f1f1f1; font-size:14px;">
                        <thead>
                            <tr style="background:rgba(255,102,0,0.25); color:white;">
                                <th style="padding:8px; border-bottom:1px solid rgba(255,255,255,0.2); text-align:left;">Índice de Masa Corporal</th>
                                <th style="padding:8px; border-bottom:1px solid rgba(255,255,255,0.2); text-align:left;">Clasificación</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>&lt;16.00</td><td>Infrapeso: Delgadez severa</td></tr>
                            <tr><td>16.00 - 16.99</td><td>Infrapeso: Delgadez moderada</td></tr>
                            <tr><td>17.00 - 18.49</td><td>Infrapeso: Delgadez aceptable</td></tr>
                            <tr><td>18.50 - 24.99</td><td><strong>Peso Normal</strong></td></tr>
                            <tr><td>25.00 - 29.99</td><td>Sobrepeso</td></tr>
                            <tr><td>30.00 - 34.99</td><td>Obeso: Tipo I</td></tr>
                            <tr><td>35.00 - 40.00</td><td>Obeso: Tipo II</td></tr>
                            <tr><td>&gt;40.00</td><td>Obeso: Tipo III</td></tr>
                        </tbody>
                    </table>
                </div>
            @else
                <div style="margin-top:15px; font-size:15px; color:#d1d5db;">
                    Aún no has completado tus datos de peso y altura o hay un valor inválido.  
                    <a href="{{ route('user.registro') }}" style="color:#ff6600; text-decoration:underline;">Haz clic aquí</a> para actualizarlos y calcular tu IMC.
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
