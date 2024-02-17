$("#deleteAct").click(confirmarAccion);
$("#saveActivitat").click(confirmarAccion);

function confirmarAccion() {
    if (confirm('Deseas continuar?')) {
        return true;
    } else {
        alert('Operacion Cancelada');
        return false;
    }
}