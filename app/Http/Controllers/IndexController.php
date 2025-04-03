<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genero;
use App\Models\Libro;
use App\Models\Editorial;

class IndexController extends Controller
{
    
    public function index()
    {
        $generos = Genero::orderBy('nombre')->get();
        $editoriales = Editorial::orderBy('nombre')->get();
        
        return view('index', compact('generos', 'editoriales'));
    }
}
