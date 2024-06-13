document.addEventListener('DOMContentLoaded', function () {
    // Validacion del modal para editar una imagen subida por el usuario pero de la galeria
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
 });