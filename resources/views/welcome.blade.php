<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>L5V</title>
    @vite('/resources/css/app.css')
    @vite('/resources/css/welcome.css')
    @vite('resources/js/app.js')
</head>

<body>
    <header>
        @if (Route::has('login'))
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="navegacion">
            <div class="container">
                <div class="navbar-brand text-white">
                    <h1>L5V</h1>
                </div>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="bi bi-list navbar-toggler-icon text-white"></i>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        @auth
                        @if(auth()->user()->type === 'premium')
                        <li class="nav-item">
                            <a class="nav-link active text-white" href="{{ url('imagen/') }}">Galeria</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="text-white nav-link " href="{{route('usuario.show',auth()->user()->id)}}">Galeria</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link text-white">Iniciar Sesion</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link text-white">Registrarse</a>
                        </li>
                        @endif
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
        @endif
    </header>
    <section class="seccion-estilo">
        <div class="experiencia seccion-clara container-fluid mt-5 card border-0 shadow-lg p-5 align-items-center">
            <div class="row d-flex justify-content-center">
                <div class="columna col-12 mb-3 card border-0">
                    <div>
                        <div class="d-flex justify-content-start align-items-center">
                            <i class="bi bi-people-fill"></i>
                            <p class="experiencia-titulo mx-2">Comunidad</p>
                        </div>
                        <p>Compartir imágenes con otras personas es una forma instantánea de conectar y expresar momentos especiales. Desde celebraciones hasta paisajes impresionantes, cada imagen compartida cuenta una historia única y crea lazos emocionales entre amigos y familiares alrededor del mundo. </p>
                    </div>
                    <div class="imagen-contenedor">
                        <img src="{{asset('images/comunidad.jpg')}}" alt="Comunidad" class="img-fluid rounded-end rounded-start">
                    </div>
                </div>
                <div class="columna col-12 mb-3 card border-0">
                    <div>
                        <div class="d-flex justify-content-start align-items-center">
                            <i class="bi bi-columns-gap"></i>
                            <p class="experiencia-titulo mx-2">Galeria</p>
                        </div>
                        <p>Crea galerías de imágenes online para compartir y organizar tus momentos favoritos de manera visualmente atractiva y accesible desde cualquier dispositivo. Comparte tus experiencias con amigos y familiares en galerías personalizadas que reflejen tu estilo único y tus memorias más preciadas.</p>
                    </div>
                    <div class="imagen-contenedor">
                        <img src="{{asset('images/galeria_imagenes.jpg')}}" alt="Galeria imagenes" class="img-fluid rounded-end rounded-start">
                    </div>
                </div>
                <div class="columna col-12 mb-3 card border-0">
                    <div>
                        <div class="d-flex justify-content-start align-items-center">
                            <i class="bi bi-images"></i>
                            <p class="experiencia-titulo mx-2">Imagenes</p>
                        </div>
                        <p>Subir imágenes online te permite almacenar y compartir tus fotos de manera rápida y sencilla. Mantén tus recuerdos seguros y accesibles desde cualquier dispositivo, y comparte tus momentos favoritos con amigos y familiares al instante.</p>
                    </div>
                    <div class="imagen-contenedor">
                        <img src="{{asset('images/subir_imagen.jpg')}}" alt="Subir imagen" class="img-fluid rounded-end rounded-start">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="testimonios" class="testimonios seccion-clara seccion-estilo card border-0 shadow-lg p-5">
        <h2 class="seccion-titulo">Testimonios</h2>
        <h3 class="seccion-descripcion">Estos son algunos testimonios de mis clientes...</h3>

        <!-- Carrusel de experiencias de usuario -->
        <div id="testimonios-carrusel" class="carousel carousel-dark slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container">
                        <img class="testimonio-imagen rounded-circle" src="{{asset('images/cliente1.svg')}}" alt="Foto de Gino">
                        <p class="testimonio-texto">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vel iaculis urna. Fusce a ornare enim, vel interdum turpis. Sed aliquam interdum nisi a placerat.</p>
                        <div class="testimonio-info">
                            <p class="cliente">Gino</p>
                            <p class="cargo">Gerente de proyectos en DesarrolloWeb</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container">
                        <img class="testimonio-imagen rounded-circle" src="{{asset('images/cliente2.svg')}}" alt="Foto de Nora">
                        <p class="testimonio-texto">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vel iaculis urna. Fusce a ornare enim, vel interdum turpis. Sed aliquam interdum nisi a placerat.</p>
                        <div class="testimonio-info">
                            <p class="cliente">Nora</p>
                            <p class="cargo">Gerente de DiseñaMiPáginaWeb</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container">
                        <img class="testimonio-imagen rounded-circle" src="{{asset('images/cliente3.svg')}}" alt="Foto de Leonardo">
                        <p class="testimonio-texto">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vel iaculis urna. Fusce a ornare enim, vel interdum turpis. Sed aliquam interdum nisi a placerat.</p>
                        <div class="testimonio-info">
                            <p class="cliente">Leonardo</p>
                            <p class="cargo">Director de AprendeAProgramar</p>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#testimonios-carrusel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#testimonios-carrusel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
        <!-- Fin de Carrusel de experiencias de usuario -->
    </section>

    <!-- Footer  -->
    <footer class="seccion-oscura d-flex flex-column align-items-center justify-content-center">
        <h1 class="text-white">L5V</h1>
        <div class="iconos-redes-sociales d-flex flex-wrap align-items-center justify-content-center">
            <a href="https://x.com/iniciarsesion?lang=es" target="_blank" rel="noopener noreferrer">
                <i class="bi bi-twitter"></i>
            </a>
            <a href="https://github.com/Sitcka" target="_blank" rel="noopener noreferrer">
                <i class="bi bi-github"></i>
            </a>
            <a href="https://www.linkedin.com/in/josep-pinos-5b5314174/" target="_blank" rel="noopener noreferrer">
                <i class="bi bi-linkedin"></i>
            </a>
            <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer">
                <i class="bi bi-instagram"></i>
            </a>
            <a href="mailto:janedoe@micorreo.com" target="_blank" rel="noopener noreferrer">
                <i class="bi bi-envelope"></i>
            </a>
        </div>
        <div class="derechos-de-autor"> Proyecto Final DAW (2024) | Todos los derechos reservados &#169;</div>
    </footer>
    <!-- Fin de footer -->
</body>

</html>