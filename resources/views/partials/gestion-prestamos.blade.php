<!-- Módulo: Gestión de Préstamos -->
<section id="prestamos" class="card bg-gray-800 p-8 rounded-xl shadow-lg slide-in-right mb-12">
    <h2 class="text-2xl font-bold text-purple-400 mb-4">📚 Gestión de Préstamos</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Botón para ver préstamos -->
        <a href="{{ route('prestamos.index') }}" class="module-btn bg-indigo-600 hover:bg-indigo-700 transition-colors flex items-center justify-center py-3 px-6 rounded-lg">
            <i class="fas fa-list-ol mr-2 text-lg"></i> 
            <span class="font-medium">Ver Préstamos</span>
        </a>

        <!-- Botón para registrar préstamo -->
        <a href="{{ route('prestamos.create') }}" class="module-btn bg-green-600 hover:bg-green-700 transition-colors flex items-center justify-center py-3 px-6 rounded-lg">
            <i class="fas fa-plus-circle mr-2 text-lg"></i> 
            <span class="font-medium">Registrar Préstamo</span>
        </a>
    </div>
</section>
