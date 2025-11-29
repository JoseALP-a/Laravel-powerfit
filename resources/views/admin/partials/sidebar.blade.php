<aside class="w-64 bg-gradient-to-b from-blue-500 to-blue-700 text-white min-h-screen p-6 shadow-xl">
    <!-- LOGO -->
    <div class="flex items-center justify-center mb-10">
        <img src="{{ asset('Imagenes/PowerFitIcon.png') }}" alt="PowerFit Logo" 
             class="w-10 h-10 rounded-full border-2 border-white mr-2 shadow-md">
        <span class="text-2xl font-bold tracking-wide">PowerFit</span>
    </div>

    <!-- NAVEGACIÓN -->
    <nav class="space-y-2">
        <a href="{{ route('admin.dashboard') }}" 
           class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-blue-400 transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-400' : '' }}">
            <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('admin.usuarios.index') }}" 
           class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-blue-400 transition {{ request()->routeIs('admin.usuarios.*') ? 'bg-blue-400' : '' }}">
            <i data-lucide="users" class="w-5 h-5"></i>
            <span>Usuarios</span>
        </a>

        <a href="{{ route('admin.rutinas.index') }}" 
           class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-blue-400 transition {{ request()->routeIs('admin.rutinas.*') ? 'bg-blue-400' : '' }}">
            <i data-lucide="activity" class="w-5 h-5"></i>
            <span>Rutinas</span>
        </a>

        <a href="{{ route('admin.ejercicios.index') }}" 
           class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-blue-400 transition {{ request()->routeIs('admin.ejercicios.*') ? 'bg-blue-400' : '' }}">
            <i data-lucide="dumbbell" class="w-5 h-5"></i>
            <span>Ejercicios</span>
        </a>

        <a href="{{ route('admin.admins.index') }}" 
           class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-blue-400 transition {{ request()->routeIs('admin.admins.*') ? 'bg-blue-400' : '' }}">
            <i data-lucide="shield" class="w-5 h-5"></i>
            <span>Administradores</span>
        </a>
        <a href="{{ route('admin.asesoria.index') }}" 
   class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-blue-400 transition {{ request()->routeIs('admin.asesoria.*') ? 'bg-blue-400' : '' }}">
    <i data-lucide="message-circle" class="w-5 h-5"></i>
    <span>Asesoría</span>
</a>

        <!-- BOTÓN DE CERRAR SESIÓN -->
        <form method="POST" action="{{ route('admin.logout') }}" 
              class="mt-6" 
              onsubmit="return confirmLogout(event)">
            @csrf
            <button type="submit"
                class="flex items-center gap-3 w-full text-left px-4 py-2 rounded-lg hover:bg-red-500 transition">
                <i data-lucide="log-out" class="w-5 h-5"></i>
                <span>Cerrar sesión</span>
            </button>
        </form>
    </nav>

    <!-- CARGA DE ICONOS Y CONFIRMACIÓN -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();

        // 🛑 Confirmación personalizada al cerrar sesión
        function confirmLogout(event) {
            const confirmed = confirm("¿Seguro que deseas cerrar sesión?");
            if (!confirmed) {
                event.preventDefault();
                return false;
            }
            return true;
        }
    </script>
</aside>
