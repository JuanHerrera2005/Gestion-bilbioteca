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
        $validated = $this->validateRequest($request);
        
        // Guardar solo la URL de la imagen
        $validated['imagen'] = $request->imagen;
        
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
        $validated = $this->validateRequest($request, $libro);
        
        // Actualizar la URL de la imagen
        $validated['imagen'] = $request->imagen;
        
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
        $libro = Libro::withTrashed()->findOrFail($id);
        $libro->update(['estado_auditoria' => '1']);
        return redirect()->back()->with('success', 'Libro reactivado exitosamente');
    }
    
    /**
     * Valida los datos del request para libros
     */
    protected function validateRequest(Request $request, Libro $libro = null)
    {
        $rules = [
            'titulo' => 'required|string|max:255',
            'imagen' => 'required|url|max:255', // URL válida y máximo 255 caracteres
            'autor_id' => 'required|exists:autores,autor_id',
            'editorial_id' => 'required|exists:editoriales,editorial_id',
            'genero_id' => 'required|exists:generos,genero_id',
            'anio_publicacion' => 'nullable|integer|min:1800|max:'.(date('Y')+1),
            'isbn' => 'nullable|string|unique:libros,isbn,'.($libro ? $libro->libro_id : 'NULL').',libro_id',
            'numero_paginas' => 'nullable|integer|min:1',
            'idioma' => 'nullable|string|max:50',
            'resumen' => 'nullable|string',
            'formato' => 'required|in:Físico,Digital,Audiolibro',
            'edicion' => 'nullable|string|max:50',
            'disponibilidad' => 'required|in:Disponible,Agotado,Próximamente'
        ];
        
        return $request->validate($rules);
    }


    

    
}
