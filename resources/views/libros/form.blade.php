<form method="POST" action="{{ isset($libro) ? route('libros.update', $libro->libro_id) : route('libros.store') }}" enctype="multipart/form-data" class="space-y-4">
    @csrf
    @if(isset($libro))
        @method('PUT')
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Columna Izquierda -->
        <div class="space-y-4">
            <div>
                <label class="block font-medium">Título*</label>
                <input type="text" name="titulo" value="{{ old('titulo', $libro->titulo ?? '') }}" class="w-full p-2 border rounded" required>
            </div>
            
            <div>
                <label class="block font-medium">Imagen</label>
                <input type="file" name="imagen" class="w-full p-2 border rounded">
                @if(isset($libro) && $libro->imagen)
                    <img src="{{ asset($libro->imagen) }}" class="mt-2 h-20" alt="Portada del libro">
                @endif
            </div>
        </div>
        
        <!-- Columna Derecha -->
        <div class="space-y-4">
            <div>
                <label class="block font-medium">Autor*</label>
                <select name="autor_id" class="w-full p-2 border rounded" required>
                    @foreach($autores as $autor)
                        <option value="{{ $autor->autor_id }}" {{ (old('autor_id', $libro->autor_id ?? '') == $autor->autor_id ? 'selected' : '' }}>
                            {{ $autor->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Agrega más campos según necesites -->
            <div>
                <label class="block font-medium">Editorial*</label>
                <select name="editorial_id" class="w-full p-2 border rounded" required>
                    @foreach($editoriales as $editorial)
                        <option value="{{ $editorial->editorial_id }}" {{ (old('editorial_id', $libro->editorial_id ?? '') == $editorial->editorial_id ? 'selected' : '' }}>
                            {{ $editorial->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium">Género*</label>
                <select name="genero_id" class="w-full p-2 border rounded" required>
                    @foreach($generos as $genero)
                        <option value="{{ $genero->genero_id }}" {{ (old('genero_id', $libro->genero_id ?? '') == $genero->genero_id ? 'selected' : '' }}>
                            {{ $genero->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="pt-4">
        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded transition-colors duration-300">
            {{ isset($libro) ? 'Actualizar' : 'Guardar' }} Libro
        </button>
    </div>
</form>