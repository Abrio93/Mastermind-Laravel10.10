<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mastermind')</title>

    {{--* CSS --}}
    {{--? Estilos personalizados  --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{--? Bootstrap 5.3.3 (CDN)  --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    {{--? DataTables 2.2.2 --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">

    {{--* JS --}}
    {{--? JQuery 3.7.1 --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    {{--? Bootstrap 5.3.3 (CDN)  --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    {{--? Sweet Alert 2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{--?  DataTables 2.2.2 --}}
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    {{--?  DataTables 2.2.2 --}}
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.dataTables.min.js"></script>
    {{--? Estilos personalizados de js (en este caso solo para utilizar data table) --}}
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body class="d-flex flex-column min-vh-100" style="background-color: #E5E7EB;">

    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('inicio') }}">Inicio</a>
            <a class="navbar-brand" href="{{ route('juego') }}">Juego</a>
            <a class="navbar-brand" href="{{ route('listapartidas') }}">Lista de partidas</a>
            <a class="navbar-brand" href="{{ route('reglas') }}">Reglas</a>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content') <!-- Aquí va el contenido de cada vista -->
    </div>

    <footer class="bg-dark text-white text-center p-3 mt-auto">
        &copy; {{ date('Y') }} - Ismael Abrio González
    </footer>
</body>

</html>