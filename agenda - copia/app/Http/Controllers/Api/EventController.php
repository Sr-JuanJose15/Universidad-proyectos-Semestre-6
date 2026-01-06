<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Listar todos los eventos
    public function index()
    {
        $events = Event::all();
        return response()->json(['data' => $events], 200);
    }

    // Crear un nuevo evento
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'event_date' => 'required|date',
            'event_time' => 'required',
        ]);

        $event = Event::create($request->all());

        return response()->json(['message' => 'Evento creado con éxito', 'data' => $event], 201);
    }

    // Mostrar un evento por ID
    public function show(Event $event)
    {
        return response()->json(['data' => $event], 200);
    }

    // Actualizar un evento
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'event_date' => 'required|date',
            'event_time' => 'required',
        ]);

        $event->update($request->all());

        return response()->json(['message' => 'Evento actualizado con éxito', 'data' => $event], 200);
    }

    // Eliminar un evento
    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json(['message' => 'Evento eliminado con éxito'], 200);
    }
}
