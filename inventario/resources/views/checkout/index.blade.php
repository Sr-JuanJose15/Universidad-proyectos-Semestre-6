@extends('layouts.app')

@section('content')
    <h1>Checkout</h1>

    <!-- Mostrar mensajes de éxito -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Mostrar mensajes de error -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="products">Seleccionar Productos:</label>
            <select name="products[]" id="products" class="form-control" multiple required>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->description }} (Stock: {{ $product->quantity_in_stock }})</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="quantities">Cantidades:</label>
            <input type="text" name="quantities" id="quantities" class="form-control" placeholder="Ej: 2,3" required>
        </div>
        <button type="submit" class="btn btn-primary">Realizar Compra</button>
    </form>
@endsection
