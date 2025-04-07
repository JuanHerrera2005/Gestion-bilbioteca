@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-purple-500 mb-6">
        Detalle del Préstamo #{{ $prestamo->prestamo_id }}
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-gray-800 p-6 rounded-lg shadow-lg text-white">
        <!-- Imagen del libro -->
        <div class="flex justify-center items-center">
            @if($prestamo->ejemplar->libro->imagen)
                <img 
                    src="{{ $prestamo->ejemplar->libro->imagen }}" 
                    alt="Portada de {{ $prestamo->ejemplar->libro->titulo }}"
                    class="w-full h-auto max-w-xs object-cover rounded"
                    onerror="this.onerror=null;this.src='https://via.placeholder.com/300x450/1f2937/9ca3af?text=Sin+imagen';"
                >
            @else
                <div class="w-full max-w-xs h-64 bg-gray-700 flex items-center justify-center rounded">
                    <i class="fas fa-book-open text-6xl text-gray-400"></i>
                </div>
            @endif
        </div>

        <!-- Información del préstamo -->
        <div>
            <h2 class="text-2xl font-semibold mb-4">{{ $prestamo->ejemplar->libro->titulo }}</h2>

            <p class="mb-2"><span class="font-medium">Código Ejemplar:</span> {{ $prestamo->ejemplar->codigo_inventario }}</p>
            <p class="mb-2"><span class="font-medium">Usuario:</span> {{ $prestamo->usuario->nombre }} {{ $prestamo->usuario->apellido_paterno }}</p>
            <p class="mb-2"><span class="font-medium">Fecha Préstamo:</span> {{ \Carbon\Carbon::parse($prestamo->fecha_prestamo)->format('d/m/Y') }}</p>
            <p class="mb-2"><span class="font-medium">Fecha Devolución:</span> {{ $prestamo->fecha_devolucion ? \Carbon\Carbon::parse($prestamo->fecha_devolucion)->format('d/m/Y') : 'Pendiente' }}</p>
            <p class="mb-2"><span class="font-medium">Estado:</span> {{ ucfirst($prestamo->estado) }}</p>
            <p class="mb-2"><span class="font-medium">Método de Entrega:</span> {{ $prestamo->metodo_entrega }}</p>
            <p class="mb-2"><span class="font-medium">Multa Aplicada:</span> S/{{ number_format($prestamo->multa_aplicada, 2) }}</p>
            <p class="mb-4"><span class="font-medium">Observaciones:</span> {{ $prestamo->observaciones ?? 'Ninguna' }}</p>

            <div class="flex space-x-4">
                <a href="{{ route('prestamos.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded">
                    Volver
                </a>
                <a href="{{ route('prestamos.edit', $prestamo->prestamo_id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                    Editar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
