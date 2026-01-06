@extends('layouts.app')

@section('content')
    <!-- Título en un marco completo -->
    <div class="text-center mb-4" style="background: rgba(255, 255, 255, 0.85); padding: 20px; box-shadow: 0 6px 25px rgba(0, 0, 0, 0.3); border: 2px solid #dc3545;">
        <h1 class="text-danger">{{ isset($product) ? 'Editar Producto' : 'Agregar Producto' }}</h1>
    </div>

    <!-- Recuadro para el formulario con mayor transparencia y textura -->
    <div class="border border-danger rounded p-4" style="background: rgba(255, 255, 255, 0.7); box-shadow: 0 6px 25px rgba(0, 0, 0, 0.3); background-image: url('ruta/a/tu/textura.png'); background-size: cover;">
        <form action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" method="POST">
            @csrf
            @if(isset($product))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="sku">SKU</label>
                <input type="text" name="sku" class="form-control" id="sku" value="{{ old('sku', $product->sku ?? '') }}" required>
                @error('sku')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Descripción</label>
                <input type="text" name="description" class="form-control" id="description" value="{{ old('description', $product->description ?? '') }}" required>
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="category">Categoría</label>
                <input type="text" name="category" class="form-control" id="category" value="{{ old('category', $product->category ?? '') }}" required>
                @error('category')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="supplier">Proveedor</label>
                <input type="text" name="supplier" class="form-control" id="supplier" value="{{ old('supplier', $product->supplier ?? '') }}" required>
                @error('supplier')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="purchase_price">Precio de Compra</label>
                <input type="number" name="purchase_price" class="form-control" id="purchase_price" value="{{ old('purchase_price', $product->purchase_price ?? '') }}" required>
                @error('purchase_price')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="sale_price">Precio de Venta</label>
                <input type="number" name="sale_price" class="form-control" id="sale_price" value="{{ old('sale_price', $product->sale_price ?? '') }}" required>
                @error('sale_price')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="quantity_in_stock">Cantidad en Stock</label>
                <input type="number" name="quantity_in_stock" class="form-control" id="quantity_in_stock" value="{{ old('quantity_in_stock', $product->quantity_in_stock ?? '') }}" required>
                @error('quantity_in_stock')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="min_quantity">Cantidad Mínima</label>
                <input type="number" name="min_quantity" class="form-control" id="min_quantity" value="{{ old('min_quantity', $product->min_quantity ?? '') }}" required>
                @error('min_quantity')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="max_quantity">Cantidad Máxima</label>
                <input type="number" name="max_quantity" class="form-control" id="max_quantity" value="{{ old('max_quantity', $product->max_quantity ?? '') }}" required>
                @error('max_quantity')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Volver</a>
        </form>
    </div>
@endsection
