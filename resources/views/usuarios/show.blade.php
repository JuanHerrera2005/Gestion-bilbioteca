@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">
        <div class="bg-gray-800 rounded-xl shadow-xl overflow-hidden">
            <div class="bg-gray-700 px-6 py-4 border-b border-gray-600">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-purple-400 flex items-center">
                        <i class="fas fa-user mr-3"></i>
                        {{ $usuario->nombre }} {{ $usuario->apellido_paterno }}
                    </h2>
                    <div class="flex space-x-3">
                        <a href="{{ route('usuarios.edit', $usuario) }}" 
                           class="text-yellow-400 hover:text-yellow-300">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <a href="{{ route('usuarios.index') }}" 
                           class="text-purple-400 hover:text-purple-300">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-gray-700 p-5 rounded-lg">
                        <h3 class="text-xl font-bold text-purple-400 mb-4 border-b border-gray-600 pb-2">
                            <i class="fas fa-info-circle mr-2"></i> Información del Usuario
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-gray-400 font-medium">Nombre:</p>
                                <p class="text-gray-200">{{ $usuario->nombre }}</p>
                            </div>
                            
                            <div>
                                <p class="text-gray-400 font-medium">Apellido Paterno:</p>
                                <p class="text-gray-200">{{ $usuario->apellido_paterno }}</p>
                            </div>
                            
                            <div>
                                <p class="text-gray-400 font-medium">Apellido Materno:</p>
                                <p class="text-gray-200">{{ $usuario->apellido_materno ?? 'No disponible' }}</p>
                            </div>
                            
                            <div>
                                <p class="text-gray-400 font-medium">Tipo Documento:</p>
                                <p class="text-gray-200">{{ $usuario->tipo_documento }}</p>
                            </div>
                            
                            <div>
                                <p class="text-gray-400 font-medium">Número Documento:</p>
                                <p class="text-gray-200">{{ $usuario->numero_documento }}</p>
                            </div>
                            
                            <div>
                                <p class="text-gray-400 font-medium">Email:</p>
                                <p class="text-gray-200">{{ $usuario->email }}</p>
                            </div>
                            
                            <div>
                                <p class="text-gray-400 font-medium">Teléfono:</p>
                                <p class="text-gray-200">{{ $usuario->telefono ?? 'No disponible' }}</p>
                            </div>
                            
                            <div>
                                <p class="text-gray-400 font-medium">Dirección:</p>
                                <p class="text-gray-200">{{ $usuario->direccion ?? 'No disponible' }}</p>
                            </div>
                            
                            <div>
                                <p class="text-gray-400 font-medium">Fecha de Nacimiento:</p>
                                <p class="text-gray-200">{{ $usuario->fecha_nacimiento ?? 'No disponible' }}</p>
                            </div>
                            
                            <div>
                                <p class="text-gray-400 font-medium">Género:</p>
                                <p class="text-gray-200">{{ $usuario->genero ?? 'No disponible' }}</p>
                            </div>
                            
                            <div>
                                <p class="text-gray-400 font-medium">Ocupación:</p>
                                <p class="text-gray-200">{{ $usuario->ocupacion ?? 'No disponible' }}</p>
                            </div>
                            
                            <div>
                                <p class="text-gray-400 font-medium">Estado Civil:</p>
                                <p class="text-gray-200">{{ $usuario->estado_civil ?? 'No disponible' }}</p>
                            </div>
                            
                            <div>
                                <p class="text-gray-400 font-medium">Nacionalidad:</p>
                                <p class="text-gray-200">{{ $usuario->nacionalidad ?? 'No disponible' }}</p>
                            </div>
                            
                            <div>
                                <p class="text-gray-400 font-medium">Nivel Educativo:</p>
                                <p class="text-gray-200">{{ $usuario->nivel_educativo ?? 'No disponible' }}</p>
                            </div>

                            <div>
                                <p class="text-gray-400 font-medium">Estado:</p>
                                <span class="text-xs px-2 py-1 rounded-full 
                                    {{ $usuario->estado_auditoria == 1 ? 'bg-blue-900/30 text-blue-400' : 'bg-gray-900/30 text-gray-400' }}">
                                    {{ $usuario->estado_auditoria == 1 ? 'Activo' : 'Inactivo' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection