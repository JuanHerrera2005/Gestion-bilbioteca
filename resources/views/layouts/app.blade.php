<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Biblioteca</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Vinculación de estilos personalizados -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-950 text-white font-sans">

    <!-- Incluir la barra de navegación -->
    @include('partials.navbar')

    <!-- Contenido principal -->
    <main class="container mx-auto px-6 py-16 mt-16">
        @yield('content') <!-- Espacio para el contenido dinámico -->
    </main>

    <!-- Incluir el pie de página -->
    @include('partials.footer')

    <script>
        // Animación para mostrar el menú en móviles
        document.getElementById("menu-button").addEventListener("click", function() {
            document.querySelector("nav ul").classList.toggle("hidden");
        });

        // Navbar con efecto de cambio al hacer scroll
        window.addEventListener("scroll", function () {
            let navbar = document.querySelector(".navbar");
            if (window.scrollY > 50) {
                navbar.classList.add("scrolled");
            } else {
                navbar.classList.remove("scrolled");
            }
        });
    </script>

</body>
</html>