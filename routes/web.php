<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserPanelController;

Route::get('/', function () {
    return view('welcome');
});

// 🔑 Redirección del dashboard general de Jetstream
Route::get('/dashboard', function () {
    return redirect()->route('user.panel');
})->name('dashboard');

// 🧍‍♂️ RUTAS USUARIOS NORMALES
Route::prefix('user')
    ->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
    ->group(function () {
        Route::get('/panel', [UserPanelController::class, 'index'])->name('user.panel');
        Route::post('/panel/progreso/{dia}', [UserPanelController::class, 'toggleProgreso'])->name('user.progreso.toggle');

        Route::get('/registro', [UserPanelController::class, 'registro'])->name('user.registro');
        Route::post('/registro', [UserPanelController::class, 'guardarRegistro'])->name('user.registro.guardar');
        Route::get('/rutina', [UserPanelController::class, 'rutina'])->name('user.rutina');
        Route::get('/asesoria', [UserPanelController::class, 'asesoria'])->name('user.asesoria');
        Route::get('/videos', [UserPanelController::class, 'videos'])->name('user.videos');
        Route::post('/logout', [UserPanelController::class, 'logout'])->name('user.logout');
    });
