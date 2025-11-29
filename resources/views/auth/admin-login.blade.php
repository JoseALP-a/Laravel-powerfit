<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Administrador | PowerFit</title>
    <link rel="icon" type="image/png" href="{{ asset('Imagenes/PowerFitIcon.png') }}">
    <style>
        /* Fondo y body */
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

        /* Contenedor principal */
        .login-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            padding: 40px;
            width: 400px;
            text-align: center;
            position: relative;
        }

        /* Logo y título */
        .logo-title {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .logo-title img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }

        .logo-title h1 {
            color: #ff7b00;
            font-weight: 700;
            font-size: 1.8rem;
            margin: 0;
        }

        /* Texto descriptivo */
        p {
            color: #555;
            margin-bottom: 20px;
        }

        /* Inputs */
        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 2px solid #ff7b00;
            border-radius: 8px;
            font-size: 14px;
            box-sizing: border-box;
        }

        /* Botón */
        .btn-orange {
            background: linear-gradient(90deg, #ff7a00, #ff5100);
            color: white;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            cursor: pointer;
            width: 100%;
            margin-top: 15px;
            transition: all 0.3s ease;
        }

        .btn-orange:hover {
            transform: scale(1.05);
            box-shadow: 0 0 10px rgba(255, 102, 0, 0.6);
        }

        /* Enlace al home */
        .back-home {
            display: inline-block;
            padding: 0.6rem 1.4rem;
            background: transparent;
            color: #444;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            text-decoration: none;
            margin-top: 15px;
            transition: color 0.3s ease;
        }

        .back-home:hover {
            color: #ff3300;
        }

        /* Errores de validación */
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

    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-title">
            <img src="{{ asset('Imagenes/PowerFitIcon.png') }}" alt="PowerFit Logo">
            <h1>PowerFit Admin</h1>
        </div>

        <p>Accede a tu panel de administración</p>

        {{-- Mostrar errores generales --}}
        @if ($errors->any())
            <div class="error-message">
                <ul style="margin: 0; padding-left: 16px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <input type="email" name="email" placeholder="Correo del Administrador" value="{{ old('email') }}" required autofocus>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit" class="btn-orange">Iniciar sesión</button>
        </form>

        <a href="{{ url('/') }}" class="back-home">← Volver al Home</a>
    </div>
</body>
</html>
