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

// Ruta para el dashboard (solo accesible para usuarios autenticados)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grupo de rutas protegidas para el perfil del usuario
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('destinos/{destino}/resena', action: [ResenaController::class, 'store'])->name('resenas.store');

    Route::post('itinerarios/{destino}/agregar-actividad/{actividad}', [ItinerarioController::class, 'agregarActividad'])->name('itinerarios.agregarActividad');
    Route::delete('itinerarios/{destino}/actividad/{actividad}/quitar', [ItinerarioController::class, 'quitarActividad'])->name('itinerarios.quitarActividad');
    Route::get('itinerarios/{itinerario}/actividades/{actividad}/edit', [ItinerarioController::class, 'editActividad'])
    ->name('itinerarios.editActividad');
    Route::put('itinerarios/{itinerario}/actividades/{actividad}', [ItinerarioController::class, 'actualizarActividad'])
        ->name('itinerarios.actualizarActividad');

});

// Rutas generales de los destinos, visibles para todos los usuarios
Route::resource('destinos', DestinoController::class);
Route::resource('itinerarios', controller: ItinerarioController::class);
// Rutas generales para actividades, itinerarios, reseñas, paquetes y reservas
Route::resource('actividades', ActividadController::class);
// Route::resource('resenas', ResenaController::class);
Route::resource('paquetes', PaqueteTuristicoController::class);
Route::resource('reservas', ReservaController::class);

// Grupo de rutas protegidas para administradores bajo el prefijo 'admin'
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // Rutas específicas para la administración de destinos
    Route::get('destinos', [DestinoController::class, 'adminIndex'])->name('admin.destinos.index');
    Route::get('destinos/create', [DestinoController::class, 'create'])->name('admin.destinos.create');
    Route::post('destinos', [DestinoController::class, 'store'])->name('admin.destinos.store');
    Route::get('destinos/{destino}/edit', [DestinoController::class, 'edit'])->name('admin.destinos.edit');
    Route::put('destinos/{destino}', [DestinoController::class, 'update'])->name('admin.destinos.update');
    Route::delete('destinos/{destino}', [DestinoController::class, 'destroy'])->name('admin.destinos.destroy');
});



require __DIR__.'/auth.php';
