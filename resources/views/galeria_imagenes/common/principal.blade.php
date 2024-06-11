<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>@yield('title', 'Inicio')</title>
    @vite('/resources/css/app.css')
    @vite('/resources/css/galeria.css')
    @vite('resources/js/app.js')
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top" id="navegacion">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#"><i class="text-white bi bi-person-circle"></i><span id="nombre-usuario" class="text-white"> &nbsp;{{ auth()->user()->name }}</span></a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <i class="bi bi-list navbar-toggler-icon text-white"></i>
            </button>
            <div class="collapse navbar-collapse flex justify-between" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active text-white" aria-current="page" href="{{ route('imagen.index') }}">Comunidad</a></li>
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0 ms-lg-4 order-lg-last">
                    <li class="nav-item dropdown">
                        <a class="text-white nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-gear-fill text-white"></i></a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('usuario.show', auth()->user()->id) }}">Perfil</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="{{ route('galeria_imagenes.usuario.edit', auth()->user()->id) }}">Configuracion</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item" href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"><i class="bi bi-box-arrow-right"></i>&nbsp;<span>Cerrar sesión</span></a>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </>
    </nav>
    @yield('content')
</body>

</html>