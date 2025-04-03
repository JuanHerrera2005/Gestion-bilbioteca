@extends('layouts.app')

@section('content')
    <!-- Sección de bienvenida -->
    <section id="inicio" class="text-center mb-12 fade-in">
        <h2 class="text-4xl font-bold text-purple-400">Bienvenido a la Biblioteca</h2>
        <p class="text-gray-400 mt-3">Administra libros, usuarios y préstamos con facilidad.</p>
    </section>

    <!-- Incluir partials -->
    @include('partials.busqueda')
    @include('partials.gestion-libros')
    @include('partials.gestion-usuarios')
   
@endsection