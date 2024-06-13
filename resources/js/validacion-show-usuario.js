document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('crearGaleria').addEventListener('submit', function (event) {
        event.preventDefault();

        let tituloError = this.querySelector('#tituloError');
        let descripcionError = this.querySelector('#descripcionError');
        tituloError.textContent = '';
        descripcionError.textContent = '';

        // Valores de los input
        let titulo = this.querySelector('#titulo').value;
        let descripcion = this.querySelector('#descripcion').value;

        // Validacion con expresiones regulares
        let tituloValido = /^[a-zA-Z0-9.,()" ]{1,30}$/.test(titulo);
        let descripcionValida = /^[a-zA-Z0-9.,()" ]{0,100}$/.test(descripcion);

        if (!tituloValido) {
            this.querySelector('#titulo').classList.add('is-invalid');
            tituloError.textContent = 'El título debe tener como maximo 30 caracteres y puede contener letras, numeros, espaciados, comillas, coma, parentesis y el punto.';
        } else {
            this.querySelector('#titulo').classList.remove('is-invalid');
            this.querySelector('#titulo').classList.add('is-valid');
        }

        if (!descripcionValida) {
            this.querySelector('#descripcion').classList.add('is-invalid');
            descripcionError.textContent = 'La descripción debe tener como maximo 60 caracteres y puede contener letras, numeros, espaciados, comillas, coma, parentesis y el punto.';
        } else {
            this.querySelector('#descripcion').classList.remove('is-invalid');
            this.querySelector('#descripcion').classList.remove('is-valid');
        }

        // Si todo sale bien se podra enviar el formulario
        if (tituloValido && descripcionValida) {
            this.submit();
        }
    });


    // Validacion para subir una imagen 
    document.getElementById('añadirImagenForm').addEventListener('submit', function (event) {
        event.preventDefault();

        let titulo_error = this.querySelector('#titulo-error');
        let descripcion_error = this.querySelector('#descripcion-error');
        let pathError = this.querySelector('#pathError');
        titulo_error.textContent = '';
        descripcion_error.textContent = '';
        pathError.textContent = '';

        // Obtengo el value de cada input para despues evaluarlos 
        // A los inputs no se contaran los espacios en blanco
        let titulo_subir_imagen = this.querySelector('#titulo').value.trim();
        let descripcion = this.querySelector('#descripcion').value.trim();
        // De esta manera obtengo la imagen del formulario
        let path = this.querySelector('#path').files[0];

        // Veo si hay algun error con la validacion de los inputs
        let titulo_valido_subir_imagen = /^[a-zA-Z0-9.,()" ]{1,30}$/.test(titulo_subir_imagen);
        let descripcionValida = /^[a-zA-Z0-9.,()" ]{0,100}$/.test(descripcion);

        if (!titulo_valido_subir_imagen) {
            this.querySelector('#titulo').classList.add('is-invalid');
            titulo_error.textContent = 'El titulo debe tener como maximo 30 caracteres y solo puede contener letras, numeros, comas, puntos, parentesis y espaciados.';
        } else {
            this.querySelector('#titulo').classList.remove('is-invalid');
            this.querySelector('#titulo').classList.add('is-valid');
        }

        if (!descripcionValida) {
            this.querySelector('#descripcion').classList.add('is-invalid');
            descripcion_error.textContent = 'La descripcion puede tener como maximo 100 caracteres y solo puede contener letras mayusculas o minusculas, numeros, comas, puntos, parentesis y espaciados.';
        } else {
            this.querySelector('#descripcion').classList.remove('is-invalid');
            this.querySelector('#descripcion').classList.add('is-valid');
        }

        // Validar imagen del usuario
        let extensiones_validas = ['jpg', 'jpeg', 'png', 'svg'];

        if (!path) {
            this.querySelector('#path').classList.add('is-invalid');
            pathError.textContent = 'Asegurese de seleccionar alguna imagen.';
        } else {
            this.querySelector('#path').classList.remove('is-invalid');
            let tamañoImagen = path.size / 1024;
            let extension_imagen = path.name.split('.').pop().toLowerCase();

            if (tamañoImagen > 1100) {
                this.querySelector('#path').classList.add('is-invalid');
                pathError.textContent = 'La imagen no puede superar los 1100 KB.';
            } else if (extensiones_validas.indexOf(extension_imagen) === -1) {
                this.querySelector('#path').classList.add('is-invalid');
                pathError.textContent = 'Solo se permiten imagenes con extensiones jpg, jpeg, png o svg.';
            }
        }

        // En caso de que todo vaya bien, se podra enviar el formulario
        if (titulo_valido_subir_imagen && descripcionValida && path && path.size / 1024 <= 1100 && extensiones_validas.indexOf(path.name.split('.').pop().toLowerCase()) !== -1) {
            this.submit();
        }
    });

    // Validacion del modal para editar una imagen subida por el usuario
    document.getElementById('formularioEditarImagen').addEventListener('submit', function (event) {
        event.preventDefault();

        let titulo_error_editar_imagen = this.querySelector('#titulo-error');
        let descripcion_error_editar_imagen = this.querySelector('#descripcion-error');
        titulo_error_editar_imagen.textContent = '';
        descripcion_error_editar_imagen.textContent = '';

        // Obtengo el value de cada input para despues evaluarlos 
        // A los inputs no se contaran los espacios en blanco
        let titulo_editar_imagen = this.querySelector('#titulo-modal').value.trim();
        let descripcion = this.querySelector('#descripcion-modal').value.trim();


        // Veo si hay algun error con la validacion de los inputs
        let titulo_valido_editar_imagen = /^[a-zA-Z0-9.,()" ]{1,30}$/.test(titulo_editar_imagen);
        let descripcionValida = /^[a-zA-Z0-9.,()" ]{0,100}$/.test(descripcion);

        if (!titulo_valido_editar_imagen) {
            this.querySelector('#titulo-modal').classList.add('is-invalid');
            titulo_error_editar_imagen.textContent = 'El titulo debe tener como maximo 30 caracteres y solo puede contener letras, numeros, comas, puntos, parentesis y espaciados.';
        } else {
            this.querySelector('#titulo-modal').classList.remove('is-invalid');
            this.querySelector('#titulo-modal').classList.add('is-valid');
        }

        if (!descripcionValida) {
            this.querySelector('#descripcion-modal').classList.add('is-invalid');
            descripcion_error_editar_imagen.textContent = 'La descripcion puede tener como maximo 100 caracteres y solo puede contener letras mayusculas o minusculas, numeros, comas, puntos, parentesis y espaciados.';
        } else {
            this.querySelector('#descripcion-modal').classList.remove('is-invalid');
            this.querySelector('#descripcion-modal').classList.add('is-valid');
        }

        // En caso de que todo vaya bien, se podra enviar el formulario
        if (titulo_valido_editar_imagen && descripcionValida) {
            this.submit();
        }
    });

    // Validacion del modal para editar el titulo y descripcion de una galeria
    document.getElementById('formularioEditarGaleria').addEventListener('submit', function (event) {
        event.preventDefault();

        let titulo_error_editar_galeria = this.querySelector('#titulo-error');
        let descripcion_error_editar_galeria = this.querySelector('#descripcion-error');
        titulo_error_editar_galeria.textContent = '';
        descripcion_error_editar_galeria.textContent = '';

        // Obtengo el value de cada input para despues evaluarlos 
        // A los inputs no se contaran los espacios en blanco
        let titulo_editar_galeria = this.querySelector('#titulo-galeria_modal').value.trim();
        let descripcion = this.querySelector('#descripcion-galeria_modal').value.trim();


        // Veo si hay algun error con la validacion de los inputs
        let titulo_valido_editar_galeria = /^[a-zA-Z0-9.,()" ]{1,30}$/.test(titulo_editar_galeria);
        let descripcion_valida_editar_galeria = /^[a-zA-Z0-9.,()" ]{0,100}$/.test(descripcion);

        if (!titulo_valido_editar_galeria) {
            this.querySelector('#titulo-galeria_modal').classList.add('is-invalid');
            titulo_error_editar_galeria.textContent = 'El titulo debe tener como maximo 30 caracteres y solo puede contener letras, numeros, comas, puntos, parentesis y espaciados.';
        } else {
            this.querySelector('#titulo-galeria_modal').classList.remove('is-invalid');
            this.querySelector('#titulo-galeria_modal').classList.add('is-valid');
        }

        if (!descripcion_valida_editar_galeria) {
            this.querySelector('#descripcion-galeria_modal').classList.add('is-invalid');
            descripcion_error_editar_galeria.textContent = 'La descripcion puede tener como maximo 100 caracteres y solo puede contener letras mayusculas o minusculas, numeros, comas, puntos, parentesis y espaciados.';
        } else {
            this.querySelector('#descripcion-galeria_modal').classList.remove('is-invalid');
            this.querySelector('#descripcion-galeria_modal').classList.add('is-valid');
        }

        // En caso de que todo vaya bien, se podra enviar el formulario
        if (titulo_valido_editar_galeria && descripcion_valida_editar_galeria) {
            this.submit();
        }
    });

});