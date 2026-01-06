@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Productos Disponibles</h1>
    <table class="table">
        <thead>
            <tr>
                <th>SKU</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Cantidad Disponible</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->sku }}</td>
                <td>{{ $product->description }}</td>
                <td>${{ $product->sale_price }}</td>
                <td>{{ $product->quantity_in_stock }}</td>
                <td>
                    <form action="{{ route('stock.movements.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="number" name="quantity" min="1" max="{{ $product->quantity_in_stock }}" required>
                        <input type="date" name="date" required>
                        <select name="movement_type">
                            <option value="exit">Salida</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
