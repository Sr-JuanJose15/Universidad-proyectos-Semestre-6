<?php
namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Listar eventos
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    // Mostrar formulario para crear evento
    public function create()
    {
        return view('events.create');
    }

    // Almacenar un nuevo evento
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'event_date' => 'required|date',
            'event_time' => 'required'
        ]);

        Event::create($request->all());
        return redirect()->route('events.index')->with('success', 'Evento creado con éxito.');
    }

    // Mostrar formulario para editar evento
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    // Actualizar evento
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'event_date' => 'required|date',
            'event_time' => 'required'
        ]);

        $event->update($request->all());
        return redirect()->route('events.index')->with('success', 'Evento actualizado con éxito.');
    }

    // Eliminar evento
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Evento eliminado con éxito.');
    }
}
