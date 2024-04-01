
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