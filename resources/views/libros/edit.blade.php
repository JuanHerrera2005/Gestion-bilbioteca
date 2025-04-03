@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Editar Libro: {{ $libro->titulo }}</h1>
        <a href="{{ route('libros.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
            <i class="fas fa-arrow-left mr-2"></i> Volver
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        @include('libros.form', [
            'action' => route('libros.update', $libro->libro_id),
            'method' => 'PUT',
            'libro' => $libro,
            'autores' => $autores,
            'editoriales' => $editoriales,
            'generos' => $generos
        ])
    </div>
</div>
@endsection