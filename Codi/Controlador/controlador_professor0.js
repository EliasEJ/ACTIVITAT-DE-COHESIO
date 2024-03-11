
$(document).ready(function () {
    $(".deleteAct").click(confirmarAccion);
});

$(document).ready(function () {
    $("#saveActivitat").click(confirmarAccion);
});

$(document).ready(function () {
    $(".deleteGrup").click(confirmarAccion);
});


function confirmarAccion() {
    if (confirm('Deseas continuar?')) {
        return true;
    } else {
        alert('Operacion Cancelada');
        console.log("hola")
        return false;
    }
}

$("#añadirAlumn").click(function () {
    $("#modalAñadirAlumn").modal('show');
})

$("#cerrarModalAñadirAlumn").click(function () {
    $("#modalAñadirAlumn").modal('hide');
})

$("#salvarCheckAsistencia").click(function() {
    let listaAsistencia = [];
    for (const alumn of $("input.asistAlumn")) {
        let idAlumn = alumn.id.split("-")[1]
        listaAsistencia.push({
            "idAlumn": idAlumn,
            "asistencia": alumn.checked
        });
        
        $.ajax({
            method: 'post',
            url: 'administrar_alumnado.php',
            // estas son las variables que querés pasar a PHP
            // donde el "key" es el nombre que va a recibir
            // en el archivo php como $_POST['total']
            data: {
                datos: listaAsistencia
            },
            // esta función se llama cuando termina de procesar el
            // request y utiliza el response para obtener la data
            // que se imprimió desde PHP
            success: function(response) {
                console.log("hecho");
            }
        });
    }

});