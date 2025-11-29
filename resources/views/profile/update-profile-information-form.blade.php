<x-form-section submit="updateProfileInformation">
    <x-slot name="title"></x-slot>

    <x-slot name="description">
        Actualiza los datos de tu cuenta y correo electrónico.
    </x-slot>

    <x-slot name="form">
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4 text-white">
                <input type="file" id="photo" class="hidden"
                       wire:model.live="photo"
                       x-ref="photo"
                       x-on:change="
                            photoName = $refs.photo.files[0].name;
                            const reader = new FileReader();
                            reader.onload = (e) => photoPreview = e.target.result;
                            reader.readAsDataURL($refs.photo.files[0]);
                       " />

                <x-label for="photo" value="Foto de perfil" class="text-white" />

                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full size-20 object-cover border border-orange-500">
                </div>

                <div class="mt-2" x-show="photoPreview" style="display:none;">
                    <span class="block rounded-full size-20 bg-cover bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'"></span>
                </div>

                <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    Seleccionar nueva foto
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        Quitar foto
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2 text-red-400" />
            </div>
        @endif

        <div class="col-span-6 sm:col-span-4 text-black">
            <x-label for="name" value="Nombre" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model="state.name" required />
            <x-input-error for="name" class="mt-2 text-red-400" />
        </div>

        <div class="col-span-6 sm:col-span-4 text-black">
            <x-label for="email" value="Correo electrónico" />
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" required />
            <x-input-error for="email" class="mt-2 text-red-400" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && !$this->user->hasVerifiedEmail())
                <p class="text-sm mt-2 text-black">
                    Tu correo aún no ha sido verificado.
                    <button type="button" class="underline text-orange-400 hover:text-orange-500"
                            wire:click.prevent="sendEmailVerification">
                        Haz clic aquí para reenviar el correo de verificación.
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-medium text-sm text-green-400">
                        Se ha enviado un nuevo enlace de verificación a tu correo electrónico.
                    </p>
                @endif
            @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3 text-green-400" on="saved">Guardado.</x-action-message>
        <x-button wire:loading.attr="disabled" wire:target="photo">Guardar</x-button>
    </x-slot>
</x-form-section>
