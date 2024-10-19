<?php

namespace App\Http\Controllers;

use App\Models\PaqueteTuristico;
use Illuminate\Http\Request;

use App\Models\Destino;
use App\Models\Actividad;


class PaqueteTuristicoController extends Controller
{
    /**
     * Muestra la lista de paquetes turísticos para turistas
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $ordenar = $request->input('ordenar');
        $destinoId = $request->input('destino');

        // Obtener los destinos para el filtro de destino
        $destinos = Destino::with('fotos')->get();

        // Obtener los paquetes turísticos filtrados y ordenados
        $paquetes = PaqueteTuristico::with('destino.fotos')
            ->when($search, function ($query, $search) {
                return $query->where('nombre', 'like', '%' . $search . '%');
            })
            ->when($destinoId, function ($query, $destinoId) {
                return $query->where('destino_id', $destinoId);
            })
            ->when($ordenar, function ($query, $ordenar) {
                if ($ordenar === 'precio') {
                    return $query->orderBy('precio_individual', 'asc');
                } elseif ($ordenar === 'duracion') {
                    return $query->orderBy('duracion', 'asc');
                }
            })
            ->get();

        return view('paquetes.index', compact('paquetes', 'destinos'));
    }


    /**
     * Muestra la lista de paquetes para administradores.
     */
    public function adminIndex()
    {
        // Obtener todos los paquetes turísticos con paginación para los administradores
        $paquetes = PaqueteTuristico::paginate(10);
        return view('admin.paquetes.index', compact('paquetes'));
    }

    /**
     * Muestra el formulario para crear un nuevo paquete turístico.
     */
    public function create()
    {
        // Obtener todos los destinos y las actividades disponibles
        $destinos = Destino::all(); // Para seleccionar el destino
        $actividades = Actividad::all(); // Para seleccionar las actividades del destino

        // Pasar los destinos y las actividades a la vista
        return view('admin.paquetes.create', compact('destinos', 'actividades'));
    }


    /**
     * Almacena un nuevo paquete turístico en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos básicos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio_individual' => 'required|numeric',
            'duracion' => 'required|integer',
            'destino_id' => 'required|exists:destinos,id', // El destino debe existir en la tabla de destinos
            'actividades' => 'nullable|array', // Ahora no es requerido
        ]);

        // Validar que las actividades pertenezcan al destino seleccionado, si se seleccionaron
        $actividadesSeleccionadas = $request->input('actividades', []); // Default es un array vacío si no hay actividades seleccionadas
        $destinoId = $request->input('destino_id');

        if (!empty($actividadesSeleccionadas)) {
            $actividadesValidas = Actividad::whereIn('id', $actividadesSeleccionadas)
                ->where('destino_id', $destinoId)
                ->count();

            if ($actividadesValidas !== count($actividadesSeleccionadas)) {
                return back()->withErrors(['actividades' => 'Algunas actividades no pertenecen al destino seleccionado.'])->withInput();
            }
        }

        // Crear el paquete turístico
        $paquete = PaqueteTuristico::create($request->only([
            'nombre', 'descripcion', 'precio_individual', 'duracion', 'destino_id'
        ]));

        // Registrar las actividades en la tabla pivote (paquete_actividades), si se seleccionaron actividades
        if (!empty($actividadesSeleccionadas)) {
            $paquete->actividades()->sync($actividadesSeleccionadas);
        }

        return redirect()->route('admin.paquetes.index')->with('success', 'Paquete turístico creado correctamente.');
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Obtener el paquete turístico con sus actividades y el destino asociado
        $paquete = PaqueteTuristico::with(['actividades', 'destino.fotos', 'destino.resenas.usuario'])->findOrFail($id);

        // Retornar la vista de detalles del paquete
        return view('paquetes.show', compact('paquete'));
    }


    /**
     * Muestra el formulario para editar un paquete turístico.
     */
    public function edit(PaqueteTuristico $paquete)
    {
        // Obtener los destinos para el dropdown en el formulario
        $destinos = Destino::all();
        return view('admin.paquetes.edit', compact('paquete', 'destinos'));
    }

    /**
     * Actualiza un paquete turístico en la base de datos.
     */
    public function update(Request $request, PaqueteTuristico $paquete)
    {
        // Validar los datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio_individual' => 'required|numeric',
            'duracion' => 'required|integer',
            'destino_id' => 'required|exists:destinos,id',
            'actividades' => 'nullable|array',
        ]);

        // Verificar que las actividades seleccionadas pertenezcan al destino
        $actividadesSeleccionadas = $request->input('actividades', []); // Default es un array vacío si no hay actividades seleccionadas
        $destinoId = $request->input('destino_id');

        if (!empty($actividadesSeleccionadas)) {
            $actividadesValidas = Actividad::whereIn('id', $actividadesSeleccionadas)
                                ->where('destino_id', $destinoId)
                                ->count();

            if ($actividadesValidas !== count($actividadesSeleccionadas)) {
                return back()->withErrors(['actividades' => 'Algunas actividades no pertenecen al destino seleccionado.'])->withInput();
            }
        }

        // Actualizar los datos del paquete turístico
        $paquete->update($request->only([
            'nombre', 'descripcion', 'precio_individual', 'duracion', 'destino_id'
        ]));

        // Actualizar las actividades en la tabla pivote
        $paquete->actividades()->sync($actividadesSeleccionadas);

        return redirect()->route('admin.paquetes.index')->with('success', 'Paquete turístico actualizado correctamente.');
    }


    /**
     * Elimina un paquete turístico de la base de datos.
     */
    public function destroy(PaqueteTuristico $paquete)
    {
        // Eliminar el paquete
        $paquete->delete();

        return redirect()->route('admin.paquetes.index')->with('success', 'Paquete turístico eliminado correctamente.');
    }


}
