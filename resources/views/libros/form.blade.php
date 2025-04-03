@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">
        <div class="bg-gray-800 rounded-xl shadow-xl overflow-hidden">
            <!-- Encabezado del formulario -->
            <div class="bg-gray-700 px-6 py-4 border-b border-gray-600">
                <h2 class="text-2xl font-bold text-purple-400 flex items-center">
                    <i class="fas fa-book-medical mr-3"></i>
                    {{ $method == 'PUT' ? 'Editar Libro' : 'Registrar Nuevo Libro' }}
                </h2>
            </div>

            <!-- Contenido del formulario -->
            <form method="POST" action="{{ $action }}" class="space-y-6 p-6">
                @csrf
                @method($method ?? 'POST')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Columna Izquierda -->
                    <div class="space-y-6">
                        <!-- Información Básica -->
                        <div class="border-b border-gray-700 pb-6">
                            <h3 class="text-xl font-bold text-purple-400 mb-6 flex items-center">
                                <i class="fas fa-info-circle mr-2"></i> Información Básica
                            </h3>
                            
                            <div class="mb-5">
                                <label class="block font-medium text-gray-300 mb-3">Título*</label>
                                <input type="text" name="titulo" value="{{ old('titulo', $libro->titulo ?? '') }}" 
                                       class="w-full p-4 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-gray-200 placeholder-gray-500" 
                                       placeholder="Ej: Cien años de soledad"
                                       required>
                            </div>

                            <div class="mb-5">
                                <label class="block font-medium text-gray-300 mb-3">URL de la Imagen</label>
                                <input type="url" name="imagen" value="{{ old('imagen', $libro->imagen ?? '') }}" 
                                       class="w-full p-4 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-gray-200 placeholder-gray-500"
                                       placeholder="https://ejemplo.com/imagen.jpg">
                                @if(isset($libro) && $libro->imagen)
                                    <div class="mt-4">
                                        <p class="text-sm text-gray-400 mb-2">Imagen actual:</p>
                                        <img src="{{ $libro->imagen }}" class="h-32 rounded-lg shadow" onerror="this.style.display='none'">
                                    </div>
                                @endif
                            </div>

                            <div class="mb-5">
                                <label class="block font-medium text-gray-300 mb-3">ISBN</label>
                                <input type="text" name="isbn" value="{{ old('isbn', $libro->isbn ?? '') }}" 
                                       class="w-full p-4 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-gray-200 placeholder-gray-500"
                                       placeholder="Ej: 978-0307474278">
                            </div>
                        </div>

                        <!-- Detalles de Publicación -->
                        <div class="border-b border-gray-700 pb-6">
                            <h3 class="text-xl font-bold text-purple-400 mb-6 flex items-center">
                                <i class="fas fa-calendar-alt mr-2"></i> Detalles de Publicación
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block font-medium text-gray-300 mb-3">Año Publicación</label>
                                    <input type="number" name="anio_publicacion" 
                                           value="{{ old('anio_publicacion', $libro->anio_publicacion ?? '') }}" 
                                           class="w-full p-4 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-gray-200 placeholder-gray-500"
                                           placeholder="Ej: 1967">
                                </div>
                                
                                <div>
                                    <label class="block font-medium text-gray-300 mb-3">N° Páginas</label>
                                    <input type="number" name="numero_paginas" 
                                           value="{{ old('numero_paginas', $libro->numero_paginas ?? '') }}" 
                                           class="w-full p-4 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-gray-200 placeholder-gray-500"
                                           placeholder="Ej: 432">
                                </div>
                            </div>

                            <div class="mt-5">
                                <label class="block font-medium text-gray-300 mb-3">Edición</label>
                                <input type="text" name="edicion" value="{{ old('edicion', $libro->edicion ?? '') }}" 
                                       class="w-full p-4 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-gray-200 placeholder-gray-500"
                                       placeholder="Ej: 1ra Edición">
                            </div>
                        </div>
                    </div>

                    <!-- Columna Derecha -->
                    <div class="space-y-6">
                        <!-- Relaciones -->
                        <div class="border-b border-gray-700 pb-6">
                            <h3 class="text-xl font-bold text-purple-400 mb-6 flex items-center">
                                <i class="fas fa-link mr-2"></i> Relaciones
                            </h3>
                            
                            <div class="mb-5">
                                <label class="block font-medium text-gray-300 mb-3">Autor*</label>
                                <select name="autor_id" class="w-full p-4 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-gray-200" required>
                                    <option value="" class="text-gray-500">Seleccione un autor</option>
                                    @foreach($autores as $autor)
                                        <option value="{{ $autor->autor_id }}" 
                                            {{ old('autor_id', $libro->autor_id ?? '') == $autor->autor_id ? 'selected' : '' }}
                                            class="bg-gray-800">
                                            {{ $autor->nombre }} {{ $autor->apellido_paterno }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-5">
                                <label class="block font-medium text-gray-300 mb-3">Editorial*</label>
                                <select name="editorial_id" class="w-full p-4 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-gray-200" required>
                                    <option value="" class="text-gray-500">Seleccione una editorial</option>
                                    @foreach($editoriales as $editorial)
                                        <option value="{{ $editorial->editorial_id }}"
                                            {{ old('editorial_id', $libro->editorial_id ?? '') == $editorial->editorial_id ? 'selected' : '' }}
                                            class="bg-gray-800">
                                            {{ $editorial->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-5">
                                <label class="block font-medium text-gray-300 mb-3">Género*</label>
                                <select name="genero_id" class="w-full p-4 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-gray-200" required>
                                    <option value="" class="text-gray-500">Seleccione un género</option>
                                    @foreach($generos as $genero)
                                        <option value="{{ $genero->genero_id }}"
                                            {{ old('genero_id', $libro->genero_id ?? '') == $genero->genero_id ? 'selected' : '' }}
                                            class="bg-gray-800">
                                            {{ $genero->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Configuraciones -->
                        <div class="border-b border-gray-700 pb-6">
                            <h3 class="text-xl font-bold text-purple-400 mb-6 flex items-center">
                                <i class="fas fa-cog mr-2"></i> Configuraciones
                            </h3>
                            
                            <div class="mb-5">
                                <label class="block font-medium text-gray-300 mb-3">Formato*</label>
                                <select name="formato" class="w-full p-4 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-gray-200" required>
                                    <option value="" class="text-gray-500">Seleccione un formato</option>
                                    <option value="Físico" {{ old('formato', $libro->formato ?? '') == 'Físico' ? 'selected' : '' }} class="bg-gray-800">Físico</option>
                                    <option value="Digital" {{ old('formato', $libro->formato ?? '') == 'Digital' ? 'selected' : '' }} class="bg-gray-800">Digital</option>
                                    <option value="Audiolibro" {{ old('formato', $libro->formato ?? '') == 'Audiolibro' ? 'selected' : '' }} class="bg-gray-800">Audiolibro</option>
                                </select>
                            </div>

                            <div class="mb-5">
                                <label class="block font-medium text-gray-300 mb-3">Disponibilidad*</label>
                                <select name="disponibilidad" class="w-full p-4 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-gray-200" required>
                                    <option value="" class="text-gray-500">Seleccione disponibilidad</option>
                                    <option value="Disponible" {{ old('disponibilidad', $libro->disponibilidad ?? '') == 'Disponible' ? 'selected' : '' }} class="bg-gray-800">Disponible</option>
                                    <option value="Agotado" {{ old('disponibilidad', $libro->disponibilidad ?? '') == 'Agotado' ? 'selected' : '' }} class="bg-gray-800">Agotado</option>
                                    <option value="Próximamente" {{ old('disponibilidad', $libro->disponibilidad ?? '') == 'Próximamente' ? 'selected' : '' }} class="bg-gray-800">Próximamente</option>
                                </select>
                            </div>

                            <div class="mb-5">
                                <label class="block font-medium text-gray-300 mb-3">Idioma</label>
                                <input type="text" name="idioma" value="{{ old('idioma', $libro->idioma ?? '') }}" 
                                       class="w-full p-4 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-gray-200 placeholder-gray-500"
                                       placeholder="Ej: Español">
                            </div>
                        </div>

                        <!-- Resumen -->
                        <div>
                            <h3 class="text-xl font-bold text-purple-400 mb-6 flex items-center">
                                <i class="fas fa-align-left mr-2"></i> Resumen
                            </h3>
                            <textarea name="resumen" rows="4" 
                                      class="w-full p-4 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-gray-200 placeholder-gray-500"
                                      placeholder="Breve descripción del libro...">{{ old('resumen', $libro->resumen ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-6">
                    <button type="submit" class="bg-purple-600 hover:bg-purple-500 text-white px-8 py-3 rounded-lg font-medium transition-colors duration-300 flex items-center">
                        <i class="fas {{ $method == 'PUT' ? 'fa-sync-alt' : 'fa-save' }} mr-2"></i>
                        {{ $method == 'PUT' ? 'Actualizar Libro' : 'Registrar Libro' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Estilos para selects */
    select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%239CA3AF'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7' /%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 1.5em;
    }
    
    /* Efecto hover para botón */
    button:hover {
        transform: translateY(-1px);
    }
    
    /* Transición suave para inputs */
    input, select, textarea {
        transition: all 0.3s ease;
    }
    
    /* Placeholder más oscuro */
    ::placeholder {
        color: #6B7280;
        opacity: 1;
    }
    
    /* Estilo para el footer */
    .footer {
        background-color: #1F2937;
        color: #9CA3AF;
        padding: 1rem;
        text-align: center;
        font-size: 0.875rem;
    }
</style>

<footer class="footer mt-12">
    © 2025 Sistema de Gestión de Biblioteca
</footer>
@endsection