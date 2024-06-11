@extends('galeria_imagenes.common.principal')

@section('title', 'Perfil')
@vite('resources/js/modalUsuario.js')
@vite('resources/js/show-usuario.js')
<link href="
https://cdn.jsdelivr.net/npm/baguettebox.js@1.11.1/dist/baguetteBox.min.css
" rel="stylesheet">
@section('content')

<section class="container mb-5">
    <!-- Operaciones para el usuario -->
    <div class="operaciones">
        <ul class="nav justify-content-end align-items-baseline">
            <li class="nav-item">
                <a href="" data-bs-toggle="modal" data-bs-target="#creargaleria">
                    <i class="bi bi-folder-plus" id="icono"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="" data-bs-toggle="modal" data-bs-target="#añadirImagen">
                    <i class="bi bi-file-earmark-image iconos"></i>
                </a>
            </li>
        </ul>
    </div>
    <!-- Fin de operaciones para el usuario -->
    <!-- Ventana Modal para crear la Galeria -->
    <div class="modal fade" id="creargaleria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Crear Galería</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('galeria.store') }}" method="post" id="crearGaleria">
                        @csrf
                        <div class="mb-3">
                            <label for="titulo" class="col-form-label">Título:</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="col-form-label">Descripción:</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion">
                        </div>
                        <div class="mb-3">
                            <label for="imagenes" class="col-form-label">Selecciona las imágenes:</label>
                            <div class="row row-cols-1 row-cols-md-3 g-4">
                                @foreach($usuario->imagenesOrdenadas() as $imagen)
                                <div class="col" id="imagen-perfil">
                                    <div class="card h-100">
                                        <img src="{{ asset('storage/' . $imagen->path) }}" alt="{{ $imagen->titulo }}" class="card-img-top">
                                        <div class="card-body">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="{{ $imagen->id }}" name="imagenes[]">
                                                <label class="form-check-label" for="imagen{{ $imagen->id }}"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <input type="hidden" class="form-control" id="usuario_id" name="usuario_id" value="{{ auth()->user()->id }}">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" form="crearGaleria">Crear</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin de modal para crear una galeria -->
    <!-- Ventana modal para subir una imagen -->
    <div class="modal fade" id="añadirImagen" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Añadir Imagen</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('imagen.store') }}" method="post" id="añadirImagenForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="titulo" class="col-form-label">Título:</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="col-form-label">Descripción:</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion">
                        </div>
                        <div class="mb-3">
                            <label for="fecha" class="col-form-label">Fecha:</label>
                            <input type="date" class="form-control" id="fecha_subida" name="fecha_subida">
                        </div>
                        <div class="mb-3">
                            Selecciona la imagen:
                            <input type="file" class="form-control" id="path" name="path">
                        </div>
                        <input type="hidden" class="form-control" id="usuario_id" name="usuario_id" value="{{ auth()->user()->id }}">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" form="añadirImagenForm">Subir</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin ventana modal para subir imagen -->
    <br>
    <br>
    <!-- Imagenes subidas por el usuario -->
    <div class="row row-cols-sm-2 row-cols-md-3 row-cols-1 g-4 baguetteBoxFour gallery">
        @foreach($usuario->imagenesOrdenadas() as $imagen)
        <div class="col cambio-color" id="imagen-perfil">
            <div class="columna card gallery-item" id="show-usuario-container">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="card-title">{{ $imagen->titulo }}</h5>
                    <span class="toggle-overlay"><i class="bi bi-three-dots-vertical"></i></span>
                </div>
                <div class="image-container">
                    <a class="lightbox titulo-galeria" href="{{ asset('storage/' . $imagen->path) }}">
                        <img src="{{ asset('storage/' . $imagen->path) }}" alt="{{ $imagen->titulo }}" class="card-img-top img-fluid tamaño-imagenes">
                    </a>
                    <div class="description-overlay">
                        <button class="btn btn-back"><i class="bi bi-arrow-left"></i></button>
                        <p class="description-text">{{ $imagen->descripcion }}</p>
                    </div>
                </div>
                <div class="overlay">
                    <ul class="nav d-flex flex-row justify-content-center text-center">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="" data-bs-toggle="modal" data-bs-target="#eliminarImagenUsuario" data-id_imagen_usuario="{{ $imagen->id }}">
                                <i class="bi bi-trash-fill iconos text-danger"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="" data-bs-toggle="modal" data-bs-target="#editarImagen" data-id="{{ $imagen->id }}" data-titulo="{{ $imagen->titulo }}" data-descripcion="{{ $imagen->descripcion }}" data-fecha_subida="{{ $imagen->fecha_subida }}" data-path="{{ $imagen->path }}">
                                <i class="bi bi-pencil-square iconos text-warning"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <button class="btn p-1 text-muted view-description"><i class="bi bi-eye-fill"></i></button>
            </div>
        </div>
        @endforeach

        <!-- Ventana Modal para editar la imagen -->
        <div class="modal fade" id="editarImagen" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Imagen</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="formularioEditarImagen" action="">
                            @csrf
                            @method('put')
                            <div class="mb-3" id="input-titulo">
                                <label for="titulo" class="col-form-label">Título:</label>
                                <input type="text" class="form-control" id="titulo-modal" name="titulo" value="" required>
                            </div>
                            <div class="mb-3" id="input-descripcion">
                                <label for="descripcion" class="col-form-label">Descripción:</label>
                                <input type="text" class="form-control" id="descripcion-modal" name="descripcion">
                            </div>
                            <input type="hidden" class="form-control" id="fecha_subida-modal" name="fecha_subida">
                            <input type="hidden" id="path-modal" name="path">
                            <input type="hidden" id=" " name="es" value="usuario">
                            <input type="hidden" class="form-control" id="usuario_id" name="usuario_id" value="{{auth()->user()->id}}">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-dark" form="formularioEditarImagen">Editar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin Ventana Modal editar Imagen -->
        <!-- Ventana Modal para eliminar la imagen subida por el usuario -->
        <div class="modal fade" id="eliminarImagenUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>¿Desea eliminar la imágen?</p>
                        <form method="post" id="formularioEliminarImagenUsuario" action="">
                            @csrf
                            @method('delete')
                            <input type="hidden" id="imagen_usuario_id" name="image_id">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" form="formularioEliminarImagenUsuario">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin de ventana modal para eliminar la imagen -->
        <!-- Galerias creadas por el usuario -->
        @foreach($usuario->galeriasOrdenadas() as $galeria)
        <div class="col cambio-color" id="es-galeria">
            <div class="card gallery-item columna" id="show-usuario-container">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title" id="titulo-galeria">{{ $galeria->titulo }}</h5>
                        <span class="toggle-overlay d-flex flex-column align-items-center"><i class="bi bi-three-dots-vertical"></i></span>
                    </div>
                    <div id="carrusel-usuario-galeria{{$galeria->id}}" class="carousel slide image-container" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @php
                            $contador = 0;
                            @endphp
                            @forelse($galeria->imagenesGaleria() as $imagen)
                            @if ($contador == 0)
                            <div class="carousel-item active">
                                <a href="{{route('galeria.show', $galeria->id)}}">
                                    <img src="{{ asset('storage/' . $imagen->path) }}" class="d-block w-100" alt="{{ $imagen->titulo }}" style="height: 250px; object-fit: cover;">
                                </a>
                            </div>
                            @else
                            <div class="carousel-item">
                                <a href="{{ route('galeria.show', $galeria->id) }}">
                                    <img src="{{ asset('storage/' . $imagen->path) }}" class="d-block w-100" alt="{{ $imagen->titulo }}" style="height: 250px; object-fit: cover;">
                                </a>
                            </div>
                            @endif
                            @php
                            $contador++;
                            @endphp
                            @empty
                            <div id="galeria-vacia">
                                <a href="{{ route('galeria.show', $galeria->id) }}">
                                    <i class="bi bi-plus-circle añadir-imagen"></i>
                                </a>
                            </div>
                            @endforelse
                        </div>
                        <div class="description-overlay">
                            <button class="btn btn-back"><i class="bi bi-arrow-left"></i></button>
                            <p class="description-text">{{ $imagen->descripcion }}</p>
                        </div>
                    </div>
                    <div class="overlay">
                        <ul class="nav d-flex flex-row justify-content-center text-center">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="" data-bs-toggle="modal" data-bs-target="#eliminarGaleriaUsuario" data-id_galeria_usuario="{{$galeria->id}}">
                                    <i class="bi bi-trash-fill iconos text-danger"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="" data-bs-toggle="modal" data-bs-target="#editarGaleria" data-idGaleria="{{$galeria->id}}" data-tituloGaleria="{{$galeria->titulo}}" data-descripcionGaleria="{{$galeria->descripcion}}">
                                    <i class="bi bi-pencil-square iconos text-warning"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <button style="margin-left: 45%;" class="btn p-1 text-muted view-description"><i class="bi bi-eye-fill"></i></button>
                </div>
            </div>
        </div>
        @endforeach
        <!-- Fin de galerias creadas por el Usuario -->
        <!-- Ventana Modal para editar la galeria creda por el usuario -->
        <div class="modal fade" id="editarGaleria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Galeria</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="formularioEditarGaleria" action="">
                            @csrf
                            @method('put')
                            <div class="mb-3" id="input-titulo">
                                <label for="titulo" class="col-form-label">Título:</label>
                                <input type="text" class="form-control" id="titulo-galeria_modal" name="titulo" value="" required>
                            </div>
                            <div class="mb-3" id="input-descripcion">
                                <label for="descripcion" class="col-form-label">Descripción:</label>
                                <input type="text" class="form-control" id="descripcion-galeria_modal" name="descripcion">
                            </div>
                            <input type="hidden" class="form-control" id="usuario_id" name="usuario_id" value="{{auth()->user()->id}}">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-dark" form="formularioEditarGaleria">Editar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin Modal editar galeria -->
        <!-- Ventana Modal para eliminar la galeria creada por el usuario -->
        <div class="modal fade" id="eliminarGaleriaUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>¿Desea eliminar la galeria?</p>
                        <form method="post" id="formularioEliminarGaleriaUsuario" action="">
                            @csrf
                            @method('delete')
                            <input type="hidden" id="galeria_usuario_id" name="id">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" form="formularioEliminarGaleriaUsuario">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin de Modal eliminar galeria -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/baguettebox.js@1.11.1/dist/baguetteBox.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            baguetteBox.run('.baguetteBoxFour', {
                buttons: false,
                captions: function(element) {
                    return element.getElementsByTagName('img')[0].alt;
                }
            });
        });
    </script>
</section>
@endsection