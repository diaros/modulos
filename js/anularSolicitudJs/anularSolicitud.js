function valVaciosOrden() {

    consultarOrden();

}

function consultarOrden() {

    document.anularSolicitudForm.accion.value = "Consultar";
    document.forms['anularSolicitudForm'].submit();

}

function preguntar() {

    $("#modalConfirm").modal('toggle');
}

function eliminarOrden() {

    document.anularSolicitudForm.accion.value = "Anular";
    document.forms['anularSolicitudForm'].submit();

}

function reiniciar() {

    document.getElementById("anularSolicitudForm").reset();
    $("#tablaConsultaOrden").css("display", "none");
    $("#anular").css("display", "none");
    $("#idOrden").val("");

}