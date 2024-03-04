$("#deleteAct").click(confirmarAccion);
$("#saveActivitat").click(confirmarAccion);

function confirmarAccion() {
    if (confirm('Deseas continuar?')) {
        return true;
    } else {
        alert('Operacion Cancelada');
        console.log("hola")
        return false;
    }
}

$("#añadirAlumn").click(function(){
    $("#formAñadirAlumn").modal('show');
})

$("#cerrarFormAñadirAlumn").click(function(){
    $("#formAñadirAlumn").modal('hide');
})