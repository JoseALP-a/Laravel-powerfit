<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro | PowerFit</title>
    <link rel="icon" href="{{ asset('Imagenes/PowerFitIcon.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background-image: url("{{ asset('Imagenes/PowerFitHome.jpg') }}");
            background-size: cover;
            background-position: center;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333;
        }

        .register-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0 0 15px rgba(255, 123, 0, 0.5);
            padding: 40px;
            width: 420px;
            text-align: center;
            position: relative;
        }

        .logo-title {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .logo-title img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 2px solid #ff7b00;
            padding: 5px;
        }

        .logo-title h2 {
            color: #ff7b00;
            font-weight: 700;
            font-size: 1.8rem;
            margin: 0;
        }

        p {
            color: #555;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 2px solid #ff7b00;
            border-radius: 8px;
            font-size: 14px;
        }

        button {
            background: linear-gradient(90deg, #ff7b00, #ffb347);
            color: white;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            cursor: pointer;
            transition: 0.3s;
            width: 100%;
            margin-top: 10px;
        }

        button:hover {
            transform: scale(1.05);
        }

        .link {
            margin-top: 15px;
            font-size: 14px;
        }

        .link a {
            color: #ff7b00;
            text-decoration: none;
            font-weight: 500;
        }

        .link a:hover {
            text-decoration: underline;
        }

        .home-button {
            position: absolute;
            top: 15px;
            right: 15px;
            background: white;
            border: 2px solid #ff7b00;
            color: #ff7b00;
            font-weight: 600;
            border-radius: 8px;
            padding: 5px 12px;
            font-size: 0.9rem;
            text-decoration: none;
            transition: 0.3s;
        }

        .home-button:hover {
            background: #ff7b00;
            color: white;
        }

        /* 🔸 Estilo para los mensajes de error */
        .error-message {
            background: rgba(255, 102, 0, 0.1);
            color: #d9534f;
            border: 1px solid #ff7b00;
            border-radius: 8px;
            padding: 8px;
            font-size: 0.9rem;
            margin-top: 4px;
            text-align: left;
        }

        .alert {
            background: rgba(255, 123, 0, 0.15);
            color: #ff6600;
            border-left: 4px solid #ff7b00;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <a href="{{ url('/') }}" class="home-button">Home</a>

        <div class="logo-title">
            <img src="{{ asset('Imagenes/PowerFitIcon.png') }}" alt="PowerFit Logo">
            <h2>PowerFit</h2>
        </div>

        <p>Crea tu cuenta y comienza tu transformación</p>

        {{-- 🔹 Mostrar mensajes de error generales --}}
        @if ($errors->any())
            <div class="alert">
                <strong>⚠️ Ocurrieron algunos errores:</strong>
                <ul style="margin-top: 6px; list-style: none; padding: 0;">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- 🔹 Mostrar mensajes de estado (por ejemplo, registro exitoso) --}}
        @if (session('status'))
            <div class="alert" style="background: rgba(46, 204, 113, 0.15); border-left-color: #2ecc71; color: #2ecc71;">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <input type="text" name="name" placeholder="Nombre completo" value="{{ old('name') }}" required>
            @error('name')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <input type="email" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" required>
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <input type="password" name="password" placeholder="Contraseña" required>
            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <input type="password" name="password_confirmation" placeholder="Confirmar contraseña" required>
            @error('password_confirmation')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <button type="submit">Registrarse</button>
        </form>

        <div class="link">
            <p>¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión</a></p>
        </div>
    </div>
</body>
</html>