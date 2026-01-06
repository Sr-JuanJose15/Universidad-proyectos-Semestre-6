@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Crear Evento</h1>
        <form action="{{ route('events.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Introduce el título del evento" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Añade una descripción" required></textarea>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Ubicación</label>
                <input type="text" class="form-control" id="location" name="location" placeholder="Introduce la ubicación" required>
            </div>

            <div class="mb-3">
                <label for="event_date" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="event_date" name="event_date" required>
            </div>

            <div class="mb-3">
                <label for="event_time" class="form-label">Hora</label>
                <input type="time" class="form-control" id="event_time" name="event_time" required>
            </div>

            <button type="submit" class="btn btn-primary">Crear Evento</button>
        </form>
    </div>
@endsection
