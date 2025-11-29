<x-action-section>
    <x-slot name="title"></x-slot>

    <x-slot name="description">
        Cierra sesión en otros navegadores o dispositivos donde tu cuenta esté activa.
    </x-slot>

    <x-slot name="content">
        <div class="text-black text-sm">
            Si sospechas que tu cuenta fue comprometida, cierra las demás sesiones y cambia tu contraseña.
        </div>

        @if (count($this->sessions) > 0)
            <div class="mt-5 space-y-4">
                @foreach ($this->sessions as $session)
                    <div class="flex items-center text-black">
                        <div>
                            @if ($session->agent->isDesktop())
                                💻
                            @else
                                📱
                            @endif
                        </div>
                        <div class="ms-3">
                            <div class="text-sm">
                                {{ $session->agent->platform() ?: 'Desconocido' }} - {{ $session->agent->browser() ?: 'Desconocido' }}
                            </div>
                            <div class="text-xs text-gray-400">
                                {{ $session->ip_address }},
                                @if ($session->is_current_device)
                                    <span class="text-green-400">Este dispositivo</span>
                                @else
                                    Último acceso: {{ $session->last_active }}
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="flex items-center mt-5">
            <x-button wire:click="confirmLogout">Cerrar otras sesiones</x-button>
            <x-action-message class="ms-3 text-green-400" on="loggedOut">Listo.</x-action-message>
        </div>
    </x-slot>
</x-action-section>
