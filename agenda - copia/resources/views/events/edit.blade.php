@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Editar Evento</h1>
    <form action="{{ route('events.update', $event) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" class="form-control" name="title" value="{{ $event->title }}" required>
        </div>

        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea class="form-control" name="description" required>{{ $event->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="location">Ubicación</label>
            <input type="text" class="form-control" name="location" value="{{ $event->location }}" required>
        </div>

        <div class="form-group">
            <label for="event_date">Fecha</label>
            <input type="date" class="form-control" name="event_date" value="{{ $event->event_date }}" required>
        </div>

        <div class="form-group">
            <label for="event_time">Hora</label>
            <input type="time" class="form-control" name="event_time" value="{{ $event->event_time }}" required>
        </div>

        <button type="submit" class="btn btn-warning">Actualizar Evento</button>
    </form>
@endsection
