<?php

namespace App\Http\Controllers;
use App\Http\Controllers\File;
use Illuminate\Http\Request;
use App\Models\Libro;
use App\Models\Autor;
use App\Models\Editorial;
use App\Models\Genero;
use App\Models\Ejemplar;

class LibroController extends Controller
{
    public function index()
    {
        $libros = Libro::activos()
                    ->with(['autor', 'editorial', 'genero'])
                    ->paginate(10);
        return view('libros.index', compact('libros'));
    }
    
    public function create()
    {
        $autores = Autor::all();
        $editoriales = Editorial::all();
        $generos = Genero::all();
        return view('libros.create', compact('autores', 'editoriales', 'generos'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'autor_id' => 'required|exists:autores,autor_id',
            'editorial_id' => 'required|exists:editoriales,editorial_id',
            'genero_id' => 'required|exists:generos,genero_id',
            'anio_publicacion' => 'nullable|integer|min:1800|max:'.(date('Y')+1),
            'isbn' => 'nullable|string|unique:libros,isbn',
            'numero_paginas' => 'nullable|integer|min:1',
            'idioma' => 'nullable|string|max:50',
            'resumen' => 'nullable|string',
            'formato' => 'required|in:Físico,Digital,Audiolibro',
            'edicion' => 'nullable|string|max:50',
            'disponibilidad' => 'required|in:Disponible,Agotado,Próximamente'
        ]);
    
        // Manejo de la imagen
        if($request->hasFile('imagen')) {
            $image = $request->file('imagen');
            $imageName = time().'_'.$image->getClientOriginalName();
            $uploadPath = 'images/libros/';
            
            // Crear directorio si no existe
            if (!file_exists(public_path($uploadPath))) {
                mkdir(public_path($uploadPath), 0777, true);
            }
            
            // Mover la imagen
            $image->move(public_path($uploadPath), $imageName);
            $validated['imagen'] = $uploadPath.$imageName;
        }
    
        Libro::create($validated);
        
        return redirect()->route('libros.index')->with('success', 'Libro registrado exitosamente');
    }
    
    public function edit(Libro $libro)
    {
        $autores = Autor::all();
        $editoriales = Editorial::all();
        $generos = Genero::all();
        return view('libros.edit', compact('libro', 'autores', 'editoriales', 'generos'));
    }
    
    public function update(Request $request, Libro $libro)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'autor_id' => 'required|exists:autores,autor_id',
            'editorial_id' => 'required|exists:editoriales,editorial_id',
            'genero_id' => 'required|exists:generos,genero_id',
            'anio_publicacion' => 'nullable|integer|min:1800|max:'.(date('Y')+1),
            'isbn' => 'nullable|string|unique:libros,isbn,'.$libro->libro_id.',libro_id',
            'numero_paginas' => 'nullable|integer|min:1',
            'idioma' => 'nullable|string|max:50',
            'resumen' => 'nullable|string',
            'formato' => 'required|in:Físico,Digital,Audiolibro',
            'edicion' => 'nullable|string|max:50',
            'disponibilidad' => 'required|in:Disponible,Agotado,Próximamente'
        ]);
    
        // Manejo de la imagen
        if($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if($libro->imagen && file_exists(public_path($libro->imagen))) {
                unlink(public_path($libro->imagen));
            }
            
            $image = $request->file('imagen');
            $imageName = time().'_'.$image->getClientOriginalName();
            $uploadPath = 'images/libros/';
            
            // Mover la nueva imagen
            $image->move(public_path($uploadPath), $imageName);
            $validated['imagen'] = $uploadPath.$imageName;
        }
    
        $libro->update($validated);
        
        return redirect()->route('libros.index')->with('success', 'Libro actualizado exitosamente');
    }
    
    public function show(Libro $libro)
    {
        $libro->load(['autor', 'editorial', 'genero', 'ejemplares']);
        return view('libros.show', compact('libro'));
    }
    
    // Eliminación lógica
    public function destroy(Libro $libro)
    {
        $libro->update(['estado_auditoria' => '0']);
        return redirect()->route('libros.index')->with('success', 'Libro desactivado exitosamente');
    }

    // Método para restaurar libros desactivados
    public function restore($id)
    {
        $libro = Libro::withTrashed()->find($id);
        $libro->update(['estado_auditoria' => '1']);
        return redirect()->back()->with('success', 'Libro reactivado exitosamente');
    }
    
}
