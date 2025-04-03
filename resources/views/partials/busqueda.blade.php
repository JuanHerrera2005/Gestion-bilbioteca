<!-- Módulo: Búsqueda Avanzada -->
<section id="busqueda" class="card bg-gray-800 p-8 rounded-xl shadow-lg slide-in-left mb-12">
    <h2 class="text-2xl font-bold text-purple-400 mb-4 flex items-center">
        <i class="fas fa-search mr-2"></i> Búsqueda Avanzada
    </h2>
    
    <form action="{{ route('busqueda.resultados') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @csrf
        
        <!-- Campo de Título -->
        <div class="md:col-span-2">
            <label for="titulo" class="block text-sm font-medium text-gray-400 mb-1">
                <i class="fas fa-book mr-2"></i> Título del libro
            </label>
            <input type="text" id="titulo" name="titulo" value="{{ request('titulo') }}"
                   class="w-full p-3 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-purple-500"
                   placeholder="Ej: Cien años de soledad">
        </div>
        
        <!-- Campo de Autor -->
        <div>
            <label for="autor" class="block text-sm font-medium text-gray-400 mb-1">
                <i class="fas fa-user-edit mr-2"></i> Autor
            </label>
            <input type="text" id="autor" name="autor" value="{{ request('autor') }}"
                   class="w-full p-3 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-purple-500"
                   placeholder="Ej: Gabriel García Márquez">
        </div>
        
        <!-- Filtro por Género -->
        <div>
            <label for="genero_id" class="block text-sm font-medium text-gray-400 mb-1">
                <i class="fas fa-tag mr-2"></i> Género
            </label>
            <select id="genero_id" name="genero_id" class="w-full p-3 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                <option value="">Todos los géneros</option>
                @foreach($generos as $genero)
                    <option value="{{ $genero->genero_id }}" {{ request('genero_id') == $genero->genero_id ? 'selected' : '' }}>
                        {{ $genero->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <!-- Filtro por Editorial -->
        <div>
            <label for="editorial_id" class="block text-sm font-medium text-gray-400 mb-1">
                <i class="fas fa-building mr-2"></i> Editorial
            </label>
            <select id="editorial_id" name="editorial_id" class="w-full p-3 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                <option value="">Todas las editoriales</option>
                @foreach($editoriales as $editorial)
                    <option value="{{ $editorial->editorial_id }}" {{ request('editorial_id') == $editorial->editorial_id ? 'selected' : '' }}>
                        {{ $editorial->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <!-- Rango de Años -->
        <div class="md:col-span-2 grid grid-cols-2 gap-4">
            <div>
                <label for="anio_inicio" class="block text-sm font-medium text-gray-400 mb-1">
                    <i class="fas fa-calendar-alt mr-2"></i> Año desde
                </label>
                <input type="number" id="anio_inicio" name="anio_inicio" value="{{ request('anio_inicio') }}"
                       class="w-full p-3 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-purple-500"
                       placeholder="1900" min="1900" max="{{ date('Y') }}">
            </div>
            <div>
                <label for="anio_fin" class="block text-sm font-medium text-gray-400 mb-1">
                    <i class="fas fa-calendar-alt mr-2"></i> Año hasta
                </label>
                <input type="number" id="anio_fin" name="anio_fin" value="{{ request('anio_fin') }}"
                       class="w-full p-3 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-purple-500"
                       placeholder="{{ date('Y') }}" min="1900" max="{{ date('Y') }}">
            </div>
        </div>
        
        <!-- Botón de búsqueda -->
        <div class="md:col-span-2 flex justify-end">
            <button type="submit" class="px-6 py-3 bg-purple-600 hover:bg-purple-700 rounded-lg text-white font-medium transition duration-300 flex items-center">
                <i class="fas fa-search mr-2"></i> Buscar Libros
            </button>
        </div>
    </form>
</section>