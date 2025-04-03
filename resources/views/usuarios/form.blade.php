@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">
        <div class="bg-gray-800 rounded-xl shadow-xl overflow-hidden">
            <div class="bg-gray-700 px-6 py-4 border-b border-gray-600">
                <h2 class="text-2xl font-bold text-purple-400 flex items-center">
                    <i class="fas fa-users mr-3"></i>
                    {{ $method == 'PUT' ? 'Editar Usuario' : 'Registrar Nuevo Usuario' }}
                </h2>
            </div>

            <form method="POST" action="{{ $action }}" class="space-y-6 p-6">
                @csrf
                @method($method ?? 'POST')

                <!-- Mostrar errores de validación -->
                @if($errors->any())
                <div class="bg-red-900/30 border border-red-700 text-red-300 px-4 py-3 rounded mb-6">
                    <h4 class="font-bold mb-2">Corrige los siguientes errores:</h4>
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <div class="border-b border-gray-700 pb-6">
                            <h3 class="text-xl font-bold text-purple-400 mb-6 flex items-center">
                                <i class="fas fa-info-circle mr-2"></i> Información Básica
                            </h3>

                            <div class="mb-5">
                                <label class="block font-medium text-gray-300 mb-3">Nombre*</label>
                                <input type="text" name="nombre" value="{{ old('nombre', $usuario->nombre ?? '') }}" 
                                       class="w-full p-4 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-gray-200 placeholder-gray-500" 
                                       placeholder="Ej: Juan"
                                       required>
                            </div>

                            <div class="mb-5">
                                <label class="block font-medium text-gray-300 mb-3">Apellido Paterno*</label>
                                <input type="text" name="apellido_paterno" value="{{ old('apellido_paterno', $usuario->apellido_paterno ?? '') }}" 
                                       class="w-full p-4 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-gray-200 placeholder-gray-500"
                                       placeholder="Ej: Pérez"
                                       required>
                            </div>

                            <div class="mb-5">
                                <label class="block font-medium text-gray-300 mb-3">Apellido Materno</label>
                                <input type="text" name="apellido_materno" value="{{ old('apellido_materno', $usuario->apellido_materno ?? '') }}" 
                                       class="w-full p-4 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-gray-200 placeholder-gray-500"
                                       placeholder="Ej: García">
                            </div>

                            <div class="mb-5">
                                <label class="block font-medium text-gray-300 mb-3">Tipo Documento*</label>
                                <select name="tipo_documento" class="w-full p-4 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-gray-200" required>
                                    <option value="" class="text-gray-500">Seleccione un tipo de documento</option>
                                    <option value="DNI" {{ old('tipo_documento', $usuario->tipo_documento ?? '') == 'DNI' ? 'selected' : '' }} class="bg-gray-800">DNI</option>
                                    <option value="Pasaporte" {{ old('tipo_documento', $usuario->tipo_documento ?? '') == 'Pasaporte' ? 'selected' : '' }} class="bg-gray-800">Pasaporte</option>
                                    <option value="Carnet de Extranjería" {{ old('tipo_documento', $usuario->tipo_documento ?? '') == 'Carnet de Extranjería' ? 'selected' : '' }} class="bg-gray-800">Carnet de Extranjería</option>
                                </select>
                            </div>

                            <div class="mb-5">
                                <label class="block font-medium text-gray-300 mb-3">Número Documento*</label>
                                <input type="text" name="numero_documento" value="{{ old('numero_documento', $usuario->numero_documento ?? '') }}" 
                                       class="w-full p-4 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-gray-200 placeholder-gray-500"
                                       placeholder="Ej: 12345678"
                                       required>
                            </div>
                        </div>

                        <div class="border-b border-gray-700 pb-6">
                            <h3 class="text-xl font-bold text-purple-400 mb-6 flex items-center">
                                <i class="fas fa-lock mr-2"></i> Seguridad
                            </h3>

                            <div class="mb-5">
                                <label class="block font-medium text-gray-300 mb-3">Contraseña{{ $method == 'PUT' ? ' (Dejar en blanco para no cambiar)' : '*' }}</label>
                                <input type="password" name="contrasena" 
                                       class="w-full p-4 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-gray-200 placeholder-gray-500"
                                       placeholder="{{ $method == 'PUT' ? 'Nueva contraseña (opcional)' : 'Mínimo 8 caracteres' }}"
                                       {{ $method == 'PUT' ? '' : 'required' }}
                                       minlength="8">
                            </div>

                            <div class="mb-5">
                                <label class="block font-medium text-gray-300 mb-3">Confirmar Contraseña{{ $method == 'PUT' ? '' : '*' }}</label>
                                <input type="password" name="contrasena_confirmation" 
                                       class="w-full p-4 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-gray-200 placeholder-gray-500"
                                       placeholder="Repetir contraseña"
                                       {{ $method == 'PUT' ? '' : 'required' }}>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="border-b border-gray-700 pb-6">
                            <h3 class="text-xl font-bold text-purple-400 mb-6 flex items-center">
                                <i class="fas fa-envelope mr-2"></i> Contacto
                            </h3>

                            <div class="mb-5">
                                <label class="block font-medium text-gray-300 mb-3">Email*</label>
                                <input type="email" name="email" value="{{ old('email', $usuario->email ?? '') }}" 
                                       class="w-full p-4 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-gray-200 placeholder-gray-500"
                                       placeholder="Ej: juan@example.com"
                                       required>
                            </div>

                            <div class="mb-5">
                                <label class="block font-medium text-gray-300 mb-3">Teléfono</label>
                                <input type="tel" name="telefono" value="{{ old('telefono', $usuario->telefono ?? '') }}" 
                                       class="w-full p-4 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-gray-200 placeholder-gray-500"
                                       placeholder="Ej: 987654321">
                            </div>

                            <div class="mb-5">
                                <label class="block font-medium text-gray-300 mb-3">Dirección</label>
                                <input type="text" name="direccion" value="{{ old('direccion', $usuario->direccion ?? '') }}" 
                                       class="w-full p-4 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-gray-200 placeholder-gray-500"
                                       placeholder="Ej: Calle Principal 123">
                            </div>
                        </div>

                        <div class="border-b border-gray-700 pb-6">
                            <h3 class="text-xl font-bold text-purple-400 mb-6 flex items-center">
                                <i class="fas fa-calendar-alt mr-2"></i> Detalles Adicionales
                            </h3>

                            <div class="mb-5">
                                <label class="block font-medium text-gray-300 mb-3">Fecha de Nacimiento</label>
                                <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $usuario->fecha_nacimiento ?? '') }}" 
                                       class="w-full p-4 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-gray-200 placeholder-gray-500">
                            </div>

                            <div class="mb-5">
                                <label class="block font-medium text-gray-300 mb-3">Género</label>
                                <select name="genero" class="w-full p-4 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-gray-200">
                                    <option value="" class="text-gray-500">Seleccione un género</option>
                                    <option value="Masculino" {{ old('genero', $usuario->genero ?? '') == 'Masculino' ? 'selected' : '' }} class="bg-gray-800">Masculino</option>
                                    <option value="Femenino" {{ old('genero', $usuario->genero ?? '') == 'Femenino' ? 'selected' : '' }} class="bg-gray-800">Femenino</option>
                                    <option value="Otro" {{ old('genero', $usuario->genero ?? '') == 'Otro' ? 'selected' : '' }} class="bg-gray-800">Otro</option>
                                </select>
                            </div>

                            <div class="mb-5">
                                <label class="block font-medium text-gray-300 mb-3">Ocupación</label>
                                <input type="text" name="ocupacion" value="{{ old('ocupacion', $usuario->ocupacion ?? '') }}" 
                                       class="w-full p-4 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-gray-200 placeholder-gray-500"
                                       placeholder="Ej: Estudiante">
                            </div>

                            <div class="mb-5">
                                <label class="block font-medium text-gray-300 mb-3">Estado Civil</label>
                                <input type="text" name="estado_civil" value="{{ old('estado_civil', $usuario->estado_civil ?? '') }}" 
                                       class="w-full p-4 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-gray-200 placeholder-gray-500"
                                       placeholder="Ej: Soltero">
                            </div>

                            <div class="mb-5">
                                <label class="block font-medium text-gray-300 mb-3">Nacionalidad</label>
                                <input type="text" name="nacionalidad" value="{{ old('nacionalidad', $usuario->nacionalidad ?? '') }}" 
                                       class="w-full p-4 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-gray-200 placeholder-gray-500"
                                       placeholder="Ej: Peruano">
                            </div>

                            <div class="mb-5">
                                <label class="block font-medium text-gray-300 mb-3">Nivel Educativo</label>
                                <input type="text" name="nivel_educativo" value="{{ old('nivel_educativo', $usuario->nivel_educativo ?? '') }}" 
                                       class="w-full p-4 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-gray-200 placeholder-gray-500"
                                       placeholder="Ej: Universitario">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-6">
                    <a href="{{ route('usuarios.index') }}" class="bg-gray-600 hover:bg-gray-500 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-300 flex items-center mr-4">
                        <i class="fas fa-times mr-2"></i> Cancelar
                    </a>
                    <button type="submit" class="bg-purple-600 hover:bg-purple-500 text-white px-8 py-3 rounded-lg font-medium transition-colors duration-300 flex items-center">
                        <i class="fas {{ $method == 'PUT' ? 'fa-sync-alt' : 'fa-save' }} mr-2"></i>
                        {{ $method == 'PUT' ? 'Actualizar Usuario' : 'Registrar Usuario' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Estilos para selects */
    select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%239CA3AF'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7' /%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 1.5em;
    }
    
    /* Efecto hover para botón */
    button:hover {
        transform: translateY(-1px);
    }
    
    /* Transición suave para inputs */
    input, select, textarea {
        transition: all 0.3s ease;
    }
    
    /* Placeholder más oscuro */
    ::placeholder {
        color: #6B7280;
        opacity: 1;
    }
</style>
@endsection