@extends('layouts.app')

@section('content')
<div class="welcome-container">
    <h1>Bienvenido a la Aplicación de Gestión de Inventario</h1>
    <div class="button-container">
        <a href="{{ url('/products') }}" class="button">Productos</a>
        <a href="{{ url('/checkout') }}" class="button">Checkout</a>
    </div>
</div>

<style>


    body {
        display: flex; /* Usar flexbox para centrar */
        justify-content: center; /* Centrar horizontalmente */
        align-items: center; /* Centrar verticalmente */
        height: 100vh; /* Tomar toda la altura de la ventana */
        margin: 0; /* Quitar margen */
    }

    .welcome-container {
        text-align: center;
        margin: 0 20px; /* Márgenes laterales */
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.8); /* Fondo blanco semitransparente */
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
    }

    h1 {
        background-color: #ffffff; /* Fondo blanco para el título */
        color: #dc3545; /* Color rojo para el texto */
        padding: 10px;
        border-radius: 10px;
        margin-bottom: 30px;
        display: inline-block; /* Asegura que el marco rodee solo el texto */
        border: 2px solid #dc3545; /* Marco rojo para el título */
    }

    .button-container {
        display: flex;
        justify-content: center;
        gap: 30px;
    }

    .button {
        background-color: #dc3545; /* Rojo oscuro */
        color: white;
        padding: 20px 40px; /* Botones más grandes */
        border: none;
        border-radius: 5px;
        text-decoration: none;
        font-size: 20px; /* Fuente más grande */
        transition: background-color 0.3s;
    }

    .button:hover {
        background-color: #a52424; /* Rojo medio en hover */
    }
</style>

@endsection
