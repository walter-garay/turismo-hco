<?php

namespace App\Http\Controllers;

use App\Models\Itinerario;
use Illuminate\Http\Request;

use App\Models\ItinerarioActividad;
use App\Models\Destino;
use Illuminate\Support\Facades\Auth;

use Barryvdh\DomPDF\Facade\Pdf;

class ItinerarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();

        // Obtener todos los itinerarios del usuario y ordenar actividades por fecha y hora de inicio
        $itinerarios = Itinerario::with(['actividades' => function ($query) {
            $query->orderBy('itinerario_actividades.fecha', 'asc')  // Ordenar por fecha
                  ->orderBy('itinerario_actividades.hora_inicio', 'asc'); // Luego por hora de inicio
        }])
        ->where('usuario_id', $userId)
        ->get();

        return view('itinerarios.index', compact('itinerarios'));
    }

    public function exportarPdf($id)
    {
        $itinerario = Itinerario::with('actividades')->findOrFail($id);

        // Reemplazar caracteres especiales en el nombre del archivo
        $filename = 'itinerario_' . preg_replace('/[^A-Za-z0-9\-]/', '_', $itinerario->nombre) . '.pdf';

        $pdf = Pdf::loadView('itinerarios.pdf', compact('itinerario'))
                ->setPaper('a4', 'portrait');

        return $pdf->download($filename);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Itinerario $itinerario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Itinerario $itinerario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Itinerario $itinerario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Itinerario $itinerario)
    {
        //
    }

    public function agregarActividad(Request $request, $destinoId, $actividadId)
    {
        // 1. Obtener el ID del usuario autenticado
        $userId = Auth::id();

        // 2. Verificar si ya existe un itinerario para el usuario en el destino
        $itinerario = Itinerario::where('usuario_id', $userId)
                                ->where('destino_id', $destinoId)
                                ->first();

        // 3. Si no existe el itinerario, crearlo con el nombre del destino
        if (!$itinerario) {
            // Obtener el nombre del destino
            $destino = Destino::findOrFail($destinoId);

            $itinerario = Itinerario::create([
                'usuario_id' => $userId,
                'destino_id' => $destinoId,
                'nombre' => 'Itinerario para ' . $destino->nombre,  // Usar el nombre del destino
                'fecha_creacion' => now(),
            ]);
        }

        // 4. Verificar si la actividad ya está en el itinerario (opcional, para evitar duplicados)
        $existeActividad = ItinerarioActividad::where('itinerario_id', $itinerario->id)
                                            ->where('actividad_id', $actividadId)
                                            ->exists();

        if ($existeActividad) {
            return redirect()->back()->with('error', 'La actividad ya está en tu itinerario.');
        }

        // 5. Registrar la actividad en la tabla itinerario_actividades
        ItinerarioActividad::create([
            'itinerario_id' => $itinerario->id,
            'actividad_id' => $actividadId,
            'fecha' => null,  // Puede ser asignado más tarde por el usuario
            'hora_inicio' => null,
            'hora_fin' => null,
        ]);

        return redirect()->back()->with('success', 'Actividad agregada a tu itinerario.');
    }


    public function quitarActividad($destinoId, $actividadId)
    {
        // 1. Obtener el ID del usuario autenticado
        $userId = Auth::id();

        // 2. Obtener el itinerario del usuario para el destino
        $itinerario = Itinerario::where('usuario_id', $userId)
                                ->where('destino_id', $destinoId)
                                ->first();

        // Si no existe el itinerario, redirigir con un mensaje de error
        if (!$itinerario) {
            return redirect()->back()->with('error', 'No tienes un itinerario para este destino.');
        }

        // 3. Eliminar directamente la actividad del itinerario (si existe)
        ItinerarioActividad::where('itinerario_id', $itinerario->id)
                            ->where('actividad_id', $actividadId)
                            ->delete();

        return redirect()->back()->with('success', 'Actividad eliminada de tu itinerario.');
    }


    public function editActividad($itinerarioId, $actividadId)
    {
        $itinerario = Itinerario::findOrFail($itinerarioId);
        $actividad = $itinerario->actividades()->where('actividad_id', $actividadId)->firstOrFail();

        return view('itinerarios.edit', compact('itinerario', 'actividad'));
    }

    public function actualizarActividad(Request $request, $itinerarioId, $actividadId)
    {
        // Validar los datos
        $request->validate([
            'fecha' => 'nullable|date',
            'hora_inicio' => 'nullable',
            'hora_fin' => 'nullable|after:hora_inicio',
        ], [
            'fecha.date' => 'La fecha debe ser una fecha válida.',
            'hora_fin.after' => 'La hora de fin debe ser mayor que la hora de inicio.',
        ]);

        // Actualizar directamente en la tabla pivote
        ItinerarioActividad::where('itinerario_id', $itinerarioId)
                            ->where('actividad_id', $actividadId)
                            ->update([
                                'fecha' => $request->input('fecha'),
                                'hora_inicio' => $request->input('hora_inicio'),
                                'hora_fin' => $request->input('hora_fin'),
                            ]);

        return redirect()->route('itinerarios.index')->with('success', 'Actividad actualizada en el itinerario.');
    }



}
