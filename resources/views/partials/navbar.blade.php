<!-- Barra de navegación -->
<nav class="navbar fixed top-0 left-0 w-full bg-gray-900 shadow-lg py-4 transition-all">
    <div class="container mx-auto px-6 flex justify-between items-center">
        <a href="{{ url('/') }}" class="text-2xl font-extrabold text-purple-400">📚 Biblioteca</a>
        <button class="md:hidden text-white" id="menu-button">☰</button>
        <ul class="hidden md:flex space-x-6 text-lg">
            <li><a href="{{ url('/') }}" class="hover:text-purple-400 transition duration-300">Inicio</a></li>
            <li><a href="#busqueda" class="hover:text-purple-400 transition duration-300">Búsqueda</a></li>
            <li><a href="{{ url('/ConsultarLibro') }}" class="hover:text-purple-400 transition duration-300">Lista Libros</a></li>
            <li><a href="{{ url('/ConsultarUsuario') }}" class="hover:text-purple-400 transition duration-300">Lista Usuarios</a></li>

            @if (Auth::check())
                <li class="relative">
                    <span class="text-white">{{ Auth::user()->nombre }} {{ Auth::user()->apellido_paterno }}</span>
                    <!-- Menú desplegable para el perfil y cerrar sesión -->
                    <button class="text-white focus:outline-none">▼</button>
                    <ul class="absolute hidden bg-gray-800 text-white text-sm p-2 shadow-lg">
                        <li><a href="{{ url('/perfil') }}" class="block hover:text-purple-400 transition duration-300">Perfil</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" class="w-full text-white hover:text-purple-400 text-left">Cerrar sesión</button>
                            </form>
                        </li>
                    </ul>
                </li>
            @else
                <li><a href="{{ url('/login') }}" class="hover:text-purple-400 transition duration-300">Iniciar Sesión</a></li>
            @endif
        </ul>
    </div>
</nav>

<script>
    // Animación para mostrar el menú en móviles
    document.getElementById("menu-button").addEventListener("click", function() {
        document.querySelector("nav ul").classList.toggle("hidden");
    });

    // Mostrar el menú desplegable al hacer clic en el nombre del usuario
    const userButton = document.querySelector('li.relative button');
    const dropdownMenu = document.querySelector('li.relative ul');

    if (userButton && dropdownMenu) {
        userButton.addEventListener("click", function() {
            dropdownMenu.classList.toggle("hidden");
        });
    }
</script>
