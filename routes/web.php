<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DestinoController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\ItinerarioController;
use App\Http\Controllers\ResenaController;
use App\Http\Controllers\PaqueteTuristicoController;
use App\Http\Controllers\ReservaController;
use Illuminate\Support\Facades\Route;

// Ruta para la página de inicio
Route::get('/', function () {
    return view('welcome');
});

// Grupo de rutas protegidas para el perfil del usuario
Route::middleware(['auth'])->group(function () {
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('destinos/{destino}/resena', [ResenaController::class, 'store'])->name('resenas.store');

    Route::post('itinerarios/{destino}/agregar-actividad/{actividad}', [ItinerarioController::class, 'agregarActividad'])
        ->name('itinerarios.agregarActividad');
    Route::delete('itinerarios/{destino}/actividad/{actividad}/quitar', [ItinerarioController::class, 'quitarActividad'])
        ->name('itinerarios.quitarActividad');
    Route::get('itinerarios/{itinerario}/actividades/{actividad}/edit', [ItinerarioController::class, 'editActividad'])
        ->name('itinerarios.editActividad');
    Route::put('itinerarios/{itinerario}/actividades/{actividad}', [ItinerarioController::class, 'actualizarActividad'])
        ->name('itinerarios.actualizarActividad');
    Route::get('itinerarios/{id}/exportar-pdf', [ItinerarioController::class, 'exportarPdf'])->name('itinerarios.exportarPdf');

    Route::get('eventos', [ActividadController::class, 'mostrarEventos'])->name('eventos.index');
    Route::get('eventos/{id}', [ActividadController::class, 'verEvento'])->name('eventos.show');
});

// Rutas generales de los destinos, visibles para todos los usuarios
Route::resource('destinos', DestinoController::class);
Route::resource('itinerarios', ItinerarioController::class);
Route::resource('actividades', ActividadController::class);
Route::resource('paquetes', PaqueteTuristicoController::class);
Route::resource('reservas', ReservaController::class);

// Grupo de rutas protegidas para administradores bajo el prefijo 'admin'
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // Administración de destinos
    Route::get('destinos', [DestinoController::class, 'adminIndex'])->name('admin.destinos.index');
    Route::get('destinos/create', [DestinoController::class, 'create'])->name('admin.destinos.create');
    Route::post('destinos', [DestinoController::class, 'store'])->name('admin.destinos.store');
    Route::get('destinos/{destino}/edit', [DestinoController::class, 'edit'])->name('admin.destinos.edit');
    Route::put('destinos/{destino}', [DestinoController::class, 'update'])->name('admin.destinos.update');
    Route::delete('destinos/{destino}', [DestinoController::class, 'destroy'])->name('admin.destinos.destroy');

    // Administración de paquetes turísticos
    Route::get('paquetes', [PaqueteTuristicoController::class, 'adminIndex'])->name('admin.paquetes.index');
    Route::get('paquetes/create', [PaqueteTuristicoController::class, 'create'])->name('admin.paquetes.create');
    Route::post('paquetes', [PaqueteTuristicoController::class, 'store'])->name('admin.paquetes.store');
    Route::get('paquetes/{paquete}/edit', [PaqueteTuristicoController::class, 'edit'])->name('admin.paquetes.edit');
    Route::put('paquetes/{paquete}', [PaqueteTuristicoController::class, 'update'])->name('admin.paquetes.update');
    Route::delete('paquetes/{paquete}', [PaqueteTuristicoController::class, 'destroy'])->name('admin.paquetes.destroy');

    Route::get('actividades', [ActividadController::class, 'index'])->name('admin.actividades.index');
    Route::get('actividades/create', [ActividadController::class, 'create'])->name('admin.actividades.create');
    Route::post('actividades', [ActividadController::class, 'store'])->name('admin.actividades.store');
    Route::get('actividades/{actividad}/edit', [ActividadController::class, 'edit'])->name('admin.actividades.edit');
    Route::put('actividades/{actividad}', [ActividadController::class, 'update'])->name('admin.actividades.update');
    Route::delete('actividades/{actividad}', [ActividadController::class, 'destroy'])->name('admin.actividades.destroy');
});

require __DIR__.'/auth.php';
