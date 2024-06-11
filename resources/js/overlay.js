// Operaciones Overlay de las imagenes de la galeria
const toggleOverlayButtons = document.querySelectorAll('.toggle-overlay');
toggleOverlayButtons.forEach(button => {
    button.addEventListener('click', function () {
        const galleryItem = button.closest('.gallery-item');
        galleryItem.classList.toggle('show-overlay');
    });
});
// Descripcion overlay de las imagenes de la galeria
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