<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Product;
class StockMovementController extends Controller
{
    public function index()
    {
        return StockMovement::all();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer',
            'movement_type' => 'required|string|in:entry,exit',
            'date' => 'required|date',
        ]);
    
        $stockMovement = StockMovement::create($validatedData);
    
        // Actualizar la cantidad en stock del producto
        $product = Product::find($validatedData['product_id']);
        if ($validatedData['movement_type'] === 'exit') {
            $product->decrement('quantity_in_stock', $validatedData['quantity']);
        } else {
            $product->increment('quantity_in_stock', $validatedData['quantity']);
        }
    
        return response()->json($stockMovement, Response::HTTP_CREATED);
    }
    
    

    public function show($id)
    {
        $stockMovement = StockMovement::find($id);

        if (!$stockMovement) {
            return response()->json(['message' => 'Stock movement not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($stockMovement, Response::HTTP_OK);
    }

    public function update(Request $request, string $id)
    {
        $stockMovement = StockMovement::find($id);
    
        // Retornar un error si no se encuentra
        if (!$stockMovement) {
            return response()->json(['message' => 'Stock movement not found'], Response::HTTP_NOT_FOUND);
        }
    
        // Guardar la cantidad anterior y el tipo de movimiento
        $previousQuantity = $stockMovement->quantity;
        $previousMovementType = $stockMovement->movement_type;
    
        // Validar los datos entrantes
        $validatedData = $request->validate([
            'product_id' => 'sometimes|required|exists:products,id',
            'quantity' => 'sometimes|required|integer|min:1',
            'movement_type' => 'sometimes|required|string|in:entry,exit',
        ]);
    
        // Actualizar el movimiento de stock
        $stockMovement->update($validatedData);
    
        // Obtener el producto asociado
        $product = Product::find($validatedData['product_id'] ?? $stockMovement->product_id);
    
        // Restaurar la cantidad anterior al stock
        if ($previousMovementType === 'entry') {
            $product->quantity_in_stock -= $previousQuantity;
        } elseif ($previousMovementType === 'exit') {
            $product->quantity_in_stock += $previousQuantity;
        }
    
        // Aplicar el nuevo movimiento
        if ($validatedData['movement_type'] === 'entry') {
            $product->quantity_in_stock += $validatedData['quantity'];
        } elseif ($validatedData['movement_type'] === 'exit') {
            $product->quantity_in_stock -= $validatedData['quantity'];
        }
        
        $product->save(); // Guardar los cambios
    
        return response()->json($stockMovement, Response::HTTP_OK);
    }
    

    public function destroy($id)
    {
        $stockMovement = StockMovement::find($id);

        if (!$stockMovement) {
            return response()->json(['message' => 'Stock movement not found'], Response::HTTP_NOT_FOUND);
        }

        $stockMovement->delete();

        return response()->json(['message' => 'Stock movement deleted successfully'], Response::HTTP_OK);
    }
}
