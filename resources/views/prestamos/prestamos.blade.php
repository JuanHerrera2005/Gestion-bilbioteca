@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-purple-500 mb-6">📋 Lista de Préstamos</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-gray-900 rounded-lg shadow-md">
        <table class="min-w-full divide-y divide-gray-700 text-white">
            <thead class="bg-gray-800">
                <tr>
                    <th class="px-4 py-3 text-left">ID</th>
                    <th class="px-4 py-3 text-left">Usuario</th>
                    <th class="px-4 py-3 text-left">Libro</th>
                    <th class="px-4 py-3 text-left">Fecha Préstamo</th>
                    <th class="px-4 py-3 text-left">Fecha Devolución</th>
                    <th class="px-4 py-3 text-left">Estado</th>
                    <th class="px-4 py-3 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @forelse($prestamos as $prestamo)
                <tr class="hover:bg-gray-700">
                    <td class="px-4 py-3">{{ $prestamo->prestamo_id }}</td>
                    <td class="px-4 py-3">{{ $prestamo->usuario->nombre }} {{ $prestamo->usuario->apellido_paterno }}</td>
                    <td class="px-4 py-3">{{ $prestamo->ejemplar->libro->titulo }}</td>
                    <td class="px-4 py-3">{{ $prestamo->fecha_prestamo }}</td>
                    <td class="px-4 py-3">{{ $prestamo->fecha_devolucion ?? 'Pendiente' }}</td>
                    <td class="px-4 py-3">{{ $prestamo->estado }}</td>
                    <td class="px-4 py-3 text-center">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('prestamos.show', $prestamo->prestamo_id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">Ver</a>
                            <a href="{{ route('prestamos.edit', $prestamo->prestamo_id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded text-sm">Editar</a>
                            <form action="{{ route('prestamos.destroy', $prestamo->prestamo_id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de marcar este préstamo como eliminado?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-6 text-center text-gray-400">No hay préstamos registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
