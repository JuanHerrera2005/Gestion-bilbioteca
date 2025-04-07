@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h1 class="text-4xl font-semibold text-purple-600 mb-8 text-center">📚 Crear Préstamo</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('prestamos.store') }}" method="POST" class="bg-gray-800 p-6 rounded-lg shadow-lg">
        @csrf
        <div class="space-y-6">
            <!-- Seleccionar Usuario -->
            <div class="flex flex-col mb-4">
                <label for="usuario_id" class="text-sm font-medium text-white mb-2">Selecciona un Usuario</label>
                <select name="usuario_id" id="usuario_id" class="w-full p-3 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    <option value="">Seleccione un usuario</option>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}">{{ $usuario->nombre }} {{ $usuario->apellido_paterno }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Fecha de Préstamo -->
            <div class="flex flex-col mb-4">
                <label for="fecha_prestamo" class="text-sm font-medium text-white mb-2">Fecha de Préstamo</label>
                <input type="date" name="fecha_prestamo" id="fecha_prestamo" class="w-full p-3 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-purple-500" required>
            </div>

            <!-- Fecha de Devolución -->
            <div class="flex flex-col mb-4">
                <label for="fecha_devolucion" class="text-sm font-medium text-white mb-2">Fecha de Devolución</label>
                <input type="date" name="fecha_devolucion" id="fecha_devolucion" class="w-full p-3 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-purple-500" required>
            </div>

            <!-- Observaciones -->
            <div class="flex flex-col mb-4">
                <label for="observaciones" class="text-sm font-medium text-white mb-2">Observaciones</label>
                <textarea name="observaciones" id="observaciones" class="w-full p-3 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-purple-500" rows="4"></textarea>
            </div>

            <!-- Método de Entrega -->
            <div class="flex flex-col mb-4">
                <label for="metodo_entrega" class="text-sm font-medium text-white mb-2">Método de Entrega</label>
                <select name="metodo_entrega" id="metodo_entrega" class="w-full p-3 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    <option value="">Seleccione un método de entrega</option>
                    <option value="recogida">Recogida en tienda</option>
                    <option value="envio">Envío a domicilio</option>
                </select>
            </div>

            <!-- Tabla de Libros y Ejemplares -->
            <div class="overflow-x-auto bg-gray-800 rounded-lg shadow-md">
                <table class="min-w-full divide-y divide-gray-700 text-white">
                    <thead class="bg-gray-900">
                        <tr>
                            <th class="px-4 py-3 text-left">ID</th>
                            <th class="px-4 py-3 text-left">Libro</th>
                            <th class="px-4 py-3 text-left">Ejemplares Disponibles</th>
                            <th class="px-4 py-3 text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @foreach($libros as $libro)
                            <tr class="hover:bg-gray-700">
                                <td class="px-4 py-3">{{ $libro->libro_id }}</td>
                                <td class="px-4 py-3">{{ $libro->titulo }}</td>
                                <td class="px-4 py-3">
                                    @if($libro->ejemplares->isEmpty())
                                        <span class="text-red-500">Sin ejemplares disponibles</span>
                                    @else
                                        <span class="text-green-500">Con ejemplares disponibles</span>
                                        <select name="ejemplar_id" class="w-full p-2 mt-2 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                                            <option value="">Seleccione un ejemplar</option>
                                            @foreach($libro->ejemplares as $ejemplar)
                                                <option value="{{ $ejemplar->id }}">{{ $ejemplar->codigo_inventario }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center">
                                    @if($libro->ejemplares->isEmpty())
                                        <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded" disabled>Sin ejemplares</button>
                                    @else
                                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                                            Registrar Préstamo
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</div>
@endsection
