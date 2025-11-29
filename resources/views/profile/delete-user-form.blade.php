<x-action-section>
    <x-slot name="title"></x-slot>

    <x-slot name="description">
        Elimina tu cuenta de forma permanente.
    </x-slot>

    <x-slot name="content">
        <div class="text-sm text-black">
            Una vez eliminada, todos tus datos y configuraciones se perderán.  
            Descarga la información que desees conservar antes de continuar.
        </div>

        <div class="mt-5">
            <x-danger-button wire:click="confirmUserDeletion">Eliminar cuenta</x-danger-button>
        </div>

        <x-dialog-modal wire:model.live="confirmingUserDeletion">
            <x-slot name="title">Confirmar eliminación</x-slot>

            <x-slot name="content">
                ¿Estás seguro de que deseas eliminar tu cuenta?  
                Ingresa tu contraseña para confirmar esta acción.

                <div class="mt-4">
                    <x-input type="password" class="mt-1 block w-3/4" placeholder="Contraseña"
                             wire:model="password" wire:keydown.enter="deleteUser" />
                    <x-input-error for="password" class="mt-2 text-red-400" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingUserDeletion')">Cancelar</x-secondary-button>
                <x-danger-button class="ms-3" wire:click="deleteUser">Eliminar definitivamente</x-danger-button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-action-section>
