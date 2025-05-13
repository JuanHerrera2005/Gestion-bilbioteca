<!DOCTYPE html>
<html>
<head>
    <title>Autores y Eventos</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="text-center space-y-6">
        <h1 class="text-3xl font-bold text-gray-800">Gestión de Autores y Eventos</h1>
        
        <div class="space-x-4">
            <a href="{{ route('autores.index') }}">
                <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-xl shadow-md">
                    Ver Autores
                </button>
            </a>
            <a href="{{ route('eventos.index') }}">
                <button class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-xl shadow-md">
                    Ver Eventos
                </button>
            </a>
        </div>
    </div>
</body>
</html>
