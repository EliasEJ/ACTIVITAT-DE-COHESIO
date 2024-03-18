
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

