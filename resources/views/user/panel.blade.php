@extends('layouts.main')

@section('content')
<div style="display:flex; justify-content:center; align-items:flex-start; padding-top:50px;">

    <div style="
        background: rgba(0,0,0,0.7);
        border-radius: 20px;
        padding: 30px;
        width: 420px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.6);
        backdrop-filter: blur(6px);
        border: 1px solid rgba(255,255,255,0.1);
        color: white;
    ">

        <h2 style="text-align:center; color:#ff6600; font-size:2rem; font-weight:700; margin-bottom:20px;">
            {{ $user->edad ? 'Editar Registro' : 'Completar Registro' }}
        </h2>

        {{-- Mensajes flash --}}
        @if (session('success'))
            <div style="margin-bottom:15px; padding:10px; border-radius:8px; background: rgba(46, 204, 113, 0.2); color:#2ecc71; border:1px solid rgba(46,204,113,0.4); font-size:0.9rem;">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div style="margin-bottom:15px; padding:10px; border-radius:8px; background: rgba(255,0,0,0.2); color:#ff8080; border:1px solid rgba(255,0,0,0.4); font-size:0.9rem;">
                {{ session('error') }}
            </div>
        @endif

        {{-- Errores de validación --}}
        @if ($errors->any())
            <div style="margin-bottom:15px; padding:10px; border-radius:8px; background: rgba(255,0,0,0.2); color:#ff8080; border:1px solid rgba(255,0,0,0.4); font-size:0.9rem;">
                <ul style="margin:0; padding-left:20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user.registro.guardar') }}" method="POST">
            @csrf

            <label style="display:block; margin-bottom:6px; font-size:0.9rem; color:#ddd;">Edad</label>
            <input type="number" name="edad" value="{{ old('edad', $user->edad) }}" required
                style="width:100%; padding:10px; margin-bottom:12px; border-radius:8px; border:2px solid rgba(255,255,255,0.3); background: rgba(255,255,255,0.05); color:white; font-size:14px;">

            <label style="display:block; margin-bottom:6px; font-size:0.9rem; color:#ddd;">Peso (kg)</label>
            <input type="number" step="0.1" name="peso" value="{{ old('peso', $user->peso) }}" required
                style="width:100%; padding:10px; margin-bottom:12px; border-radius:8px; border:2px solid rgba(255,255,255,0.3); background: rgba(255,255,255,0.05); color:white; font-size:14px;">

            <label style="display:block; margin-bottom:6px; font-size:0.9rem; color:#ddd;">Altura (m)</label>
            <input type="number" step="0.01" name="altura" value="{{ old('altura', $user->altura) }}" required
                style="width:100%; padding:10px; margin-bottom:12px; border-radius:8px; border:2px solid rgba(255,255,255,0.3); background: rgba(255,255,255,0.05); color:white; font-size:14px;">

            <label style="display:block; margin-bottom:6px; font-size:0.9rem; color:#ddd;">Sexo</label>
            <select name="sexo" required
                style="width:100%; padding:10px; margin-bottom:12px; border-radius:8px; border:2px solid rgba(255,255,255,0.3); background: rgba(255,255,255,0.05); color:white; font-size:14px;">
                <option value="">Selecciona...</option>
                <option value="M" {{ $user->sexo == 'M' ? 'selected' : '' }}>Masculino</option>
                <option value="F" {{ $user->sexo == 'F' ? 'selected' : '' }}>Femenino</option>
                <option value="Otro" {{ $user->sexo == 'Otro' ? 'selected' : '' }}>Otro</option>
            </select>

            <label style="display:block; margin-bottom:6px; font-size:0.9rem; color:#ddd;">Nivel de experiencia</label>
            <select name="nivel_experiencia" required
                style="width:100%; padding:10px; margin-bottom:12px; border-radius:8px; border:2px solid rgba(255,255,255,0.3); background: rgba(255,255,255,0.05); color:white; font-size:14px;">
                <option value="">Selecciona...</option>
                <option value="Principiante" {{ $user->nivel_experiencia == 'Principiante' ? 'selected' : '' }}>Principiante</option>
                <option value="Intermedio" {{ $user->nivel_experiencia == 'Intermedio' ? 'selected' : '' }}>Intermedio</option>
                <option value="Avanzado" {{ $user->nivel_experiencia == 'Avanzado' ? 'selected' : '' }}>Avanzado</option>
            </select>

            <label style="display:block; margin-bottom:6px; font-size:0.9rem; color:#ddd;">Objetivo</label>
            <select name="objetivo" required
                style="width:100%; padding:10px; margin-bottom:12px; border-radius:8px; border:2px solid rgba(255,255,255,0.3); background: rgba(255,255,255,0.05); color:white; font-size:14px;">
                <option value="">Selecciona...</option>
                <option value="Aumento de masa muscular" {{ $user->objetivo == 'Aumento de masa muscular' ? 'selected' : '' }}>Aumento de masa muscular</option>
                <option value="Pérdida de peso" {{ $user->objetivo == 'Pérdida de peso' ? 'selected' : '' }}>Pérdida de peso</option>
                <option value="Mantenimiento y tonificación" {{ $user->objetivo == 'Mantenimiento y tonificación' ? 'selected' : '' }}>Mantenimiento y tonificación</option>
            </select>

            <label style="display:block; margin-bottom:6px; font-size:0.9rem; color:#ddd;">Tiempo disponible</label>
            <select name="tiempo_disponible" required
                style="width:100%; padding:10px; margin-bottom:18px; border-radius:8px; border:2px solid rgba(255,255,255,0.3); background: rgba(255,255,255,0.05); color:white; font-size:14px;">
                <option value="">Selecciona...</option>
                <option value="2 días" {{ $user->tiempo_disponible == '2 días' ? 'selected' : '' }}>2 días</option>
                <option value="3 días" {{ $user->tiempo_disponible == '3 días' ? 'selected' : '' }}>3 días</option>
                <option value="5 días" {{ $user->tiempo_disponible == '5 días' ? 'selected' : '' }}>5 días</option>
            </select>

            <button type="submit" style="
                width:100%;
                padding:12px;
                border-radius:10px;
                font-weight:700;
                background: linear-gradient(90deg, #ff7a00, #ff5100);
                color:white;
                border:none;
                cursor:pointer;
                transition: all 0.3s ease;
                font-size:1rem;
            " onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 0 15px rgba(255,123,0,0.6)';" 
               onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';">
                {{ $user->edad ? '💾 Actualizar registro' : '✅ Guardar y asignar rutina' }}
            </button>
        </form>

    </div>
</div>
@endsection
