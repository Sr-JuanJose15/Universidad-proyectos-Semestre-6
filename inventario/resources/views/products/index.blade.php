@extends('layouts.app')

@section('content')
    <!-- Título en un marco completo -->
    <div class="text-center mb-4" style="background: rgba(255, 255, 255, 0.85); padding: 20px; box-shadow: 0 6px 25px rgba(0, 0, 0, 0.3); border: 2px solid #dc3545;">
        <h1 class="text-danger">Lista de Productos</h1>
    </div>

    <!-- Recuadro para la tabla de productos con mayor transparencia y textura -->
    <div class="border border-danger rounded p-4" style="background: rgba(255, 255, 255, 0.7); box-shadow: 0 6px 25px rgba(0, 0, 0, 0.3); background-image: url('ruta/a/tu/textura.png'); background-size: cover;">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>SKU</th>
                    <th>Descripción</th>
                    <th>Categoría</th>
                    <th>Proveedor</th>
                    <th>Precio de Compra</th>
                    <th>Precio de Venta</th>
                    <th>Cantidad en Stock</th>
                    <th>Fecha de Adquisición</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->sku }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->category }}</td>
                        <td>{{ $product->supplier }}</td>
                        <td>${{ number_format($product->purchase_price, 2) }}</td>
                        <td>${{ number_format($product->sale_price, 2) }}</td>
                        <td>{{ $product->quantity_in_stock }}</td>
                        <td>{{ \Carbon\Carbon::parse($product->acquisition_date)->format('d-m-Y') }}</td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
            <a href="{{ route('products.create') }}" class="btn btn-light">Agregar Nuevo Producto</a>
    </div>
    <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Volver a Inicio</a>

@endsection
