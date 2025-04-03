<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;
use App\Models\Autor;
use App\Models\Genero;
use App\Models\Editorial;

class BusquedaController extends Controller
{
    public function mostrarFormulario()
    {
        $generos = Genero::orderBy('nombre')->get();
        $editoriales = Editorial::orderBy('nombre')->get();
        
        // Si está en tu vista principal (index)
        return view('index', compact('generos', 'editoriales'));
        
        // O si prefieres una ruta específica para el formulario:
        // return view('busqueda.index', compact('generos', 'editoriales'));
    }

    public function buscar(Request $request)
    {
        $request->validate([
            'titulo' => 'nullable|string|max:255',
            'autor' => 'nullable|string|max:255',
            'genero_id' => 'nullable|exists:generos,genero_id',
            'editorial_id' => 'nullable|exists:editoriales,editorial_id',
            'anio_inicio' => 'nullable|integer|min:1900|max:'.date('Y'),
            'anio_fin' => 'nullable|integer|min:1900|max:'.date('Y'),
        ]);

        $libros = Libro::with(['autor', 'genero', 'editorial'])
            ->when($request->titulo, function($query) use ($request) {
                $query->where('titulo', 'like', '%'.$request->titulo.'%');
            })
            ->when($request->autor, function($query) use ($request) {
                $query->whereHas('autor', function($q) use ($request) {
                    $q->where('nombre', 'like', '%'.$request->autor.'%');
                });
            })
            ->when($request->genero_id, function($query) use ($request) {
                $query->where('genero_id', $request->genero_id);
            })
            ->when($request->editorial_id, function($query) use ($request) {
                $query->where('editorial_id', $request->editorial_id);
            })
            ->when($request->anio_inicio || $request->anio_fin, function($query) use ($request) {
                $query->whereBetween('anio_publicacion', [
                    $request->anio_inicio ?? 1900,
                    $request->anio_fin ?? date('Y')
                ]);
            })
            ->orderBy('titulo')
            ->paginate(12);

        return view('busqueda.resultados', [
            'libros' => $libros,
            'terminosBusqueda' => $request->all(),
            'totalResultados' => $libros->total()
        ]);
    }

    public function show(Libro $libro) // Tipo-hint el modelo
{
    return view('libros.show', compact('libro'));
}
}
