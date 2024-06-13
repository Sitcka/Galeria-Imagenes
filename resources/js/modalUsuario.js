// Evento para mostrar galerias e imagenes
const mostrar_imagenes_usuario = document.getElementById('mostrar-imagenes');
const mostrar_galerias_usuario = document.getElementById('mostrar-galerias');
const imagenes = document.querySelectorAll('.es-imagen-usuario');
const galerias = document.querySelectorAll('.es-galeria-usuario');

function mostrar_accion(mostrar, ocultar) {
    ocultar.forEach(elementos => {
        elementos.style.display = 'none';
    });

    mostrar.forEach(elementos => {
        elementos.style.display = 'block';
        elementos.classList.add('fade-in');
    });
}

mostrar_imagenes_usuario.addEventListener('click', function (event) {
    event.preventDefault();
    mostrar_accion(imagenes, galerias);
});

mostrar_galerias_usuario.addEventListener('click', function (event) {
    event.preventDefault();
    mostrar_accion(galerias, imagenes);
});

// Overlay de operaciones
const toggleOverlayButtons = document.querySelectorAll('.toggle-overlay');
toggleOverlayButtons.forEach(button => {
    button.addEventListener('click', function () {
        const galleryItem = button.closest('.gallery-item');
        galleryItem.classList.toggle('show-overlay');
    });
});

// Descripcion overlay
const viewButtons = document.querySelectorAll('.view-description');
const backButtons = document.querySelectorAll('.btn-back');

viewButtons.forEach(button => {
    button.addEventListener('click', function (event) {
        event.preventDefault();
        const card = this.closest('.card');
        const imageContainer = card.querySelector('.image-container');
        imageContainer.classList.add('rotated');
    });
});

backButtons.forEach(button => {
    button.addEventListener('click', function (event) {
        event.preventDefault();
        const imageContainer = this.closest('.image-container');
        imageContainer.classList.remove('rotated');
    });
});

backButtons.forEach(button => {
    button.addEventListener('click', function (event) {
        event.preventDefault();
        const overlay = this.closest('.description-overlay');
        overlay.classList.remove('show');
    });
});

// Evento para pasar informacion al editar la imagen del show del usuario
let editarImagenModal = document.getElementById('editarImagen');
let form = document.getElementById('formularioEditarImagen');
let modalTitulo = document.getElementById('titulo-modal');
let modalDescripcion = document.getElementById('descripcion-modal');
let modalPath = document.getElementById('path-modal');
editarImagenModal.addEventListener('show.bs.modal', function (event) {
    let editar = event.relatedTarget;
    let id = editar.getAttribute('data-id');
    let id_galeria = editar.getAttribute('data-idGaleria');
    let titulo = editar.getAttribute('data-titulo');
    let descripcion = editar.getAttribute('data-descripcion');
    let path = editar.getAttribute('data-path');
    form.action = `/imagen/${id}`;
    modalTitulo.value = titulo;
    modalDescripcion.value = descripcion;
    modalPath.value = path;
});

// Evento para eliminar una imagen subida por el usuario
let eliminarImagenModalUsuario = document.getElementById('eliminarImagenUsuario');
let formEliminarUsuario = document.getElementById('formularioEliminarImagenUsuario');
let imagen_usuario_id = document.getElementById('imagen_usuario_id');
eliminarImagenModalUsuario.addEventListener('show.bs.modal', function (event) {
    let eliminarImagen = event.relatedTarget;
    let imagen_usuario_id_valor = eliminarImagen.getAttribute('data-id_imagen_usuario');
    formEliminarUsuario.action = `/imagen/${imagen_usuario_id_valor}`;
    imagen_usuario_id.value = imagen_usuario_id_valor;
});

// Evento para eliminar una galeria creada por el usuario
let editarGaleriaModal = document.getElementById('editarGaleria');
let formularioEditarGaleria = document.getElementById('formularioEditarGaleria');
let modalGaleriaTitulo = document.getElementById('titulo-galeria_modal');
let modalGaleriaDescripcion = document.getElementById('descripcion-galeria_modal');
editarGaleriaModal.addEventListener('show.bs.modal', function (event) {
    let editar = event.relatedTarget;
    let id_galeria = editar.getAttribute('data-idGaleria');
    let titulo = editar.getAttribute('data-tituloGaleria');
    let descripcion = editar.getAttribute('data-descripcionGaleria');
    formularioEditarGaleria.action = `/galeria/${id_galeria}`;
    modalGaleriaTitulo.value = titulo;
    modalGaleriaDescripcion.value = descripcion;
});
// Evento para ediar una galeria creada por el usuario
let eliminarGaleriaModalUsuario = document.getElementById('eliminarGaleriaUsuario');
let formEliminarGaleriaUsuario = document.getElementById('formularioEliminarGaleriaUsuario');
let galeria_usuario_id = document.getElementById('galeria_usuario_id');
eliminarGaleriaModalUsuario.addEventListener('show.bs.modal', function (event) {
    let eliminarImagen = event.relatedTarget;
    let galeria_usuario_id_valor = eliminarImagen.getAttribute('data-id_galeria_usuario');
    formEliminarGaleriaUsuario.action = `/galeria/${galeria_usuario_id_valor}`;
});

// Evento para eliminar las flechas del carrusel 
var carousel = new bootstrap.Carousel(document.getElementById('carrusel-usuario-galeria{{$galeria->id}}'), {
    interval: 500,
    wrap: true
});

// Oculta las flechas de carrusel
var control_carrusel = document.querySelectorAll('.carousel-control');
control_carrusel.forEach(function (control) {
    control.style.display = 'none';
});
