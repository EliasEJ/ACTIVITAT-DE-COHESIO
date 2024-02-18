$(document).ready(function () {
    $("#botonAsistencia").click(function () {
        $("#modalAsistencia").modal('show');
    });
});

// Comprueba si es la primera visita del usuario
if (!document.cookie.split('; ').find(row => row.startsWith('asistencia_confirmada'))) {
    // Muestra el modal
    $('#modalAsistencia').modal('show');
}

// Cuando el modal se oculta (independientemente de la elección del usuario)
$('#modalAsistencia').on('hidden.bs.modal', function () {
    // Establece la cookie para que el modal no se muestre en futuras visitas
    var date = new Date();
    date.setTime(date.getTime() + (30 * 24 * 60 * 60 * 1000)); // 30 días
    var expires = "; expires=" + date.toUTCString();
    document.cookie = "asistencia_confirmada=true" + expires + "; path=/";
});

// Función para enviar la elección del usuario al servidor
function enviarAsistencia(confirmacion) {
    $.ajax({
        type: 'POST',
        url: '../Controlador/guardar_asistencia.php', // Nueva URL para manejar la lógica de almacenar en la base de datos
        data: { confirmacion: confirmacion },
        success: function (response) {
            // Puedes hacer algo con la respuesta del servidor si es necesario
        }
    });
}

// Asigna eventos a los botones del modal
$('#will-attend').click(function () {
    enviarAsistencia(1);
    $('#modalAsistencia').modal('hide');
    console.log('asistiré');
});

$('#wont-attend').click(function () {
    enviarAsistencia(0);
    $('#modalAsistencia').modal('hide');
    console.log('no asistiré');
});