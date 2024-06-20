document.addEventListener('DOMContentLoaded', () => {
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

            mostrar_imagenes_usuario.addEventListener('click', function() {
                mostrar_accion(imagenes, galerias);
            });

            mostrar_galerias_usuario.addEventListener('click', function() {
                mostrar_accion(galerias, imagenes);
            });
});