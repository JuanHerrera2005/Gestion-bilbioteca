@extends('layouts.app') <!-- Extiende el layout correctamente -->

@section('content')
    <!-- Sección de inicio -->
    <section id="inicio" class="text-center mb-12 fade-in">
        <h2 class="text-4xl font-bold text-purple-400">Bienvenido a la Biblioteca</h2>
        <p class="text-gray-400 mt-3">Administra libros, usuarios y préstamos con facilidad.</p>
    </section>

    <!-- Módulo: Búsqueda Avanzada -->
    <section id="busqueda" class="card bg-gray-800 p-8 rounded-xl shadow-lg slide-in-left mb-12">
        <h2 class="text-2xl font-bold text-purple-400 mb-4">🔍 Búsqueda Avanzada</h2>
        <form class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <input type="text" class="p-3 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Autor">
            <input type="text" class="p-3 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Título">
            <select class="p-3 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                <option value="">Selecciona un género...</option>
                <option value="Aventuras">Aventuras</option>
                <option value="Ciencia Ficción">Ciencia Ficción</option>
                <option value="Terror y Misterio">Terror y Misterio</option>
                <option value="Romántica">Romántica</option>
                <option value="Poesía">Poesía</option>
            </select>
            <button type="submit" class="col-span-1 md:col-span-3 bg-purple-600 hover:bg-purple-700 transition duration-300 text-white font-bold py-3 rounded-lg btn-animated">
                Buscar
            </button>
        </form>
    </section>

    <!-- Módulo: Gestión de Libros -->
    <section id="libros" class="card bg-gray-800 p-8 rounded-xl shadow-lg slide-in-right mb-12">
        <h2 class="text-2xl font-bold text-purple-400 mb-4">📖 Gestión de Libros</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ url('/Registrarlibro') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg btn-animated text-center">Registrar Libro</a>
            <a href="{{ url('/ConsultarLibro') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg btn-animated text-center">Consultar Libros</a>
            <button class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 rounded-lg btn-animated">Actualizar Libro</button>
        </div>
    </section>

    <!-- Módulo: Gestión de Usuarios -->
    <section id="usuarios" class="card bg-gray-800 p-8 rounded-xl shadow-lg slide-in-left mb-12">
        <h2 class="text-2xl font-bold text-purple-400 mb-4">👤 Gestión de Usuarios</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg btn-animated">Registrar Usuario</button>
            <button class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg btn-animated">Consultar Usuarios</button>
            <button class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 rounded-lg btn-animated">Ver Historial</button>
        </div>
    </section>

    <!-- Módulo: Préstamos y Devoluciones -->
    <section id="prestamos" class="card bg-gray-800 p-8 rounded-xl shadow-lg slide-in-right">
        <h2 class="text-2xl font-bold text-purple-400 mb-4">📚 Préstamos y donaciones de libros</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <a href="{{ url('/registrarPrestamo') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg btn-animated text-center">Registrar Préstamo</a>
            <a href="{{ url('/registrarDonacion') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg btn-animated text-center">Registrar Donaciones de libros</a>
        </div>
    </section>
@endsection