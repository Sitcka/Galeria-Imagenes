@extends('galeria_imagenes.common.principal')
@section('title' , $galeria->titulo)
@vite('resources/js/overlay.js')
@vite('resources/js/modalGaleria.js')
<link href="
https://cdn.jsdelivr.net/npm/baguettebox.js@1.11.1/dist/baguetteBox.min.css
" rel="stylesheet">

@section('content')
<section class="container">
    <div class="operaciones">
        <ul class="nav justify-content-between">
            <h1 class="title">{{$galeria->titulo}}</h1>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="" data-bs-toggle="modal" data-bs-target="#creargaleria">
                    <i class="bi bi-plus iconos text-success"></i><i class="bi bi-image-fill iconos text-success"></i>
                </a>
            </li>
        </ul>
    </div>
    <!-- Error de suibir imagenes dupplicadas -->
    @if (session('error'))
    <div id="mensaje-error-imagenes-duplicadas" class="alert alert-warning mt-3" role="alert">
        {{ session('error') }}
    </div>
    <!-- Fin de eror de imagenes duplicadas -->
    @endif
    <!-- Agregar nuevas imagenes ya insertadas por el usuario mediante un modal -->
    <div class="modal fade" id="creargaleria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir Imagenes</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('galeria.agregarImagenes', $galeria->id)}}" method="post" id="crearGaleria">
                        @csrf
                        <div class="mb-3">
                            <label for="imagenes" class="col-form-label">Selecciona las imagenes:</label>
                            <div id="error-validacion" class="text-warning"></div>
                            <div class="row row-cols-1 row-cols-md-3 g-4">
                                @foreach(auth()->user()->imagenesOrdenadas() as $imagen)
                                <div class="col" id="imagen-perfil">
                                    <div class="card h-100">
                                        <img src="{{ asset('storage/' . $imagen->path) }}" alt="{{ $imagen->titulo }}" class="card-img-top">
                                        <div class="card-body">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="{{$imagen->id}}" name="imagenes[]">
                                                <label class="form-check-label" for="imagen{{ $imagen->id }}"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <input type="hidden" class="form-control" id="usuario_id" name="usuario_id" value="{{auth()->user()->id}}">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-dark" id="agregar-imagenes-nuevas" form="crearGaleria">Agregar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin de agregar nuevas imagenes -->
    <hr>
    <div class="row row-cols-sm-2 row-cols-md-3 row-cols-1 g-4 baguetteBoxFour gallery">
        @foreach($galeria->imagenesGaleria() as $imagen)
        <div class="col cambio-color" id="imagen-perfil">
            <div class=" show-galeria-container columna card gallery-item">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="titulo-galeria text-center">{{$imagen->titulo}}</h5>
                    <span class="toggle-overlay"><i class="bi bi-three-dots-vertical"></i></span>
                </div>
                <div class="image-container">
                    <a class="lightbox titulo-galeria" href="{{ asset('storage/' . $imagen->path) }}">
                        <img src="{{ asset('storage/' . $imagen->path) }}" alt="{{ $imagen->titulo }}" class="card-img-top img-fluid tamaño-imagenes">
                    </a>
                    <div class="description-overlay">
                        <button class="btn btn-back"><i class="bi bi-arrow-left"></i></button>
                        <div class="contenedor-descripcion">
                            <p class="description-text">{{ $imagen->descripcion }}</p>
                        </div>
                    </div>
                </div>
                <!-- Operaciones en la imagen de la galeria -->
                <div class="overlay">
                    <ul class="nav d-flex felx-direction-column justify-content-center text-center">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="" data-bs-toggle="modal" data-bs-target="#eliminarImagenGaleria" data-idGaleriaEliminar="{{$galeria->id}}" data-idImagenEliminar="{{$imagen->id}}">
                                <i class="bi bi-trash-fill iconos text-danger"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="" data-bs-toggle="modal" data-bs-target="#editarImagen" data-idGaleria="{{$galeria->id}}" data-id="{{ $imagen->id }}" data-titulo="{{ $imagen->titulo }}" data-descripcion="{{ $imagen->descripcion }}" data-fecha_subida="{{ $imagen->fecha_subida }}" data-path="{{ $imagen->path }}">
                                <i class="bi bi-pencil-square iconos text-warning"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <button class="btn p-1 text-muted view-description"><i class="bi bi-eye-fill"></i></button>
            </div>
        </div>
        @endforeach
    </div>
    <!-- Modal para editar la imagen -->
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
                            <div id="titulo-error" class="text-danger"></div>
                        </div>
                        <div class="mb-3" id="input-descripcion">
                            <label for="descripcion" class="col-form-label">Descripción:</label>
                            <input type="text" class="form-control" id="descripcion-modal" name="descripcion">
                            <div id="descripcion-error" class="text-danger"></div>
                        </div>
                        <input type="hidden" id="path-modal" name="path">
                        <input type="hidden" id="galeriaId-modal" name="galeria_id">
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

    <!-- Modal para eliminar la imagen de la galeria -->
    <div class="modal fade" id="eliminarImagenGaleria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Eliminar imágen de la galería?</p>
                    <form method="post" id="formularioEliminarImagenGaleria" action="">
                        @csrf
                        @method('delete')
                        <input type="hidden" id="imagenEliminarPivote_id" name="image_id">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" form="formularioEliminarImagenGaleria">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    @vite('resources/js/validacion-galeria.js')
    <!-- JavaScript para inicializar BaguetteBox -->
    <script src="https://cdn.jsdelivr.net/npm/baguettebox.js@1.11.1/dist/baguetteBox.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            baguetteBox.run('.baguetteBoxFour', {
                animation: 'fadeIn',
                noScrollbars: true,
                captions: function(element) {
                    return element.getElementsByTagName('img')[0].alt;
                }
            });
        });
    </script>

</section>
@endsection