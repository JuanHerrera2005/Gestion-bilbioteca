<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="space-y-4">
    @csrf
    @method($method ?? 'POST')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Columna Izquierda -->
        <div class="space-y-4">
            <div>
                <label class="block font-medium">Título*</label>
                <input type="text" name="titulo" value="{{ old('titulo', $libro->titulo ?? '') }}" 
                       class="w-full p-2 border rounded" required>
            </div>
            
            <div>
                <label class="block font-medium">Imagen</label>
                <input type="file" name="imagen" class="w-full p-2 border rounded">
                @if(isset($libro) && $libro->imagen)
                    <img src="{{ asset($libro->imagen) }}" class="mt-2 h-20" alt="Portada">
                @endif
            </div>
        </div>
        
        <!-- Columna Derecha -->
        <div class="space-y-4">
            <div>
                <label class="block font-medium">Autor*</label>
                <select name="autor_id" class="w-full p-2 border rounded" required>
                    @foreach($autores as $autor)
                        <option value="{{ $autor->autor_id }}" 
                            {{ old('autor_id', $libro->autor_id ?? '') == $autor->autor_id ? 'selected' : '' }}>
                            {{ $autor->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

          
        </div>
    </div>

    <div class="pt-4">
        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
            {{ $method == 'PUT' ? 'Actualizar' : 'Guardar' }} Libro
        </button>
    </div>
</form>