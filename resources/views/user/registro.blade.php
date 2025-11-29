<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>PowerFit - Registro</title>
    <link rel="icon" href="{{ asset('Imagenes/PowerFitIcon.png') }}" type="image/png">
    <style>
        body {
            margin: 0;
            height: 100vh;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom, #000000, #1a1a1a);
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }

        .form-container {
            background: rgba(0,0,0,0.7);
            border-radius: 20px;
            padding: 40px;
            width: 450px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.6);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,0.1);
        }

        h2 {
            color: #ff7b00;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-size: 0.9rem;
            color: #ddd;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 2px solid rgba(255,255,255,0.3);
            background: rgba(255,255,255,0.05);
            color: white;
            font-size: 14px;
            box-sizing: border-box;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #ff7b00;
            box-shadow: 0 0 5px rgba(255,123,0,0.5);
        }

        .button-submit {
            width: 100%;
            background: linear-gradient(90deg, #ff7a00, #ff5100);
            color: white;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            padding: 12px;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .button-submit:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(255,123,0,0.6);
        }

        .error-message {
            background: rgba(255,0,0,0.2);
            color: #ff8080;
            border: 1px solid rgba(255,0,0,0.4);
            border-radius: 8px;
            padding: 10px;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        ul.error-list {
            list-style: disc;
            padding-left: 20px;
            margin: 0;
        }

        .success-message {
            background: rgba(46, 204, 113, 0.2);
            color: #2ecc71;
            border: 1px solid rgba(46,204,113,0.4);
            border-radius: 8px;
            padding: 10px;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>{{ $user->edad ? 'Editar Registro' : 'Completar Registro' }}</h2>

        {{-- Mensajes flash --}}
        @if (session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="error-message">
                {{ session('error') }}
            </div>
        @endif

        {{-- Errores de validación --}}
        @if ($errors->any())
            <div class="error-message">
                <ul class="error-list">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user.registro.guardar') }}" method="POST">
            @csrf

            <label>Edad</label>
            <input type="number" name="edad" value="{{ old('edad', $user->edad) }}" required>

            <label>Peso (kg)</label>
            <input type="number" step="0.1" name="peso" value="{{ old('peso', $user->peso) }}" required>

            <label>Altura (m)</label>
            <input type="number" step="0.01" name="altura" value="{{ old('altura', $user->altura) }}" required>

            <label>Sexo</label>
            <select name="sexo" required>
                <option value="">Selecciona...</option>
                <option value="M" {{ $user->sexo == 'M' ? 'selected' : '' }}>Masculino</option>
                <option value="F" {{ $user->sexo == 'F' ? 'selected' : '' }}>Femenino</option>
                <option value="Otro" {{ $user->sexo == 'Otro' ? 'selected' : '' }}>Otro</option>
            </select>

            <label>Nivel de experiencia</label>
            <select name="nivel_experiencia" required>
                <option value="">Selecciona...</option>
                <option value="Principiante" {{ $user->nivel_experiencia == 'Principiante' ? 'selected' : '' }}>Principiante</option>
                <option value="Intermedio" {{ $user->nivel_experiencia == 'Intermedio' ? 'selected' : '' }}>Intermedio</option>
                <option value="Avanzado" {{ $user->nivel_experiencia == 'Avanzado' ? 'selected' : '' }}>Avanzado</option>
            </select>

            <label>Objetivo</label>
            <select name="objetivo" required>
                <option value="">Selecciona...</option>
                <option value="Aumento de masa muscular" {{ $user->objetivo == 'Aumento de masa muscular' ? 'selected' : '' }}>Aumento de masa muscular</option>
                <option value="Pérdida de peso" {{ $user->objetivo == 'Pérdida de peso' ? 'selected' : '' }}>Pérdida de peso</option>
                <option value="Mantenimiento y tonificación" {{ $user->objetivo == 'Mantenimiento y tonificación' ? 'selected' : '' }}>Mantenimiento y tonificación</option>
            </select>

            <label>Tiempo disponible</label>
            <select name="tiempo_disponible" required>
                <option value="">Selecciona...</option>
                <option value="2 días" {{ $user->tiempo_disponible == '2 días' ? 'selected' : '' }}>2 días</option>
                <option value="3 días" {{ $user->tiempo_disponible == '3 días' ? 'selected' : '' }}>3 días</option>
                <option value="5 días" {{ $user->tiempo_disponible == '5 días' ? 'selected' : '' }}>5 días</option>
            </select>

            <button type="submit" class="button-submit">
                {{ $user->edad ? '💾 Actualizar registro' : '✅ Guardar y asignar rutina' }}
            </button>
        </form>
    </div>
</body>
</html>
