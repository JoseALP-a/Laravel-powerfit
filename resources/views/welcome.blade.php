<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>PowerFit</title>
    <link rel="icon" href="{{ asset('Imagenes/PowerFitIcon.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            color: white;
            background-image: url("{{ asset('Imagenes/PowerFitHome.jpg') }}");
            background-size: cover;
            background-position: center;
            height: 100vh;
        }

        /* 🔹 Header transparente con borde blanco */
        header {
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 60px;
            border-bottom: 2px solid white;
            background: transparent;
        }

        /* 🔹 Logo + icono */
        .logo {
            display: flex;
            align-items: center;
            font-weight: 800;
            font-size: 1.8rem;
            color: white;
        }

        .logo img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        /* 🔹 Enlaces del menú */
        .nav-links a {
            margin-left: 30px;
            text-decoration: none;
            color: white;
            font-weight: 600;
            transition: 0.3s;
        }

        .nav-links a:hover {
            color: #ff7b00; /* Naranja PowerFit */
        }

        /* 🔹 Contenido principal alineado a la izquierda */
        .main-content {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            padding-left: 80px;
            text-align: left;
            background: rgba(0, 0, 0, 0);
        }

        .main-content h1 {
            font-size: 4rem;
            font-weight: 800;
            color: white;
            margin-bottom: 10px;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
        }

        .main-content span {
            color: #ff7b00;
        }

        .main-content p {
            font-size: 1.3rem;
            font-weight: 500;
            color: #fff;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>

<body>
    <!-- 🔸 Header -->
    <header>
        <div class="logo">
            <img src="{{ asset('Imagenes/PowerFitIcon.png') }}" alt="PowerFit Icon">
            <span>PowerFit</span>
        </div>

        <div class="nav-links">
            <a href="/">Home</a>
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        </div>
    </header>

    <!-- 🔸 Contenido principal -->
    <div class="main-content">
        <h1>Bienvenido a <span>PowerFit</span></h1>
        <p>Transforma tu cuerpo. Transforma tu vida.</p>
    </div>
</body>
</html>
