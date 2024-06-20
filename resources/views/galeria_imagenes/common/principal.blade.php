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
            <a class="navbar-brand" href=""><span id="nombre-usuario" class="text-white"> L5V</span></a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <i class="bi bi-list navbar-toggler-icon text-white"></i>
            </button>
            <div class="collapse navbar-collapse flex justify-between" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    @if(auth()->user()->type === 'premium')
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="{{ route('imagen.index') }}">Comunidad</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="text-white nav-link " href="" id="comunidad-link" data-bs-toggle="modal" data-bs-target="#actualizarPremium">
                            Comunidad<i class="bi bi-lock"></i>
                        </a>
                    </li>
                    @endif
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0 ms-lg-4 order-lg-last">
                    <li class="nav-item dropdown d-flex align-items-center">
                        <a href="{{ route('usuario.show', auth()->user()->id) }}"> <img img src="{{ auth()->user()->image_profile ? asset('storage/' .auth()->user()->image_profile) : asset('storage/image_profiles/defecto_usuario.png') }}" alt="Imagen de Perfil" class="imagen-usuario-navegacion rounded-circle"></a>
                        <a class="text-white nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"></a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
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
    <!-- Modal para convertir usuario a premium -->
    <div class="modal fade" id="actualizarPremium" tabindex="-1" aria-labelledby="upgradeToPremiumModalLabel" aria-hidden="true" style="padding:200px;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="upgradeToPremiumModalLabel">¡Hazte Premium!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-3 text-large">
                    <h3 class="modal-title"> ¿Aún no eres premium?</h3>
                    <h5 class="modal-title">¡Ahora es el momento!</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <form action="{{route('user.actualizarPremium')}}" method="POST" id="upgradeForm">
                        @csrf
                        <button type="submit" class="btn btn-dark">Premium</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin de Modal para convertirse en premium -->
    @yield('content')
</body>

</html>