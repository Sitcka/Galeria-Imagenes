@extends('galeria_imagenes.common.principal')
@section('title', 'Inicio | Home')
@vite('resources/js/modalIndexUsuario.js')
@vite('resources/js/validacion-comentario.js')
@section('content')

<section>
    <div class="container" id="comunidad-contenedor">
        <div class="imagen-sola px-lg-5">
            <div class="row">
                @foreach($imagenes as $imagen)
                <div class="col-xl-12 col-lg-12 col-md-12 mb-12 p-3">
                    <div class="bg-white rounded shadow-sm">
                        <div class="d-flex align-items-center g-5">
                            <img img src="{{ $imagen->usuario->image_profile ? asset('storage/' . $imagen->usuario->image_profile) : asset('storage/image_profiles/defecto_usuario.png') }}" alt="Imagen de Perfil" class="imagen-usuario rounded-circle">
                            <h5 class="text-dark">{{$imagen->usuario->name}}</h5>
                        </div>
                        <img src="{{ asset('storage/' . $imagen->path) }}" alt="{{ $imagen->titulo }}" class="img-fluid card-img-top tamaño-imagenes-index" id="imagen-like">
                        <div class="p-4">
                            <h5>
                                <p class="text-dark text-start">{{ $imagen->titulo }}</p>
                            </h5>
                            <p class="small text-muted mb-2" style="word-break:break-all">{{ $imagen->descripcion }}</p>
                            <i class="bi bi-heart"></i>
                            <a href="#" class="text-dark" data-bs-toggle="modal" data-bs-target="#comentarUsuario" data-idComentarioImagen="{{ $imagen->id }}" data-tituloComentarioImagen="{{ $imagen->titulo }}" data-descripcionComentarioImagen="{{ $imagen->descripcion }}" data-comentarios="{{ $imagen->comentariosImagen()->toJson() }}" data-pathImagenComentario="{{asset('storage/' . $imagen->path)}}">
                                <i class="bi bi-chat"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- Modal para realizar un comentario y para ver estos mismos -->
            <div class="modal fade" id="comentarUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="bg-white rounded shadow-sm">
                                <img id="imagen-comentarioModal" src="" alt="" class="img-fluid card-img-top tamaño-imagenes-index">
                                <div class="p-4">
                                    <h5>
                                        <p class="text-dark text-center" id="titulo-modalComentario"></p>
                                    </h5>
                                    <p class="small text-muted mb-2" id="descripcion-modalComentario" ></p>
                                </div>
                                <hr>
                            </div>
                            <!-- Comentarios hecho por los usuarios -->
                            <div class="comentarios" id="caja-comentarios">
                            </div>
                            <!-- Fin comentarios hecho por los usuarios -->
                            <!-- Formulario para agregar comentario -->
                            <form class="formulario-comentario" id="comentario-formularioModal">
                                @csrf
                                <div class="container-fluid d-flex align-items-center justify-content-between rounded-pill bg-ligth px-2 py-1 mt-3 entrada-comentario">
                                    <textarea name="texto" id="comentario_texto" placeholder="Tu comentario aqui..."></textarea>
                                    <input type="hidden" name="imagen_id" id="id_imagenModal">
                                    <input type="hidden" name="usuario_id" value="{{ auth()->user()->id }}">
                                    <button type="submit" class="btn" name="ienviar"><i class="bi bi-send"></i></button>
                                </div>
                                <div id="mensaje-limite-caracteres" class="text-primary-emphasis mt-2"></div>
                            </form>
                            <!-- Fin de formulario para comentar -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin de ver comentario o crear uno -->
            <!-- Modal para eliminar el comentario -->
            <div class="modal fade" id="eliminarComentarioModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">¿Eliminar comentario?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>¿Estas seguro de eliminar el comentario?</p>
                            <form id="formularioEliminarComentario">
                                @csrf
                                @method('delete')
                                <input type="hidden" id="comentario_id" name="id">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-danger" id="confirmarEliminarComentario">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin de ventana modal para eliminar un comentario -->
        </div>
        <script>
            // Esta variable es para poder saber que usuario es el que esta autenticado y en base a esto, agregar un icono de 
            // eliminar al lado del comentario solamente al usuario que hizo ese comentario 
            const id_usuario_autenticado = '{{auth()->user()->id}}';
        </script>

</section>
@endsection