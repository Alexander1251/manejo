<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Examinadora</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield('css')
    @livewireStyles

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="\">Examinadora</a>
            <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @auth


                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page"
                                    href="\">Inicio</a>
                    </li>
                    @if (Auth::user()->id_rol == 1)
<li class="nav-item
                                    dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Catálogos
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ Route('usuarios.index') }}">Usuarios</a></li>
                                        <li><a class="dropdown-item" href="{{ Route('roles.index') }}">Roles</a></li>
                                        <li><a class="dropdown-item" href="{{ Route('escuelas.index') }}">Escuelas</a></li>
                                        <li><a class="dropdown-item" href="{{ Route('categorias.index') }}">Categorías
                                                teórico</a></li>
                                        <li><a class="dropdown-item"
                                                href="{{ Route('practico-categorias.index') }}">Categorías práctico</a></li>
                                        <li><a class="dropdown-item" href="{{ Route('preguntas.index') }}">Preguntas
                                                teórico</a></li>
                                        <li><a class="dropdown-item"
                                                href="{{ Route('practico-preguntas.index') }}">Preguntas práctico</a></li>
                                        <li><a class="dropdown-item" href="{{ Route('tramite-clases.index') }}">Trámites</a>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ Route('licencia-tipos.index') }}">Tipos de
                                                licencia</a></li>
                                        <li><a class="dropdown-item"
                                                href="{{ Route('examen-configuraciones.index') }}">Formatos de examen</a>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ Route('empresa-datos.index') }}">Datos de la
                                                empresa</a></li>
                                        <li><a class="dropdown-item" href="{{ Route('gastos.index') }}">Gastos</a></li>
                                        <li><a class="dropdown-item" href="{{ Route('ingresos.index') }}">Ingresos</a></li>
                                    </ul>
                            </li>
                            @endif

                            @if (Auth::user()->id_rol == 1 || Auth::user()->id_rol == 4)
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page"
                                        href="{{ Route('expedientes.index') }}">Expediente</a>
                                </li>
                            @endif


                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Exámenes
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <a class="dropdown-item" aria-current="page"
                                            href="{{ Route('examenes.index') }}">Examen teórico</a>
                                    </li>
                                    @if (Auth::user()->id_rol != 2)
                                        <li class="nav-item">
                                            <a class="dropdown-item" aria-current="page"
                                                href="{{ Route('prueba-practica.index') }}">Examen práctico</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="dropdown-item" aria-current="page"
                                                href="{{ Route('visuales.index') }}">Examen visual</a>
                                        </li>
                                    @endif
                                </ul>


                            </li>






                            @if (Auth::user()->id_rol == 1)
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page"
                                        href="{{ Route('detalle-gastos.index') }}">Registrar gastos</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page"
                                        href="{{ Route('detalle-ingresos.index') }}">Registrar ingresos</a>
                                </li>
                            @endif

                            @if (Auth::user()->id_rol == 1)
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Reportes
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ Route('reporte-diario.index') }}">Reporte
                                                diario</a></li>
                                        <li><a class="dropdown-item" href="{{ Route('flujo-efectivo.index') }}">Flujo
                                                efectivo</a></li>
                                        <li><a class="dropdown-item" href="{{ Route('reporte-gastos.index') }}">Reporte gastos</a></li>
                                        <li><a class="dropdown-item" href="{{ Route('reporte-ingresos.index') }}">Reporte ingresos</a></li>
                                        <li><a class="dropdown-item" href="{{ Route('detalle-gastos-reporte.index') }}">Detalle gastos</a></li>
                                        <li><a class="dropdown-item" href="{{ Route('detalle-ingresos-reporte.index') }}">Detalle ingresos</a></li>
                                        <li><a class="dropdown-item" href="{{ Route('reporte-resultados.index') }}">Resultados</a></li>
                                       
                                    </ul>


                                </li>
                            @endif


                        @endauth

                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->usuario }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar sesión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
        </div>
    </nav>
    <main class="py-4">
        @yield('content')
    </main>

    @yield('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    @livewireScripts
</body>

</html>
