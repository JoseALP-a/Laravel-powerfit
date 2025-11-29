<x-form-section submit="updatePassword">
    <x-slot name="title"></x-slot>

    <x-slot name="description">
        Asegúrate de usar una contraseña segura y única para proteger tu cuenta.
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4 text-white">
            <x-label for="current_password" value="Contraseña actual" />
            <x-input id="current_password" type="password" class="mt-1 block w-full" wire:model="state.current_password" />
            <x-input-error for="current_password" class="mt-2 text-red-400" />
        </div>

        <div class="col-span-6 sm:col-span-4 text-white">
            <x-label for="password" value="Nueva contraseña" />
            <x-input id="password" type="password" class="mt-1 block w-full" wire:model="state.password" />
            <x-input-error for="password" class="mt-2 text-red-400" />
        </div>

        <div class="col-span-6 sm:col-span-4 text-white">
            <x-label for="password_confirmation" value="Confirmar contraseña" />
            <x-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model="state.password_confirmation" />
            <x-input-error for="password_confirmation" class="mt-2 text-red-400" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3 text-green-400" on="saved">Guardado.</x-action-message>
        <x-button>Guardar cambios</x-button>
    </x-slot>
</x-form-section>
