<?php

namespace App\Http\Controllers;

use App\Models\Ejemplar;

class EjemplarController extends Controller
{
    public function index()
    {
        // Cargar los ejemplares junto con los libros y autores
        $prestamosLista = Ejemplar::with('libro.autor')->get();

        // Pasar los datos a la vista
        return view('prestamos.prestamos', compact('prestamosLista'));
    }
}
