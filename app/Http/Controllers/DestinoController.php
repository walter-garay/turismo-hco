<?php

namespace App\Http\Controllers;

use App\Models\Destino;
use App\Models\FotoDestino;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DestinoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Obtener el término de búsqueda y la categoría desde la solicitud
        $search = $request->input('search');
        $categoria = $request->input('categoria');

        // Filtrar los destinos por búsqueda y/o categoría
        $destinos = Destino::with('fotos')
                    ->when($search, function ($query, $search) {
                        return $query->where('nombre', 'like', '%' . $search . '%');
                    })
                    ->when($categoria, function ($query, $categoria) {
                        return $query->where('categoria', $categoria);
                    })
                    ->get();

        // Obtener todas las categorías para el dropdown
        $categorias = Destino::select('categoria')->distinct()->get();

        // Pasar los resultados y categorías a la vista
        return view('destinos.index', compact('destinos', 'categorias'));
    }

    public function adminIndex()
    {
        // Obtener todos los destinos con paginación para los administradores
        $destinos = Destino::paginate(10); // Cambia el número según tus necesidades
        
        // Retornar la vista de administración
        return view('admin.destinos.index', compact('destinos'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retornamos la vista para crear un nuevo destino
        return view('destinos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'ubicacion' => 'nullable|string',
            'historia' => 'nullable|string',
            'categoria' => 'required|string|max:100',
            'fotos' => 'array',
            'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Cada archivo debe ser una imagen
        ]);

        // Crear el destino
        $destino = Destino::create($request->only([
            'nombre', 
            'descripcion', 
            'ubicacion', 
            'historia', 
            'categoria'
        ]));

        // Si hay fotos, guardarlas
        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $foto) {
                $path = $foto->store('public/destinos'); // Guardar cada imagen en 'storage/app/public/destinos'
                FotoDestino::create([
                    'destino_id' => $destino->id,
                    'url' => $path,
                ]);
            }
        }

        return redirect()->route('destinos.index')->with('success', 'Destino creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Destino $destino)
    {
        // Mostramos un destino específico junto con sus fotos
        $destino->load('fotos');
        return view('destinos.show', compact('destino'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Destino $destino)
    {
        // Retornamos la vista para editar el destino
        return view('destinos.edit', compact('destino'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Destino $destino)
    {
        // Validación de los datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'ubicacion' => 'nullable|string',
            'historia' => 'nullable|string',
            'categoria' => 'required|string|max:100',
            'fotos' => 'array',
            'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validar las imágenes
        ]);

        // Actualizar los datos del destino
        $destino->update($request->only([
            'nombre', 
            'descripcion', 
            'ubicacion', 
            'historia', 
            'categoria'
        ]));

        // Si hay nuevas fotos, las guardamos
        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $foto) {
                $path = $foto->store('public/destinos');
                FotoDestino::create([
                    'destino_id' => $destino->id,
                    'url' => $path,
                ]);
            }
        }

        return redirect()->route('destinos.index')->with('success', 'Destino actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destino $destino)
    {
        // Eliminar las fotos asociadas al destino
        foreach ($destino->fotos as $foto) {
            Storage::delete($foto->url); 
            $foto->delete();
        }

        // Eliminar el destino
        $destino->delete();

        return redirect()->route('admin.destinos.index')->with('success', 'Destino eliminado correctamente.');
    }

}
