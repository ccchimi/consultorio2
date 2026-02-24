<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\TurnoController;
use Illuminate\Support\Facades\Route;

/**
 * Ruta raíz: redirige al login si no está autenticado.
 */
Route::get('/', function () {
    return redirect()->route('login');
});

/**
 * Dashboard del consultorio (panel principal luego de login).
 */
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/**
 * Rutas protegidas por autenticación
 */
Route::middleware('auth')->group(function () {
    // Módulos del sistema
    Route::resource('pacientes', PacienteController::class);
    Route::resource('turnos', TurnoController::class);

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

});

// Rutas de autenticación (login, registro, logout, etc.)
require __DIR__.'/auth.php';

