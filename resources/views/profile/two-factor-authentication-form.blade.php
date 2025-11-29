<x-action-section>
    <x-slot name="title"></x-slot>

    <x-slot name="description">
        Agrega una capa adicional de seguridad a tu cuenta.
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-semibold text-black">
            @if ($this->enabled)
                @if ($showingConfirmation)
                    Finaliza la activación de la autenticación en dos pasos.
                @else
                    La autenticación en dos pasos está activada.
                @endif
            @else
                No tienes activada la autenticación en dos pasos.
            @endif
        </h3>

        <div class="mt-3 text-black">
            <p>
                Cuando la autenticación en dos pasos esté habilitada, se te pedirá un código generado por tu aplicación de autenticación (como Google Authenticator).
            </p>
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mt-4 text-black">
                    <p class="font-semibold">
                        Escanea el siguiente código QR o usa la clave de configuración:
                    </p>
                </div>

                <div class="mt-4 p-2 inline-block bg-white rounded">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>

                <div class="mt-2 text-black">
                    <p><strong>Clave:</strong> {{ decrypt($this->user->two_factor_secret) }}</p>
                </div>
            @endif
        @endif

        <div class="mt-5">
            @if (! $this->enabled)
                <x-confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-button>Activar</x-button>
                </x-confirms-password>
            @else
                <x-confirms-password wire:then="disableTwoFactorAuthentication">
                    <x-danger-button>Desactivar</x-danger-button>
                </x-confirms-password>
            @endif
        </div>
    </x-slot>
</x-action-section>
