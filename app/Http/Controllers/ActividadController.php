<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Destino;
use Illuminate\Http\Request;

class ActividadController extends Controller
{
    public function mostrarEventos(Request $request)
    {
        $destinos = Destino::all(); // Obtener todos los destinos
        $categorias = Actividad::where('tipo', 'evento')->distinct()->pluck('categoria'); // Obtener todas las categorías únicas de eventos

        $destinoId = $request->input('destino'); // Obtener el destino seleccionado en el filtro
        $categoria = $request->input('categoria'); // Obtener la categoría seleccionada en el filtro

        // Filtrar eventos por destino y categoría seleccionados si están presentes
        $eventos = Actividad::where('tipo', 'evento')
            ->when($destinoId, function ($query, $destinoId) {
                return $query->where('destino_id', $destinoId);
            })
            ->when($categoria, function ($query, $categoria) {
                return $query->where('categoria', $categoria);
            })
            ->get(['id', 'nombre', 'fecha_evento', 'hora_inicio', 'hora_fin', 'destino_id', 'categoria']);

        return view('eventos.index', compact('eventos', 'destinos', 'categorias', 'destinoId', 'categoria'));
    }

    public function verEvento($id)
    {
        // Encuentra el evento por ID o lanza un error 404 si no existe
        $evento = Actividad::findOrFail($id);
        return view('eventos.show', compact('evento'));
    }



    // PARA ADMINISTRADORES

    public function index()
    {
        $actividades = Actividad::with('destino')->paginate(10); // Usamos 'with' para cargar el destino asociado
        return view('admin.actividades.index', compact('actividades'));
    }

    // Método para mostrar el formulario de creación
    public function create()
    {
        $destinos = Destino::all(); // Obtener todos los destinos para el select en el formulario
        return view('admin.actividades.create', compact('destinos'));
    }

    // Método para almacenar una nueva actividad en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'tipo' => 'required|in:actividad,evento',
            'categoria' => 'nullable|string',
            'fecha_evento' => 'nullable|date',
            'hora_inicio' => 'nullable|date_format:H:i',
            'hora_fin' => 'nullable|date_format:H:i',
            'destino_id' => 'required|exists:destinos,id',
        ]);

        Actividad::create($request->all());

        return redirect()->route('admin.actividades.index')->with('success', 'Actividad creada con éxito');
    }

    // Método para mostrar el formulario de edición
    public function edit($id)
    {
        $actividad = Actividad::findOrFail($id);
        $destinos = Destino::all();
        return view('admin.actividades.edit', compact('actividad', 'destinos'));
    }


    // Método para actualizar una actividad existente en la base de datos
    public function update(Request $request, $id)
    {
        $actividad = Actividad::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'tipo' => 'required|in:actividad,evento',
            'categoria' => 'nullable|string',
            'fecha_evento' => 'nullable|date',
            'hora_inicio' => 'nullable',
            'hora_fin' => 'nullable',
            'destino_id' => 'required|exists:destinos,id',
        ]);

        $actividad->update($request->all());

        return redirect()->route('admin.actividades.index')->with('success', 'Actividad actualizada con éxito');
    }

    // Método para eliminar una actividad
    public function destroy($id)
    {
        $actividad = Actividad::findOrFail($id);
        $actividad->delete();

        return redirect()->route('admin.actividades.index')->with('success', 'Actividad eliminada con éxito');
    }
}
