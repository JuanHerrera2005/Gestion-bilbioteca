@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Editar Usuario: {{ $usuario->nombre }} {{ $usuario->apellido_paterno }}</h1>
        <a href="{{ route('usuarios.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
            <i class="fas fa-arrow-left mr-2"></i> Volver
        </a>
    </div>

    <div class="bg-gray-800 rounded-xl shadow-xl overflow-hidden">
        @include('usuarios.form', [
            'method' => 'PUT',
            'action' => route('usuarios.update', $usuario->usuario_id),
            'usuario' => $usuario
        ])
    </div>
</div>
@endsection