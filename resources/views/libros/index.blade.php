@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Listado de Libros</h1>
        <a href="{{ route('libros.create') }}" class="btn-create">
            <i class="fas fa-plus-circle mr-2"></i> Nuevo Libro
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left">Título</th>
                        <th class="px-6 py-3 text-left">Autor</th>
                        <th class="px-6 py-3 text-left">Editorial</th>
                        <th class="px-6 py-3 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($libros as $libro)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-6 py-4">{{ $libro->titulo }}</td>
                        <td class="px-6 py-4">{{ $libro->autor->nombre }}</td>
                        <td class="px-6 py-4">{{ $libro->editorial->nombre }}</td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('libros.edit', $libro->libro_id) }}" 
                                   class="btn-edit" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <form action="{{ route('libros.destroy', $libro->libro_id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-delete" 
                                            title="Desactivar"
                                            onclick="return confirm('¿Desactivar este libro?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                                
                                <a href="{{ route('libros.show', $libro->libro_id) }}" 
                                   class="btn-view" title="Ver Detalles">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700">
            {{ $libros->links() }}
        </div>
    </div>
</div>
@endsection