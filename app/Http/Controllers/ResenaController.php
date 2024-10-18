<?php

namespace App\Http\Controllers;

use App\Models\Resena;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Destino;


class ResenaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, Destino $destino)
    {
        // Validar los datos de la reseña
        $request->validate([
            'calificacion' => 'required|numeric|min:0|max:5',
            'comentarios' => 'required|string|max:500',
        ]);

        // Crear una nueva reseña
        Resena::create([
            'usuario_id' => Auth::id(),
            'destino_id' => $destino->id,
            'calificacion' => $request->input('calificacion'),
            'comentarios' => $request->input('comentarios'),
            'fecha' => now(),
        ]);

        return redirect()->route('destinos.show', $destino->id)
                        ->with('success', 'Tu reseña ha sido registrada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Resena $resena)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resena $resena)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resena $resena)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resena $resena)
    {
        //
    }
}
