<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Mostrar la lista de productos
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // Mostrar el formulario para crear un nuevo producto
    public function create()
    {
        return view('products.create');
    }

    // Almacenar un nuevo producto
public function store(Request $request)
{
    $validatedData = $request->validate([
        'sku' => 'required|unique:products,sku|max:255',
        'description' => 'required|max:255',
        'category' => 'required|max:255',
        'supplier' => 'required|max:255',
        'purchase_price' => 'required|numeric',
        'sale_price' => 'required|numeric',
        'quantity_in_stock' => 'required|integer',
        'min_quantity' => 'required|integer',
        'max_quantity' => 'required|integer',
    ]);

    // Establecer la fecha de adquisición en la fecha actual
    $validatedData['acquisition_date'] = now();

    Product::create($validatedData);

    return redirect()->route('products.index')->with('success', 'Producto creado exitosamente.');
}


    // Mostrar el formulario para editar un producto
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    // Actualizar un producto
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validatedData = $request->validate([
            'sku' => 'required|unique:products,sku,'.$product->id,
            'description' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'quantity_in_stock' => 'required|integer|min:0',
        ]);

        $product->update($validatedData);

        return redirect()->route('products.index')->with('success', 'Producto actualizado exitosamente.');
    }

    // Eliminar un producto
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Producto eliminado exitosamente.');
    }
}
