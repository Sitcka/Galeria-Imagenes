document.addEventListener('DOMContentLoaded', () => {
    // Mostrar Opercaiones de la galeria Eliminar/Editar
    const toggleButtons = document.querySelectorAll('.mostrar-operaciones');

    toggleButtons.forEach(button => {
        button.addEventListener('click', () => {
            const id = button.getAttribute('data-id');
            const operations = document.getElementById(`operaciones-imagen-${id}`);
            
            if (operations.classList.contains('d-none')) {
                operations.classList.remove('d-none');
                operations.classList.add('d-flex');
            } else {
                operations.classList.remove('d-flex');
                operations.classList.add('d-none');
            }
        });
    });
});