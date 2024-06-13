let comentarUsuarioModal = document.getElementById('comentarUsuario');
let imagen_modalComentario = document.getElementById('imagen-comentarioModal');
let titulo_modalComentario = document.getElementById('titulo-modalComentario');
let descripcion_modalComentario = document.getElementById('descripcion-modalComentario');
let imagen_idComentar = document.getElementById('id_imagenModal');
let caja_comentariosContenedor = document.getElementById('caja-comentarios');

document.addEventListener('show.bs.modal', function (event) {
    if (event.target.id === 'comentarUsuario') {
        let boton = event.relatedTarget;
        let imagen_idComentario = boton.getAttribute('data-idComentarioImagen');
        let imagen_tituloComentario = boton.getAttribute('data-tituloComentarioImagen');
        let imagen_pathComentario = boton.getAttribute('data-pathImagenComentario');
        let imagen_descripcionComentarioImagen = boton.getAttribute('data-descripcionComentarioImagen');

        imagen_modalComentario.src = imagen_pathComentario;
        imagen_modalComentario.alt = imagen_tituloComentario;
        titulo_modalComentario.textContent = imagen_tituloComentario;
        descripcion_modalComentario.textContent = imagen_descripcionComentarioImagen;
        // Para el formulario de comentar imagen
        imagen_idComentar.value = imagen_idComentario;
        // Caja de comentarios
        cargarComentariosActualizados(imagen_idComentario);
    }
});

// Esto es para crear de manera dinámica un comentario, al momento de crear el comentario se verá reflejado en la caja de comentarios
let formulario_comentario = document.getElementById('comentario-formularioModal');
formulario_comentario.addEventListener('submit', function (event) {
    event.preventDefault();
    const formData = new FormData(this);
    fetch(`/comentario`, {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            let caja_vacia = document.getElementById('caja-vacia');
            if (caja_vacia) {
                caja_vacia.remove();
            }
            crearComentario(caja_comentariosContenedor, data);
            // Limpia el formulario, es decir el campo donde se realiza el comentario
            this.reset();
        })
        .catch(error => console.error('Error:', error));
});

let confirmarEliminar = document.getElementById('confirmarEliminarComentario');
confirmarEliminar.addEventListener('click', function () {
    let comentarioId = document.getElementById('comentario_id').value;
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(`/comentario/${comentarioId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': token
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Eliminar el comentario del DOM
                let comentarioEliminar = document.getElementById(comentarioId);
                if (comentarioEliminar) {
                    comentarioEliminar.classList.add('eliminar-animacion');
                    setTimeout(() => {
                        comentarioEliminar.remove();
                        cargarComentariosActualizados(imagen_idComentar.value);
                    }, 500);
                }
                // Cerrar el modal
                let eliminarComentarioModal = bootstrap.Modal.getInstance(document.getElementById('eliminarComentarioModal'));
                eliminarComentarioModal.hide();
            } else {
                console.error('Error eliminando el comentario:', data.message);
            }
        })
        .catch(error => console.error('Error:', error));
});

// Funciones cargar los comentarios
function crearComentario(contenedor, response) {
    // Div para almacenar toda la informacion del comentario
    let contenedor_all = document.createElement('div');
    contenedor_all.id = response.id;
    // Div para el comentario
    let contenedor_texto_comentario = document.createElement('div');
    let icono_eliminar = document.createElement('i');
    // 
    let añadirNombreUsuario = document.createElement('span');
    let añadirTexto = document.createElement('p');
    let añadirFechaCreacion = document.createElement('p');
    let fechaCreacion = new Date(response.created_at).toLocaleDateString('es-ES');
    // Añadir contenido a cada elemento
    añadirNombreUsuario.innerText = response.usuario.name;
    añadirTexto.innerText = response.texto;
    añadirFechaCreacion.innerText = fechaCreacion;
    // Añadir clases de bootsrap a cada elemento
    añadirNombreUsuario.classList.add("text-dark", "m-0");
    añadirTexto.classList.add("text-muted", "m-0", "small", 'comentario-opcion');
    icono_eliminar.classList.add("bi", "bi-trash-fill", "text-ligth");
    añadirFechaCreacion.classList.add("text-muted", "small", "mb-2");
    contenedor_texto_comentario.id = "contenedor-texto-comentario";
    // Agregar cada elemento al contenedor all
    contenedor_all.appendChild(añadirNombreUsuario);
    contenedor_all.appendChild(contenedor_texto_comentario);
    contenedor_all.appendChild(añadirFechaCreacion);
    // Agregar el elemento al contenedor del comentario
    contenedor_texto_comentario.appendChild(añadirTexto);
    if (response.usuario.id == id_usuario_autenticado) {
        contenedor_texto_comentario.appendChild(icono_eliminar);
    }
    // Almacenamos el contenedor all
    contenedor.appendChild(contenedor_all);
    // Evento para que cambie de color el icono
    icono_eliminar.addEventListener('mouseenter', (e) => {
        icono_eliminar.classList.remove('text-muted');
        icono_eliminar.classList.add('text-danger');
    });
    icono_eliminar.addEventListener('mouseleave', (e) => {
        icono_eliminar.classList.remove('text-danger');
        icono_eliminar.classList.add('text-muted');
    });
    // Para que envie la informacion al modal
    icono_eliminar.addEventListener('click', function (e) {
        let eliminarComentarioModal = new bootstrap.Modal(document.getElementById('eliminarComentarioModal'));
        document.getElementById('comentario_id').value = response.id;
        eliminarComentarioModal.show();
    });
}

function cargarComentariosActualizados(imagen_idComentario) {
    fetch(`/comentario/${imagen_idComentario}/comentariosImagen`)
        .then(response => response.json())
        .then(data => {
            caja_comentariosContenedor.innerHTML = '';
            if (data.length > 0) {
                data.forEach(comentario => {
                    crearComentario(caja_comentariosContenedor, comentario);
                });
            } else {
                caja_comentariosContenedor.innerHTML = `<p class="text-center text-muted mb-2" id="caja-vacia">Sé el primero en comentar</p>`;
            }
        })
        .catch(error => console.error('Error:', error));
}
