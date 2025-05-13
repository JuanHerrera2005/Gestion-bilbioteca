<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\BusquedaController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AuthController;

// Ruta para archivos CSS estáticos
Route::get('/css/{file}', function ($file) {
    $path = resource_path('css/' . $file);
    if (file_exists($path)) {
        return Response::file($path, ['Content-Type' => 'text/css']);
    }
    abort(404, 'Archivo no encontrado');
});

// Ruta de autenticación
Route::get('/login', function () {
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


Route::resource('usuarios', UsuarioController::class)->parameters([
    'usuarios' => 'usuario'
]);

// Opción 2: Definir rutas manualmente
Route::get('usuarios/{usuario}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
Route::put('usuarios/{usuario}', [UsuarioController::class, 'update'])->name('usuarios.update');
Route::delete('usuarios/{usuario}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');



    
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
Route::get('/libros/{libro}', [LibroController::class, 'show'])->name('libros.show');

Route::prefix('busqueda')->group(function () {
    Route::get('/', [BusquedaController::class, 'mostrarFormulario'])->name('busqueda.index');
    Route::get('/resultados', [BusquedaController::class, 'buscar'])->name('busqueda.resultados');
});





