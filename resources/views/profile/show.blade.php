<title>PowerFit - Perfil</title>
@extends('layouts.main')

@section('content')
<style>
    /* === Estilos PowerFit del perfil === */
    .pf-card {
        background: rgba(0,0,0,0.75);
        backdrop-filter: blur(6px);
        border-radius: 14px;
        padding: 25px;
        margin-bottom: 2rem;
        box-shadow: 0 6px 20px rgba(0,0,0,0.5);
        border: 1px solid rgba(255,102,0,0.4);
        color: #f1f1f1;
    }

    .pf-card h2 {
        color: #ff7a00;
        font-size: 1.4rem;
        font-weight: 800;
        margin-bottom: 1rem;
    }

    label {
        color: #fff;
        font-weight: 500;
    }

    input, select {
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,102,0,0.3);
        border-radius: 8px;
        padding: 8px;
        width: 100%;
        color: #050000ff;
    }

    input::placeholder {
        color: #ddd;
    }

    input:focus {
        outline: none;
        border-color: #ff6600;
        box-shadow: 0 0 6px rgba(255,102,0,0.5);
    }

    button {
        background: linear-gradient(90deg, #ff7a00, #ff5100);
        border: none;
        color: white;
        font-weight: 700;
        padding: 10px 18px;
        border-radius: 10px;
        cursor: pointer;
        transition: 0.3s;
    }

    button:hover {
        transform: scale(1.05);
    }

    .text-gray-700{
        color: #0c0000ff !important;
    }
    .text-gray-600, .text-gray-800 {
        color: #ffffffff  !important;
    }

    .text-gray-500 {
        color: #ccc !important;
    }

    .bg-gray-100 {
        background: rgba(255,255,255,0.1) !important;
    }

    .text-green-600 {
        color: #22c55e !important;
    }

    .text-red-600 {
        color: #ef4444 !important;
    }

    .border-gray-200 {
        border-color: rgba(255,255,255,0.1);
    }
</style>

<div class="max-w-5xl mx-auto mt-8">

    {{-- Información del perfil --}}
    <div class="pf-card">
        <h2>Información del perfil</h2>
        <p class="text-sm mb-4">Actualiza tu nombre o correo electrónico.</p>
        @livewire('profile.update-profile-information-form')
    </div>

    {{-- Actualizar Contraseña --}}
    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
        <div class="pf-card">
            <h2>Actualizar Contraseña</h2>
            <p class="text-sm mb-4">Cambia tu contraseña actual por una más segura.</p>
            @livewire('profile.update-password-form')
        </div>
    @endif

    {{-- Autenticación en dos pasos --}}
    @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
        <div class="pf-card">
            <h2>Autenticación en dos pasos</h2>
            <p class="text-sm mb-4">Añade una capa adicional de seguridad a tu cuenta.</p>
            @livewire('profile.two-factor-authentication-form')
        </div>
    @endif

    {{-- Sesiones activas del navegador --}}
    <div class="pf-card">
        <h2>Sesiones activas del navegador</h2>
        <p class="text-sm mb-4">
            Cierra sesión en otros navegadores o dispositivos donde hayas iniciado sesión.
        </p>
        @livewire('profile.logout-other-browser-sessions-form')
    </div>

    {{-- Eliminar cuenta --}}
    @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
        <div class="pf-card">
            <h2>Eliminar cuenta</h2>
            <p class="text-sm mb-4">
                Elimina permanentemente tu cuenta y todos los datos asociados. Esta acción no se puede deshacer.
            </p>
            @livewire('profile.delete-user-form')
        </div>
    @endif
</div>
@endsection

