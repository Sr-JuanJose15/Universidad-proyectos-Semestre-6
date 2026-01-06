<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockMovement;
use App\Models\Product;


class StockMovementController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function checkout(Request $request)
     {
         // Validar los datos de entrada
         $validated = $request->validate([
             'products' => 'required|array',
             'products.*.productId' => 'required|exists:products,id',
             'products.*.quantity' => 'required|integer|min:1',
         ]);
     
         // Procesar la compra
         foreach ($validated['products'] as $productData) {
             $product = Product::find($productData['productId']);
             
             if ($product->quantity_in_stock < $productData['quantity']) {
                 return redirect()->back()->withErrors(['products' => 'No hay suficiente stock para el producto.']);
             }
             
             // Actualizar el stock
             $product->quantity_in_stock -= $productData['quantity'];
             $product->save();
     
             // Registrar el movimiento de stock
             StockMovement::create([
                 'product_id' => $product->id,
                 'quantity' => -$productData['quantity'],
                 // Otras columnas según tu esquema
             ]);
         }
     
         return redirect('/checkout')->with('success', 'Checkout realizado con éxito.');
     }
     
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
