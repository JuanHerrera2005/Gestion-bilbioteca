@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-purple-500 mb-6">✏️ Editar Préstamo #{{ $prestamo->prestamo_id }}</h1>

    @if ($errors->any())
        <div class="bg-red-200 text-red-800 p-4 rounded mb-6">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('prestamos.update', $prestamo->prestamo_id) }}" method="POST" class="bg-gray-800 p-6 rounded-lg shadow-lg text-white">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Usuario -->
            <div>
                <label for="usuario_id" class="block text-sm font-medium mb-1">Usuario</label>
                <select name="usuario_id" id="usuario_id" class="w-full p-2 rounded bg-gray-700 text-white">
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->usuario_id }}"
                            {{ $prestamo->usuario_id == $usuario->usuario_id ? 'selected' : '' }}>
                            {{ $usuario->nombre }} {{ $usuario->apellido_paterno }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Ejemplar -->
            <div>
                <label for="ejemplar_id" class="block text-sm font-medium mb-1">Ejemplar</label>
                <select name="ejemplar_id" id="ejemplar_id" class="w-full p-2 rounded bg-gray-700 text-white">
                    @foreach($ejemplares as $ejemplar)
                        <option value="{{ $ejemplar->ejemplar_id }}"
                            {{ $prestamo->ejemplar_id == $ejemplar->ejemplar_id ? 'selected' : '' }}>
                            {{ $ejemplar->libro->titulo }} ({{ $ejemplar->codigo_inventario }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Fecha Préstamo -->
            <div>
                <label for="fecha_prestamo" class="block text-sm font-medium mb-1">Fecha de Préstamo</label>
                <input type="date" name="fecha_prestamo" id="fecha_prestamo"
                    value="{{ old('fecha_prestamo', $prestamo->fecha_prestamo) }}"
                    class="w-full p-2 rounded bg-gray-700 text-white">
            </div>

            <!-- Fecha Devolución -->
            <div>
                <label for="fecha_devolucion" class="block text-sm font-medium mb-1">Fecha de Devolución</label>
                <input type="date" name="fecha_devolucion" id="fecha_devolucion"
                    value="{{ old('fecha_devolucion', $prestamo->fecha_devolucion) }}"
                    class="w-full p-2 rounded bg-gray-700 text-white">
            </div>

            <!-- Estado -->
            <div class="mb-4">
                <label for="estado" class="block text-sm font-medium mb-1 text-white">Estado</label>
                <select name="estado" id="estado" class="w-full p-2 rounded bg-gray-700 text-white">
                    <option value="Activo" {{ $prestamo->estado === 'Activo' ? 'selected' : '' }}>Pendiente</option>
                    <option value="Devuelto" {{ $prestamo->estado === 'Devuelto' ? 'selected' : '' }}>Devuelto</option>
                    <option value="Retrasado" {{ $prestamo->estado === 'Retrasado' ? 'selected' : '' }}>Retrasado</option>
                </select>
            </div>

            <!-- Método de Entrega -->
            <div>
                <label for="metodo_entrega" class="block text-sm font-medium mb-1">Método de Entrega</label>
                <select name="metodo_entrega" id="metodo_entrega" class="w-full p-2 rounded bg-gray-700 text-white">
                    <option value="Presencial" {{ $prestamo->metodo_entrega == 'Presencial' ? 'selected' : '' }}>Presencial</option>
                    <option value="Domicilio" {{ $prestamo->metodo_entrega == 'Domicilio' ? 'selected' : '' }}>Envío a domicilio</option>
                </select>
            </div>

            <!-- Multa Aplicada -->
            <div>
                <label for="multa_aplicada" class="block text-sm font-medium mb-1">Multa Aplicada (S/.)</label>
                <input type="number" name="multa_aplicada" id="multa_aplicada" step="0.01" min="0"
                    value="{{ old('multa_aplicada', $prestamo->multa_aplicada) }}"
                    class="w-full p-2 rounded bg-gray-700 text-white">
            </div>

            <!-- Observaciones -->
            <div class="md:col-span-2">
                <label for="observaciones" class="block text-sm font-medium mb-1">Observaciones</label>
                <textarea name="observaciones" id="observaciones" rows="4"
                    class="w-full p-2 rounded bg-gray-700 text-white">{{ old('observaciones', $prestamo->observaciones) }}</textarea>
            </div>
        </div>

        <!-- Botones -->
        <div class="mt-6 flex space-x-4">
            <a href="{{ route('prestamos.index') }}" class="bg-gray-600 hover:bg-gray-500 text-white px-4 py-2 rounded">
                Cancelar
            </a>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                Guardar Cambios
            </button>
        </div>
    </form>
</div>
@endsection
