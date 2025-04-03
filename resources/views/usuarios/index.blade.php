@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Listado de Usuarios</h1>
        <a href="{{ route('usuarios.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded flex items-center transition-colors duration-200">
            <i class="fas fa-plus-circle mr-2"></i> Nuevo Usuario
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden transition-shadow duration-300 hover:shadow-lg">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nombre Completo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Documento</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Teléfono</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($usuarios as $usuario)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center mr-3 transition-colors duration-200">
                                    <i class="fas fa-user text-purple-600 dark:text-purple-300"></i>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900 dark:text-white">
                                        {{ $usuario->nombre }} {{ $usuario->apellido_paterno }} {{ $usuario->apellido_materno }}
                                    </div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $usuario->ocupacion ?? 'Sin ocupación registrada' }}
                                        @if($usuario->prestamos_count > 0)
                                        <span class="ml-2 bg-blue-100 text-blue-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                            Préstamos: {{ $usuario->prestamos_count }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-gray-900 dark:text-white">{{ $usuario->tipo_documento }}</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $usuario->numero_documento }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-gray-900 dark:text-white">{{ $usuario->email }}</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                @if($usuario->fecha_nacimiento)
                                {{ \Carbon\Carbon::parse($usuario->fecha_nacimiento)->format('d/m/Y') }}
                                @else
                                Sin fecha
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                @if($usuario->telefono)
                                <a href="tel:{{ $usuario->telefono }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition-colors duration-200">
                                    <i class="fas fa-phone-alt mr-1"></i> {{ $usuario->telefono }}
                                </a>
                                @else
                                <span class="text-gray-400 dark:text-gray-500">No registrado</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex justify-center space-x-2">
                                <!-- Botón Ver -->
                                <a href="{{ route('usuarios.show', $usuario->usuario_id) }}"
                                    class="bg-purple-600 hover:bg-purple-700 text-white p-2 rounded-full w-10 h-10 flex items-center justify-center transition-colors duration-200 group"
                                    title="Ver detalles" data-tippy-content="Ver detalles">
                                    <i class="fas fa-eye group-hover:scale-110 transition-transform"></i>
                                </a>

                                <!-- Botón Editar -->
                                <a href="{{ route('usuarios.edit', $usuario->usuario_id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white p-2 rounded-full w-10 h-10 flex items-center justify-center transition-colors duration-200 group"
                                    title="Editar" data-tippy-content="Editar">
                                    <i class="fas fa-edit group-hover:scale-110 transition-transform"></i>
                                </a>



                                <!-- Botón Eliminar -->
                                <form action="{{ route('usuarios.destroy', $usuario->usuario_id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white p-2 rounded-full w-10 h-10 flex items-center justify-center transition-colors duration-200 group"
                                        title="Desactivar usuario"
                                        data-tippy-content="Desactivar"
                                        onclick="return confirm('¿Estás seguro de desactivar este usuario?')">
                                        <i class="fas fa-user-slash group-hover:scale-110 transition-transform"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            <div class="flex flex-col items-center justify-center py-8">
                                <i class="fas fa-user-slash text-4xl text-gray-400 mb-3"></i>
                                <p class="text-lg">No se encontraron usuarios registrados</p>
                                <a href="{{ route('usuarios.create') }}" class="mt-4 text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition-colors duration-200">
                                    <i class="fas fa-plus-circle mr-1"></i> Crear primer usuario
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($usuarios->hasPages())
        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600">
            {{ $usuarios->links() }}
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    // Inicializar tooltips si estás usando Tippy.js
    if (typeof tippy !== 'undefined') {
        tippy('[data-tippy-content]', {
            arrow: true,
            animation: 'fade',
            duration: 200,
            theme: 'light-border'
        });
    }
</script>
@endpush

<style>
    /* Efectos de hover mejorados */
    .transition-colors {
        transition-property: background-color, border-color, color, fill, stroke;
    }

    /* Ajustes para dark mode en la paginación */
    .dark .pagination * {
        color: #e5e7eb !important;
    }

    .dark .page-item.active .page-link {
        background-color: #4f46e5 !important;
        border-color: #4f46e5 !important;
    }

    .dark .page-link:hover {
        background-color: #3730a3 !important;
    }
</style>
@endsection