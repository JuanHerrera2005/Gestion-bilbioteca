<!-- Barra de navegación -->
<nav class="navbar fixed top-0 left-0 w-full bg-gray-900 shadow-lg py-4 transition-all">
    <div class="container mx-auto px-6 flex justify-between items-center">
        <a href="{{ url('/') }}" class="text-2xl font-extrabold text-purple-400">📚 Biblioteca</a>
        <button class="md:hidden text-white" id="menu-button">☰</button>
        <ul class="hidden md:flex space-x-6 text-lg">
            <li><a href="{{ url('/') }}" class="hover:text-purple-400 transition duration-300">Inicio</a></li>
            <li><a href="#busqueda" class="hover:text-purple-400 transition duration-300">Búsqueda</a></li>
            <li><a href="{{ url('/ConsultarLibro') }}" class="hover:text-purple-400 transition duration-300">Consultar Libro</a></li>
            <li><a href="{{ url('/ConsultarUsuario') }}" class="hover:text-purple-400 transition duration-300">Consultar Usuario</a></li>
            <li><a href="{{ url('/Loggin') }}" class="hover:text-purple-400 transition duration-300">Iniciar Sesión</a></li>
        </ul>
    </div>
</nav>