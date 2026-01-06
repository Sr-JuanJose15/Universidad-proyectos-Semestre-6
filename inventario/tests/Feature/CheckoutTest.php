<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CheckoutTest extends TestCase
{
    public function test_a_user_can_checkout_successfully()
    {
        // Crea un producto con suficiente stock
        $product = Product::factory()->create(['quantity_in_stock' => 5]);
    
        // Simula una solicitud de checkout con la estructura correcta
        $response = $this->post('/checkout', [
            'products' => [
                ['productId' => $product->id, 'quantity' => 2], // Intentamos comprar 2 unidades
            ],
        ]);
    
        // Asegúrate de que la respuesta sea correcta
        $response->assertRedirect('/checkout'); // O la ruta que desees redirigir
        $this->assertEquals('Checkout realizado con éxito.', session('success'));
    
        // Verifica que el stock se haya actualizado
        $product->refresh(); // Refresca el modelo para obtener los valores actualizados
        $this->assertEquals(3, $product->quantity_in_stock); // Debería quedar 3
    }
    
    public function test_cannot_checkout_if_not_enough_stock()
    {
        // Crea un producto con 1 unidad en stock
        $product = Product::factory()->create(['quantity_in_stock' => 1]);
    
        // Simula una solicitud de checkout con la estructura correcta
        $response = $this->post('/checkout', [
            'products' => [
                ['productId' => $product->id, 'quantity' => 2], // Intentamos llevar 2, pero solo hay 1
            ],
        ]);
    
        // Asegúrate de que haya errores en la sesión
        $response->assertSessionHasErrors('products'); // Asegúrate de que el campo 'products' tenga error
    
        // Verifica que el stock no se haya actualizado
        $product->refresh();
        $this->assertEquals(1, $product->quantity_in_stock); // Debería seguir siendo 1
    }
    
}
