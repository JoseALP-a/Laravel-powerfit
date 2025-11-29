<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserPanelController;

Route::get('/', function () {
    return view('welcome');
});

// 🔓 Registro sin autenticación
Route::get('/user/registro', [UserPanelController::class, 'registro'])->name('user.registro');
Route::post('/user/registro', [UserPanelController::class, 'guardarRegistro'])->name('user.registro.guardar');

// 🔑 Redirección del dashboard
Route::get('/dashboard', function () {
    return redirect()->route('user.panel');
})->name('dashboard');

// 🔐 RUTAS PROTEGIDAS DE USUARIO
Route::prefix('user')
    ->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
    ->group(function () {
        Route::get('/panel', [UserPanelController::class, 'index'])->name('user.panel');
        Route::post('/panel/progreso/{dia}', [UserPanelController::class, 'toggleProgreso'])->name('user.progreso.toggle');
        Route::get('/rutina', [UserPanelController::class, 'rutina'])->name('user.rutina');
        Route::get('/asesoria', [UserPanelController::class, 'asesoria'])->name('user.asesoria');
        Route::get('/videos', [UserPanelController::class, 'videos'])->name('user.videos');
        Route::post('/logout', [UserPanelController::class, 'logout'])->name('user.logout');
    });
