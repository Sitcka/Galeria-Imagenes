// Validacion del comentario
let formularioComentario = document.getElementById('comentario-formularioModal');
let area_comentario = document.getElementById('comentario_texto');
let mensaje_limite_caracteres = document.getElementById('mensaje-limite-caracteres');
// Esto hara que deje de escribir cuando llegue al limite de caracteres
area_comentario.addEventListener('input', function () {
    
    let texto = this.value;
    let longitud = texto.length;
    let caracteres_maximo = 170;

    if (longitud > caracteres_maximo) {
        this.value = texto.slice(0, caracteres_maximo);
        longitud = caracteres_maximo;
    }

    // Mensaje de error al pasarse los caracteres permitidos
    if (longitud === caracteres_maximo) {
        mensaje_limite_caracteres.textContent = '¡Maximo de caracteres permitidos alcanzado!';
    } else {
        // Y borra el mensaje si esta correcta la validacion, es decir esta dentro del maximo de caracteres
        mensaje_limite_caracteres.textContent = '';
    }

    if(mensaje_limite_caracteres.textContent !== ''){
        setTimeout(() => {
            mensaje_limite_caracteres.textContent = ''
        },5000);
    }
});