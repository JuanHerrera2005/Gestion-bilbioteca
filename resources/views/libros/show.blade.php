@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">
        <div class="bg-gray-800 rounded-xl shadow-xl overflow-hidden">
            <!-- Encabezado -->
            <div class="bg-gray-700 px-6 py-4 border-b border-gray-600">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-purple-400 flex items-center">
                        <i class="fas fa-book-open mr-3"></i>
                        {{ $libro->titulo }}
                    </h2>
                    <div class="flex space-x-3">
                        <a href="{{ route('libros.edit', $libro) }}" 
                           class="text-yellow-400 hover:text-yellow-300">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <a href="{{ route('libros.index') }}" 
                           class="text-purple-400 hover:text-purple-300">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contenido -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Portada -->
                    <div class="md:col-span-1">
                        <div class="relative pt-[150%] bg-gray-700 rounded-lg overflow-hidden">
                            @if($libro->imagen)
                                <img src="{{ $libro->imagen }}" 
                                     alt="Portada de {{ $libro->titulo }}"
                                     class="absolute inset-0 w-full h-full object-cover"
                                     onerror="this.src='https://via.placeholder.com/300x450/1f2937/9ca3af?text=Portada+no+disponible'">
                            @else
                                <div class="absolute inset-0 flex items-center justify-center text-gray-400">
                                    <i class="fas fa-book-open text-5xl"></i>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Detalles -->
                    <div class="md:col-span-2 space-y-6">
                        <!-- Información básica -->
                        <div class="bg-gray-700 p-5 rounded-lg">
                            <h3 class="text-xl font-bold text-purple-400 mb-4 border-b border-gray-600 pb-2">
                                <i class="fas fa-info-circle mr-2"></i> Información del Libro
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-gray-400 font-medium">Autor:</p>
                                    <p class="text-gray-200">
                                        {{ $libro->autor->nombre }} {{ $libro->autor->apellido_paterno }} {{ $libro->autor->apellido_materno }}
                                    </p>
                                </div>
                                
                                <div>
                                    <p class="text-gray-400 font-medium">Género:</p>
                                    <p class="text-gray-200">{{ $libro->genero->nombre }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-gray-400 font-medium">Editorial:</p>
                                    <p class="text-gray-200">{{ $libro->editorial->nombre }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-gray-400 font-medium">ISBN:</p>
                                    <p class="text-gray-200">{{ $libro->isbn ?? 'No disponible' }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-gray-400 font-medium">Año:</p>
                                    <p class="text-gray-200">{{ $libro->anio_publicacion ?? 'No disponible' }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-gray-400 font-medium">Páginas:</p>
                                    <p class="text-gray-200">{{ $libro->numero_paginas ?? 'No disponible' }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-gray-400 font-medium">Formato:</p>
                                    <p class="text-gray-200">{{ $libro->formato }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-gray-400 font-medium">Disponibilidad:</p>
                                    <span class="text-xs px-2 py-1 rounded-full 
                                        @if($libro->disponibilidad == 'Disponible') bg-green-900/30 text-green-400
                                        @elseif($libro->disponibilidad == 'Agotado') bg-red-900/30 text-red-400
                                        @else bg-yellow-900/30 text-yellow-400 @endif">
                                        {{ $libro->disponibilidad }}
                                    </span>
                                </div>
                                
                                <div>
                                    <p class="text-gray-400 font-medium">Edición:</p>
                                    <p class="text-gray-200">{{ $libro->edicion ?? 'No disponible' }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-gray-400 font-medium">Idioma:</p>
                                    <p class="text-gray-200">{{ $libro->idioma ?? 'No disponible' }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-gray-400 font-medium">Estado:</p>
                                    <span class="text-xs px-2 py-1 rounded-full 
                                        {{ $libro->estado_auditoria == 1 ? 'bg-blue-900/30 text-blue-400' : 'bg-gray-900/30 text-gray-400' }}">
                                        {{ $libro->estado_auditoria == 1 ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Resumen -->
                        @if($libro->resumen)
                        <div class="bg-gray-700 p-5 rounded-lg">
                            <h3 class="text-xl font-bold text-purple-400 mb-4 border-b border-gray-600 pb-2">
                                <i class="fas fa-align-left mr-2"></i> Resumen
                            </h3>
                            <p class="text-gray-200 whitespace-pre-line">{{ $libro->resumen }}</p>
                        </div>
                        @endif

                        <!-- Ejemplares -->
                        @if($libro->ejemplares->count() > 0)
                        <div class="bg-gray-700 p-5 rounded-lg">
                            <h3 class="text-xl font-bold text-purple-400 mb-4 border-b border-gray-600 pb-2">
                                <i class="fas fa-copy mr-2"></i> Ejemplares ({{ $libro->ejemplares->count() }})
                            </h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-600">
                                    <thead class="bg-gray-600">
                                        <tr>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Código</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Estado</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Ubicación</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-gray-700 divide-y divide-gray-600">
                                        @foreach($libro->ejemplares as $ejemplar)
                                        <tr>
                                            <td class="px-4 py-3 whitespace-nowrap text-gray-200">{{ $ejemplar->codigo }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap">
                                                <span class="px-2 py-1 text-xs rounded-full 
                                                    {{ $ejemplar->estado == 'Disponible' ? 'bg-green-900/30 text-green-400' : 'bg-red-900/30 text-red-400' }}">
                                                    {{ $ejemplar->estado }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap text-gray-200">{{ $ejemplar->ubicacion }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection