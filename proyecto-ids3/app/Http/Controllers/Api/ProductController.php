<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::all();
        return response()->json([
            'data' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos antes de intentar guardar
        $validated = $request->validate([
            'code' => 'required|unique:products,code',
            'name' => 'required',
            'unit' => 'required',
            'amount' => 'required'
        ]);

        try {
            // Crear y guardar el nuevo producto
            $product = new Products();
            $product->code = $validated['code'];
            $product->name = $validated['name'];
            $product->unit = $validated['unit'];
            $product->amount = $validated['amount'];
            $product->save();

            return response()->json([
                'message' => 'Producto creado con éxito',
                'data' => $product
            ], 201);

        } catch (QueryException $e) {
            // Capturar y manejar la excepción de violación de unicidad
            if ($e->errorInfo[1] == 1062) {
                return response()->json(['error' => 'El código de producto ya existe.'], 400);
            }
            // Lanza cualquier otra excepción
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $product)
    {
        return response()->json(['data' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $product = Products::findOrFail($id);
            $validated = $request->validate([
                'code' => 'required|unique:products,code,' . $id,
                'name' => 'required',
                'unit' => 'required',
                'amount' => 'required'
            ]);

            $product->code = $validated['code'];
            $product->name = $validated['name'];
            $product->unit = $validated['unit'];
            $product->amount = $validated['amount'];
            $product->save();

            return response()->json([
                'message' => 'Producto actualizado con éxito',
                'data' => $product
            ]);

        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return response()->json(['error' => 'El código de producto ya existe.'], 400);
            }
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Products::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Producto eliminado con éxito']);
    }
}
