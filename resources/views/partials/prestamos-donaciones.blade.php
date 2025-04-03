<!-- Módulo: Préstamos y Donaciones -->
<section id="prestamos" class="card bg-gray-800 p-8 rounded-xl shadow-lg slide-in-right">
    <h2 class="text-2xl font-bold text-purple-400 mb-4">📚 Préstamos y donaciones</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="{{ route('prestamos.create') }}" class="module-btn bg-blue-600 hover:bg-blue-700">
            <i class="fas fa-hand-holding mr-2"></i> Registrar Préstamo
        </a>
        <a href="{{ route('donaciones.create') }}" class="module-btn bg-green-600 hover:bg-green-700">
            <i class="fas fa-gift mr-2"></i> Registrar Donación
        </a>
    </div>
</section>