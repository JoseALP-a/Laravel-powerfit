<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Administrador | PowerFit</title>
    <link rel="icon" type="image/png" href="{{ asset('Imagenes/PowerFitIcon.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background-image: url("{{ asset('Imagenes/PowerFitHome.jpg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.97);
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-container img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: inline-block;
            vertical-align: middle;
            margin-right: 10px;
        }

        .login-container h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #ff6600;
            display: inline-block;
            vertical-align: middle;
        }

        .login-container p {
            color: #444;
            margin-bottom: 1.5rem;
        }

        .btn-orange {
            background: linear-gradient(90deg, #ff7a00, #ff5100);
            color: white;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            padding: 0.75rem 1.5rem;
            cursor: pointer;
            width: 100%;
            text-align: center;
            transition: all 0.3s ease;
        }

        .btn-orange:hover {
            transform: scale(1.05);
            box-shadow: 0 0 10px rgba(255, 102, 0, 0.6);
        }

        /* ✅ Botón Volver al Home más limpio */
        .back-home {
    display: inline-block;
    padding: 0.6rem 1.4rem;
    background: transparent;
    color: #444;
    font-weight: 600;
    border: none;
    border-radius: 10px;
    text-decoration: none;
    margin-top: 1rem;
    transition: color 0.3s ease;
}

.back-home:hover {
    color: #ff3300;
}
    </style>
</head>
<body>
    <div class="login-container">
        <div class="mb-4">
            <img src="{{ asset('Imagenes/PowerFitIcon.png') }}" alt="PowerFit Icon">
            <h1>PowerFit Admin</h1>
        </div>

        <p>Accede a tu panel de administración</p>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf

            <div class="mt-4 text-left">
                <x-label for="email" value="Correo del Administrador" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4 text-left">
                <x-label for="password" value="Contraseña" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            </div>

            <div class="mt-6">
                <button type="submit" class="btn-orange">Iniciar sesión</button>
            </div>
        </form>

        <a href="{{ url('/') }}" class="back-home">← Volver al Home</a>
    </div>
</body>
</html>
