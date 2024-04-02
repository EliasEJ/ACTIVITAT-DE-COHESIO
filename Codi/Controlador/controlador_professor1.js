
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
});

$("#crearActividad").click(function () {
    $("#modalCrearActividad").modal('show');
});


$("#cerrarModalAñadirAlumn").click(function () {
    $("#modalAñadirAlumn").modal('hide');
})

document.getElementById('generarDiplomas').addEventListener('click', function() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../Controlador/generarDiplomes.php', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);
            alert('Diplomas generados con éxito!');
        } else if (xhr.readyState == 4) {
            alert('Hubo un error al generar los diplomas: ' + xhr.status);
        }
    }
    xhr.onerror = function() {
        alert('Hubo un error al realizar la petición.');
    };
    xhr.send();
});

$("#cerrarModalCrearActividad").click(function () {
    $("#modalCrearActividad").modal('hide');
});

$(".editAct").click(function () {
    var id = $(this).data("id");
    var nom = $(this).data("nom");
    var descripcio = $(this).data("descripcio");
    var posicio_id = $(this).data("posicio_id");
    var grup1 = $(this).data("grup1");
    var grup2 = $(this).data("grup2");
    var id_professor = $(this).data("id-professor");

    $("#tituloActividadEdit").val(nom);
    $("#descripcionActividadEdit").val(descripcio);
    $("#posicionEditActividad").val(posicio_id);
    $("#grupo1Disponible").val(grup1);
    $("#grupo2Disponible").val(grup2);
    $("#professorDisponible").val(id_professor);

    // También podrías establecer un campo oculto con el ID de la actividad si es necesario
    $("#idActividad").val(id);

    $("#modalEditarActividad").modal('show');
});
