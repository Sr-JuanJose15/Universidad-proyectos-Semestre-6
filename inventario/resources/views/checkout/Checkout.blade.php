@extends('layouts.app')

@section('content')
<div class="checkout-container">
    <h2>Productos Disponibles</h2>
    <form id="cartForm" method="POST" action="{{ route('checkout.process') }}">
        @csrf
        <table class="checkout-table">
            <thead>
                <tr>
                    <th>SKU</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->sku }}</td>
                    <td>{{ $product->description }}</td>
                    <td>${{ $product->sale_price }}</td>
                    <td>
                        <input type="number" name="quantity_{{ $product->id }}" min="1" value="1" class="quantity-input">
                    </td>
                    <td>
                        <button type="button" onclick="addToCart({{ $product->id }}, {{ $product->quantity_in_stock }}, {{ $product->sale_price }})" class="btn-add">Agregar a la Canasta</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </form>

    <div id="cart" class="cart">
        <h2>Canasta</h2>
        <ul id="cartItems" class="cart-items"></ul>
        <h3>Total: $<span id="totalAmount">0</span></h3>
        <button type="button" onclick="checkout()" class="btn-checkout">Finalizar compra</button>
    </div>
</div>
<a href="{{ route('home') }}" class="btn btn-secondary mt-3">Volver a Inicio</a>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    <script>
        setTimeout(function() {
            location.reload();
        }, 3000); // Recarga la página después de 3 segundos
    </script>
@endif

<script>
    let cart = [];
    let totalAmount = 0;

    function addToCart(productId, stockQuantity, price) {
        const quantity = parseInt(document.querySelector(`input[name="quantity_${productId}"]`).value);

        // Verifica que la cantidad solicitada no supere el stock disponible
        if (quantity > stockQuantity) {
            alert(`No hay suficiente stock disponible para el producto ID: ${productId}`);
            return;
        }

        const existingProduct = cart.find(product => product.productId === productId);

        if (existingProduct) {
            existingProduct.quantity += quantity;
        } else {
            cart.push({ productId: productId, quantity: quantity });
        }

        // Actualiza el total
        totalAmount += price * quantity;
        document.getElementById('totalAmount').innerText = totalAmount.toFixed(2);

        renderCart();
    }

    function renderCart() {
        const cartItems = document.getElementById('cartItems');
        cartItems.innerHTML = ''; 

        cart.forEach(item => {
            const li = document.createElement('li');
            li.textContent = `Producto ID: ${item.productId}, Cantidad: ${item.quantity}`;
            cartItems.appendChild(li);
        });
    }

    function checkout() {
    fetch('/checkout', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ products: cart }),
    })
    .then(response => response.json())
    .then(data => {
        alert('Compra realizada exitosamente');

        // Opciones para redirigir o recargar
        window.location.href = '{{ route('home') }}'; // Cambia 'home' por la ruta deseada
        // o para recargar la misma página
        // location.reload();
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}

</script>

<style>
    .checkout-container {
        max-width: 800px;
        margin: auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
    }

    .checkout-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .checkout-table th, .checkout-table td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: center;
    }

    .quantity-input {
        width: 60px;
        padding: 5px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .btn-add, .btn-checkout {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-add:hover, .btn-checkout:hover {
        background-color: #0056b3;
    }

    .cart {
        margin-top: 20px;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
    }

    .cart-items {
        list-style-type: none;
        padding: 0;
    }

    .cart-items li {
        margin: 5px 0;
    }

    .alert {
        padding: 10px;
        margin: 15px 0;
        border: 1px solid #d4edda;
        background-color: #d4edda;
        color: #155724;
        border-radius: 4px;
    }
</style>

@endsection
