<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\PaqueteTuristico;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener las reservas del usuario actual con paginación
        $reservas = Reserva::where('usuario_id', Auth::id())->paginate(10); // Cambia 10 por la cantidad que desees

        // Retornar la vista de reservas con los datos paginados
        return view('reservas.index', compact('reservas'));
    }



    /**
     * Muestra el formulario para crear una nueva reserva.
     */
    public function create(Request $request)
    {
        // Obtener el ID del paquete desde el parámetro de consulta 'paquete_id'
        $paqueteId = $request->query('paquete_id');

        // Buscar el paquete turístico por su ID
        $paquete = PaqueteTuristico::findOrFail($paqueteId);

        // Pasar el paquete turístico a la vista de reservas
        return view('reservas.create', compact('paquete'));
    }


    /**
     * Almacena una nueva reserva en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario con mensajes personalizados en español
        $request->validate([
            'paquete_id' => 'required|exists:paquetes_turisticos,id',
            'num_personas' => 'required|integer|min:1',
            'fecha_reserva' => 'required|date|after:today',
        ], [
            'paquete_id.required' => 'El campo paquete es obligatorio.',
            'paquete_id.exists' => 'El paquete seleccionado no es válido.',
            'num_personas.required' => 'Debe ingresar la cantidad de personas.',
            'num_personas.integer' => 'La cantidad de personas debe ser un número entero.',
            'num_personas.min' => 'La cantidad mínima de personas es 1.',
            'fecha_reserva.required' => 'Debe seleccionar una fecha de reserva.',
            'fecha_reserva.date' => 'La fecha de reserva debe ser una fecha válida.',
            'fecha_reserva.after' => 'La fecha de reserva debe ser posterior a hoy.',
        ]);

        // Crear la reserva
        Reserva::create([
            'usuario_id' => Auth::id(),
            'paquete_id' => $request->input('paquete_id'),
            'num_personas' => $request->input('num_personas'),
            'fecha_reserva' => $request->input('fecha_reserva'),
            'precio_total' => $request->input('num_personas') * PaqueteTuristico::find($request->input('paquete_id'))->precio_individual,
            'estado' => 'pendiente de pago',
        ]);

        // Redirigir a la vista de reservas con un mensaje de éxito
        return redirect()->route('reservas.index')->with('success', 'Reserva realizada con éxito.');
    }




    /**
     * Display the specified resource.
     */
    public function show(Reserva $reserva)
    {
        // Verificar que la reserva pertenezca al usuario autenticado
        if ($reserva->usuario_id !== Auth::id()) {
            return redirect()->route('reservas.index')->with('error', 'No tienes permiso para ver esta reserva.');
        }

        return view('reservas.show', compact('reserva'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reserva $reserva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reserva $reserva)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reserva $reserva)
    {
        //
    }
}
