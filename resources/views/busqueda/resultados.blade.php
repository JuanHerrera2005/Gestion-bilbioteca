@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-purple-500">
            <i class="fas fa-search mr-2"></i> Resultados de Búsqueda
        </h1>
        <a href="{{ route('busqueda.index') }}" class="text-purple-400 hover:text-purple-300">
            <i class="fas fa-arrow-left mr-1"></i> Nueva búsqueda
        </a>
    </div>

    @if($libros->isEmpty())
        <div class="bg-gray-800 rounded-lg p-8 text-center">
            <i class="fas fa-book-open text-5xl text-gray-500 mb-4"></i>
            <h3 class="text-xl text-gray-300 mb-2">No se encontraron resultados</h3>
            <p class="text-gray-500">Prueba con otros términos de búsqueda</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($libros as $libro)
                @if($libro->estado_auditoria == 1) {{-- Solo mostrar libros con estado_auditoria = 1 --}}
                    <div class="bg-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300">
                        <!-- Contenedor de imagen -->
                        <div class="relative pt-[150%] bg-gray-700 overflow-hidden">
                            @if($libro->imagen)
                                <img 
                                    src="{{ $libro->imagen }}" 
                                    alt="Portada de {{ $libro->titulo }}"
                                    class="absolute inset-0 w-full h-full object-cover"
                                    loading="lazy"
                                    style="image-rendering: optimizeQuality; backface-visibility: hidden;"
                                    onerror="this.onerror=null;this.src='https://via.placeholder.com/300x450/1f2937/9ca3af?text=Portada+no+disponible'"
                                >
                            @else
                                <div class="absolute inset-0 flex flex-col items-center justify-center text-gray-400 p-4">
                                    <i class="fas fa-book-open text-5xl mb-3"></i>
                                    <p>Imagen no disponible</p>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Información completa del libro -->
                        <div class="p-5">
                            <h3 class="text-xl font-bold text-white mb-2">
                                {{ $libro->titulo }}
                            </h3>
                            
                            <div class="text-gray-400 mb-2">
                                <p class="font-medium">Autor:</p>
                                <p>{{ $libro->autor->nombre }} {{ $libro->autor->apellido_paterno }} {{ $libro->autor->apellido_materno }}</p>
                            </div>
                            
                            <div class="text-gray-400 mb-2">
                                <p class="font-medium">Género:</p>
                                <p>{{ $libro->genero->nombre }}</p>
                            </div>
                            
                            <div class="flex flex-wrap gap-3 text-gray-400">
                                <div>
                                    <p class="font-medium">Disponibilidad:</p>
                                    <span class="text-xs px-2 py-1 rounded-full 
                                        @if($libro->disponibilidad == 'Disponible') bg-green-900/30 text-green-400
                                        @elseif($libro->disponibilidad == 'Agotado') bg-red-900/30 text-red-400
                                        @else bg-yellow-900/30 text-yellow-400 @endif">
                                        {{ $libro->disponibilidad }}
                                    </span>
                                </div>
                                
                                <div>
                                    <p class="font-medium">Estado:</p>
                                    <span class="text-xs px-2 py-1 rounded-full 
                                        {{ $libro->estado_auditoria == 1 ? 'bg-blue-900/30 text-blue-400' : 'bg-gray-900/30 text-gray-400' }}">
                                        {{ $libro->estado_auditoria == 1 ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="mt-12">
            {{ $libros->appends(request()->query())->links() }}
        </div>
    @endif
</div>

<style>
    /* Estilos para mejorar la calidad de imágenes */
    img {
        image-rendering: -moz-crisp-edges;
        image-rendering: -o-crisp-edges;
        image-rendering: -webkit-optimize-contrast;
        image-rendering: crisp-edges;
        -ms-interpolation-mode: bicubic;
    }
    
    /* Efecto hover más suave */
    .transition-all {
        transition-property: all;
    }
    
    .duration-300 {
        transition-duration: 300ms;
    }
    
    /* Mejor espaciado para badges */
    .text-xs {
        font-size: 0.75rem;
        line-height: 1rem;
    }
</style>
@endsection