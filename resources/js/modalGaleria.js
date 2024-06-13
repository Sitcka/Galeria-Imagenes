// Javascript de bootstrap para uso del modal
// Modal
const exampleModal = document.getElementById('creargaleria');
if (exampleModal) {
    exampleModal.addEventListener('show.bs.modal', event => {
        // Button that triggered the modal
        const button = event.relatedTarget;
        // Extract info from data-bs-* attributes if necessary
        const recipient = button.getAttribute('data-bs-whatever');

        // Update the modal's content if needed
        const modalTitle = exampleModal.querySelector('.modal-title');
        const modalBodyInput = exampleModal.querySelector('.modal-body input');

        // Update the title and input if recipient data is available
        if (recipient) {
            modalTitle.textContent = `New message to ${recipient}`;
            modalBodyInput.value = recipient;
        }
    });
}

// Evento para pasar informacion al editar la imagen de la galeria
let editarImagenModal = document.getElementById('editarImagen');
let form = document.getElementById('formularioEditarImagen');
let modalTitulo = document.getElementById('titulo-modal');
let modalDescripcion = document.getElementById('descripcion-modal');
let modalPath = document.getElementById('path-modal');
let modalIdGaleria = document.getElementById('galeriaId-modal');
editarImagenModal.addEventListener('show.bs.modal', function (event) {
    let editar = event.relatedTarget;
    let id = editar.getAttribute('data-id');
    let id_galeria = editar.getAttribute('data-idGaleria');
    let titulo = editar.getAttribute('data-titulo');
    let descripcion = editar.getAttribute('data-descripcion');
    let path = editar.getAttribute('data-path');
    form.action = `/imagen/${id}/editarImagenGaleria`;
    modalTitulo.value = titulo;
    modalDescripcion.value = descripcion;
    modalPath.value = path;
    modalIdGaleria.value = id_galeria
});

// Evento para pasar el id de galeria y de imagen de la tabla pivote, para poder eliminar una imagen de la galeria
let eliminarImagenModal = document.getElementById('eliminarImagenGaleria');
let formEliminar = document.getElementById('formularioEliminarImagenGaleria');
let imagenEliminarPivote_id = document.getElementById('imagenEliminarPivote_id');
eliminarImagenModal.addEventListener('show.bs.modal', function (event) {
    let eliminar = event.relatedTarget;
    let galery_id_eliminar = eliminar.getAttribute('data-idGaleriaEliminar');
    let iamge_id_eliminar = eliminar.getAttribute('data-idImagenEliminar');
    formEliminar.action = `/galeria/${galery_id_eliminar}/eliminarImagen`;
    imagenEliminarPivote_id.value = iamge_id_eliminar;

});