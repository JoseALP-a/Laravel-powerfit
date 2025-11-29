<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\RutinaController as AdminRutinaController;
use App\Http\Controllers\Admin\EjercicioController as AdminEjercicioController;
use App\Http\Controllers\Admin\AdminController as AdminAdminController;
use App\Http\Controllers\Admin\AsesoriaController;

// 🔐 RUTAS DE LOGIN ADMIN
Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

// 🧩 RUTAS PROTEGIDAS - SOLO ADMIN AUTENTICADO
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Usuarios
    Route::resource('usuarios', AdminUserController::class, ['as' => 'admin']);

    // Rutinas
    Route::resource('rutinas', AdminRutinaController::class, ['as' => 'admin']);

    // Ejercicios
    Route::resource('ejercicios', AdminEjercicioController::class, ['as' => 'admin']);

    // Administradores
    Route::resource('admins', AdminAdminController::class, ['as' => 'admin']);

// 🔹 Asesoría (crear, editar, actualizar)
Route::get('asesoria', [AsesoriaController::class, 'index'])->name('admin.asesoria.index');
Route::post('asesoria', [AsesoriaController::class, 'store'])->name('admin.asesoria.store');
Route::put('asesoria/{asesoria}', [AsesoriaController::class, 'update'])->name('admin.asesoria.update');


});
