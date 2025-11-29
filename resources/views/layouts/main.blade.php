<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>PowerFit - Panel</title>
    <link rel="icon" href="{{ asset('Imagenes/PowerFitIcon.png') }}" type="image/png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ===== Fondo general ===== */
        body {
            font-family: 'Inter', sans-serif;
            background-image: url('{{ asset("Imagenes/PowerFitPanelUser.jpg") }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            margin: 0;
            min-height: 100vh;
            color: #ffffff;
        }

        /* ===== Sidebar (negro traslúcido con efecto) ===== */
        .sidebar {
            width: 260px;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            overflow-y: auto;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(8px);
            color: #ffffff;
            padding-bottom: 2rem;
            box-shadow: 4px 0 20px rgba(0,0,0,0.4);
            transition: all 0.3s ease-in-out;
        }

        .sidebar .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 1.25rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar .brand img {
            width: 44px;
            height: 44px;
            border-radius: 999px;
            object-fit: cover;
            border: 2px solid rgba(255,255,255,0.2);
        }

        .sidebar .brand h1 {
            margin: 0;
            font-size: 1.2rem;
            font-weight: 800;
            color: #fff;
        }

        /* ===== Menú lateral ===== */
        nav.menu {
            margin-top: 1rem;
            padding: 0.5rem;
        }

        nav.menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.7rem 1rem;
            margin: 0.35rem 0.5rem;
            border-radius: 10px;
            color: #f5f5f5;
            text-decoration: none;
            transition: all 0.25s ease;
            font-weight: 600;
        }

        nav.menu a svg {
            width: 22px;
            height: 22px;
            flex-shrink: 0;
        }

        nav.menu a:hover {
            background: rgba(255, 102, 0, 0.2);
            color: #ff6600;
            transform: translateX(4px);
        }

        nav.menu a.active {
            background: rgba(255, 102, 0, 0.25);
            color: #ff6600;
            font-weight: 700;
        }

        .logout-btn {
            display: block;
            margin: 1.5rem 0.8rem 0 0.8rem;
            background: rgba(255,255,255,0.12);
            color: #fff;
            padding: 0.6rem 0.9rem;
            border-radius: 9px;
            text-align: left;
            font-weight: 700;
            border: none;
            width: calc(100% - 1.6rem);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background: rgba(255, 102, 0, 0.3);
            color: #ff6600;
        }

        /* ===== Contenido principal ===== */
        .content {
            margin-left: 260px;
            padding: 2rem;
            min-height: 100vh;
        }

        /* ===== Flash messages ===== */
        .flash-success {
            background: rgba(34,197,94,0.15);
            color: #d1fae5;
            border-left: 4px solid #10b981;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .flash-error {
            background: rgba(239,68,68,0.15);
            color: #fee2e2;
            border-left: 4px solid #ef4444;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        /* ===== Botón móvil ===== */
        .menu-btn {
            display: none;
            position: fixed;
            z-index: 60;
            left: 12px;
            top: 12px;
            background: rgba(0,0,0,0.8);
            color: white;
            border-radius: 8px;
            padding: 8px 10px;
            border: none;
        }

        @media (max-width: 900px) {
            .sidebar { transform: translateX(-300px); }
            .sidebar.show { transform: translateX(0); }
            .content { margin-left: 0; padding: 1rem; }
            .menu-btn { display: inline-block; }
        }
    </style>
</head>
<body>
    <button class="menu-btn" onclick="document.getElementById('sidebar').classList.toggle('show')">☰</button>

    {{-- ===== Sidebar ===== --}}
    <aside id="sidebar" class="sidebar">
        <div class="brand">
            <img src="{{ asset('Imagenes/PowerFitIcon.png') }}" alt="PowerFit Logo">
            <div>
                <h1>PowerFit</h1>
                <div style="font-size:12px; opacity:0.85;">Panel de usuario</div>
            </div>
        </div>

        <nav class="menu">
            <a href="{{ route('user.panel') }}" class="{{ request()->routeIs('user.panel') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.75 11.25 12 4.5l8.25 6.75v6.75A1.5 1.5 0 0 1 19.5 19.5h-15a1.5 1.5 0 0 1-1.5-1.5v-6.75z" /></svg>
                Inicio
            </a>

            <a href="{{ route('profile.show') }}" class="{{ request()->routeIs('profile.show') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
                Perfil
            </a>

            <a href="{{ route('user.registro') }}" class="{{ request()->routeIs('user.registro') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6M9 16h6M5.25 7.5h13.5M6 20.25h12a.75.75 0 0 0 .75-.75V7.5A2.25 2.25 0 0 0 16.5 5.25h-9A2.25 2.25 0 0 0 5.25 7.5v12a.75.75 0 0 0 .75.75z"/></svg>
                Completar registro
            </a>

            <a href="{{ route('user.rutina') }}" class="{{ request()->routeIs('user.rutina') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M3 12h1.5M19.5 12H21M7.5 9v6M16.5 9v6M4.5 9h15" /></svg>
                Obtener rutina
            </a>

            <a href="{{ route('user.videos') }}" class="{{ request()->routeIs('user.videos') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="m15.75 10.5 4.72-4.72A.75.75 0 0 1 22 6.3v11.4a.75.75 0 0 1-1.53.22L15.75 13.5M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9A2.25 2.25 0 0 0 13.5 5.25h-9A2.25 2.25 0 0 0 2.25 7.5v9A2.25 2.25 0 0 0 4.5 18.75z"/></svg>
                Videos
            </a>

            <a href="{{ route('user.asesoria') }}" class="{{ request()->routeIs('user.asesoria') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M21 12c0 4.556-4.03 8.25-9 8.25S3 16.556 3 12 7.03 3.75 12 3.75 21 7.444 21 12zM8.625 11.625h.375M12 11.625h.375M15.375 11.625h.375"/></svg>
                Asesoría
            </a>

            <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('¿Seguro que deseas cerrar sesión?')">
                @csrf
                <button class="logout-btn" type="submit">Cerrar sesión</button>
            </form>
        </nav>
    </aside>

    {{-- ===== Contenido ===== --}}
    <main class="content">
        @if (session('success'))
            <div class="flash-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="flash-error">{{ session('error') }}</div>
        @endif

        @yield('content')
    </main>
</body>
</html>
