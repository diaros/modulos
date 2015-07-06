$(document).on("ready", inicio);

function inicio() {

    $('.datepicker').datepicker({
        language: "es",
        orientation: "auto",
        autoclose: true,
        format: "yyyy/mm/dd",
        todayBtn: "linked",
        todayHighlight: true
    });

}

function validarVacios() {

    var fechaIni = $("#fechaIni").val();
    var fechaFin = $("#fechaFin").val();

    if (fechaIni == '' && fechaFin == '') {

        $("#cuerpoModal").html("Debe ingresar alguno de los filtros para poder realizar la consulta.");
        $("#modalInfo").modal('toggle');

    } else {

        if (fechaIni != '' && fechaFin == '') {

            $("#cuerpoModal").html("Para realizar la consulta por rango de fechas debe ingresar la fecha final");
            $("#modalInfo").modal('toggle');

        } else if (fechaIni == '' && fechaFin != '') {

            $("#cuerpoModal").html("Para realizar la consulta por rango de fechas debe ingresar la fecha inicial");
            $("#modalInfo").modal('toggle');

        } else {

            consultar();

        }

    }
}

function consultar() {

    document.gestionReqForm.accion.value = "Consultar";
    document.forms['gestionReqForm'].submit();

}

function validarFechas(fechaInicial, fechaFinal) {

    var arrFechaInicial = fechaInicial.split("/");
    var arrFechaFinal = fechaFinal.split("/");

    var dateFechaInicial = new Date(arrFechaInicial[0], arrFechaInicial[1] - 1, arrFechaInicial[2]);
    var dateFechaFinal = new Date(arrFechaFinal[0], arrFechaFinal[1] - 1, arrFechaFinal[2]);

    var yearIni = arrFechaInicial[0];
    var mesIni = arrFechaInicial[1];
    var diaIni = arrFechaInicial[2];

    var yearFin = arrFechaFinal[0];
    var mesFin = arrFechaFinal[1];
    var diaFin = arrFechaFinal[2];

    var fechaIni = yearIni + mesIni + diaIni;
    var fechaFin = yearFin + mesFin + diaFin;

    if (fechaIni > fechaFin) {
        return false;
    }

    return true;
}

function confirmAceptar() {

    $("#modalConfirmAceptar").modal('toggle');

}

function aceptar() {
    
    $("#modalConfirmAceptar").modal('toggle');
    $('#modalLoad').modal({backdrop: 'static', keyboard: true});
    document.gestionReqForm.accion.value = "Aceptar";
    document.forms['gestionReqForm'].submit();

}

function valCheck() {

    var estado;
    var flgEstado = false;
    var longreg = $('#datosRequicisiones >tbody >tr').length;

    for (i = 1; i <= longreg; i++) {

        //estado = $("#aceptar" + i).val();

        if ($("#aceptar" + i).prop("checked") == true) {

            flgEstado = true;

        }

    }

    if (flgEstado == true) {

        //$("#btnAceptar").css("display", "inline");
        $("#btnAceptar").fadeIn("slow");

    } else {

        //$("#btnAceptar").css("display", "none");
        $("#btnAceptar").fadeOut("slow");
    }



}

function confirmPrestar(number) {

    if ($("#estadoOculto" + number).val() == 'Archivada') {

        $("#auxIdReg").val($("#idReg" + number).val());
        $("#modalConfirmPrestar").modal('toggle');

    } else {

        $("#tituloModal").html("Información");
        $("#cuerpoModal").html("Esta requisicion no ha sido archivada.");
        $("#modalInfo").modal('toggle');

    }

}

function prestamo() {

    var idReg = $("#auxIdReg").val();
    var idProceso = $("#proceso").val();
    var observacion = $("#observacion").val();

    $.ajax({
        type: 'POST',
        url: "../../vista/gestionRequisicionesVista/asincGestionRequisiciones.php",
        data: {
            accion: "prestamo",
            idReg: idReg,
            idProceso: idProceso,
            observacion:observacion

        },
        dataType: "json",
        beforeSend: function() {

            $("#modalConfirmPrestar").modal('toggle');
            $('#modalLoad').modal({backdrop: 'static', keyboard: true});

        },
        success: function(data){         

            $("#modalLoad").modal('toggle');

            if (data == '1') {

                $("#cuerpoModal").html("EL registro se ha guardado correctamente.");
                $("#modalInfo").modal('toggle');
//              $(location).attr("href", "../../vista/gestionRequisicionesVista/gestionRequisicionesVista.php");

                document.gestionReqForm.accion.value = "Consultar";
                document.forms['gestionReqForm'].submit();
                
            }

            if (data == '-1') {

                $("#cuerpoModal").html("Ha ocurrido un fallo en el registro.Por favor intente nuevamente, si el problema persiste comuniquese con el area de desarrollo.");
                $("#modalInfo").modal('toggle');

            }


        }

    });

}

function limpiar() {


    $("#fechaIni").val('');
    $("#fechaFin").val('');
    $("#empresaInt").val('');
    $("#requisicion").val('');
    $("#idUser").val('');
    $("#estado").val('');
    
    //$("#contenedorTabla").css("display","none");
    $("#contenedorTabla").fadeOut("slow");
     $("#btnAceptar").fadeOut("slow");
}

