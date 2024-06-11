document.getElementById('formulario-comentario').addEventListener('submit', function () {
    var fecha_actual = new Date();
    let año = fecha_actual.getFullYear();
    let mes = (fecha_actual.getMonth() + 1).toString().padStart(2, '0');
    let dia = fecha_actual.getDate().toString().padStart(2, '0');
    let fecha_valida = `${año}-${mes}-${dia}`;
    document.getElementById('fecha_creacion').value = fecha_valida;
});
