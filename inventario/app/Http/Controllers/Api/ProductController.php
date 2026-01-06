<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Obtiene todos los productos
        return response()->json($products); // Retorna los productos en formato JSON
    }

    public function store(Request $request)
    {
        // Ver los datos que se están recibiendo
        dd($request->all());
    
        // Validación de datos
        $validatedData = $request->validate([
            'sku' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'supplier' => 'required|string',
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'acquisition_date' => 'required|date',
            'quantity_in_stock' => 'required|integer',
            'min_quantity' => 'required|integer',
            'max_quantity' => 'required|integer',
        ]);
    
        Product::create($validatedData);
        return response()->json(['message' => 'Product created successfully']);
    }
    
    

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], Response::HTTP_NOT_FOUND);
        }

        $validatedData = $request->validate([
            'sku' => 'sometimes|required|string|unique:products,sku,' . $product->id,
            'description' => 'sometimes|required|string',
            'category' => 'sometimes|required|string',
            'supplier_id' => 'sometimes|required|exists:suppliers,id',
            'purchase_price' => 'sometimes|required|numeric',
            'sale_price' => 'sometimes|required|numeric',
            'acquisition_date' => 'sometimes|required|date',
            'quantity_in_stock' => 'sometimes|required|integer',
            'min_quantity' => 'sometimes|required|integer',
            'max_quantity' => 'sometimes|required|integer',
        ]);

        $product->update($validatedData);

        return response()->json($product, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], Response::HTTP_NOT_FOUND);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], Response::HTTP_OK);
    }

}
