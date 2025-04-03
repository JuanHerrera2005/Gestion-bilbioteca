<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\BusquedaController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\UsuarioController;

// Ruta para archivos CSS estáticos
Route::get('/css/{file}', function ($file) {
    $path = resource_path('css/' . $file);
    if (file_exists($path)) {
        return Response::file($path, ['Content-Type' => 'text/css']);
    }
    abort(404, 'Archivo no encontrado');
});

// Ruta de autenticación
Route::get('/', function () {
    return view('login');
})->name('login');

// Ruta principal del sistema
Route::get('/index', [IndexController::class, 'index'])->name('index.index');

// Búsqueda
Route::prefix('busqueda')->group(function () {
    Route::get('/', [BusquedaController::class, 'index'])->name('busqueda.index');
    Route::get('/resultados', [BusquedaController::class, 'buscar'])->name('busqueda.resultados');
});

// Libros
Route::resource('libros', LibroController::class);

// Usuarios
Route::resource('usuarios', UsuarioController::class);
Route::get('/usuarios/{usuario}/historial', [UsuarioController::class, 'historial'])
    ->name('usuarios.historial')
    ->where('usuario', '[0-9]+');




    
    // Para mostrar el formulario en tu vista principal
Route::get('/', [IndexController::class, 'index'])->name('home');


// Ruta para procesar la búsqueda
Route::get('/busqueda/resultados', [BusquedaController::class, 'buscar'])->name('busqueda.resultados');
Route::resource('libros', LibroController::class)->parameters([
    'libros' => 'libro' // Esto mapea el parámetro
]);

Route::resource('libros', LibroController::class)->parameters([
    'libros' => 'libro:libro_id'
]);