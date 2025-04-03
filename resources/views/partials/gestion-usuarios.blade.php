<!-- Módulo: Gestión de Usuarios -->
<section id="usuarios" class="card bg-gray-800 p-8 rounded-xl shadow-lg slide-in-left mb-12">
    <h2 class="text-2xl font-bold text-purple-400 mb-4">👤 Gestión de Usuarios</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('usuarios.create') }}" class="module-btn bg-blue-600 hover:bg-blue-700">
            <i class="fas fa-user-plus mr-2"></i> Registrar Usuario
        </a>
        <a href="{{ route('usuarios.index') }}" class="module-btn bg-green-600 hover:bg-green-700">
            <i class="fas fa-users mr-2"></i> Consultar Usuarios
        </a>
        <a href="{{ route('usuarios.index') }}" class="module-btn bg-yellow-500 hover:bg-yellow-600">
            <i class="fas fa-history mr-2"></i> Ver Historial
        </a>
    </div>
</section>