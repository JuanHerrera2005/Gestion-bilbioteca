<!-- Módulo: Gestión de Libros -->
<section id="libros" class="card bg-gray-800 p-8 rounded-xl shadow-lg slide-in-right mb-12">
    <h2 class="text-2xl font-bold text-purple-400 mb-4">📖 Gestión de Libros</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="{{ route('libros.index') }}" class="module-btn bg-indigo-600 hover:bg-indigo-700 transition-colors flex items-center justify-center py-3 px-6 rounded-lg">
            <i class="fas fa-list-ol mr-2 text-lg"></i> 
            <span class="font-medium">Ver Listado Completo</span>
        </a>
        
        <a href="{{ route('libros.create') }}" class="module-btn bg-emerald-600 hover:bg-emerald-700 transition-colors flex items-center justify-center py-3 px-6 rounded-lg">
            <i class="fas fa-plus-circle mr-2 text-lg"></i>
            <span class="font-medium">Nuevo Libro</span>
        </a>
    </div>
</section>