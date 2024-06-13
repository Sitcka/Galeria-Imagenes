// CONFIGURACION DE PERFIL
// Validacion de la imagen de perfil del usuario
document.getElementById('image_profile').addEventListener('change', function () {
    var input = this;
    var tamaño_maximo_imagen_perfil = 2048 * 1024; // Tamaño máximo en bytes (2 MB)

    if (input.files.length > 0) {
        var archivo = input.files[0];

        // Validar tamaño del archivo
        if (archivo.size > tamaño_maximo_imagen_perfil) {
            alert('El tamaño de la imagen no debe superar los 2 MB.');
            input.value = ''; // Limpiar el valor del campo de entrada para evitar enviar la imagen al servidor
            return;
        }

        // Validar tipo de archivo
        var extensiones = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
        if (extensiones.indexOf(archivo.type) === -1) {
            alert('El tipo de archivo no es válido. Por favor selecciona una imagen JPEG, PNG, JPG o GIF.');
            input.value = ''; // Limpiar el valor del campo de entrada para evitar enviar la imagen al servidor
            return;
        }
    }
});
// SHOW DE USUARIO
// Validacion de subir una imagen por el usuario
