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

function consultar() {

    var valFechas = true;
    var fechaInicial = $("#fechaIni").val();
    var fechaFinal = $("#fechaFin").val();

    if (fechaInicial != '' && fechaFinal == '') {

        $("#tituloModal").html("Advertencia");
        $("#cuerpoModal").html("Para consultar por rango de fechas debe ingresar la fecha final.");
        $("#modalInfo").modal('toggle');

    } else if (fechaInicial == '' && fechaFinal != '') {

        $("#tituloModal").html("Advertencia");
        $("#cuerpoModal").html("Para consultar por rango de fechas debe ingresar la fecha inicial.");
        $("#modalInfo").modal('toggle');

    } else if (fechaInicial != '' && fechaFinal != '') {

        valFechas = validarFechas(fechaInicial, fechaFinal);

        if (valFechas == true) {

            document.consultarReq.accion.value = "Consultar";
            document.forms['consultarReq'].submit();

        } else {

            $("#tituloModal").html("Advertencia");
            $("#cuerpoModal").html("La fecha inicial no puede ser mayor a la fecha final.");
            $("#modalInfo").modal('toggle');

        }
    } else if (fechaInicial == '' && fechaFinal == '') {

        if ($("#estado").val() == '') {

            $("#tituloModal").html("Advertencia");
            $("#cuerpoModal").html("Por favor ingrese alguno de los parametros para poder realizar la consulta.");
            $("#modalInfo").modal('toggle');


        } else {

            document.consultarReq.accion.value = "Consultar";
            document.forms['consultarReq'].submit();

        }

    }
}

function consulReq(id) {

    var empInt = $("#idEmpOculto" + id).val();
    var req = $("#idReqOculto" + id).val();
    var idUser = $("#idUserOculto" + id).val();

    $.ajax({
        
        type: 'POST',
        url: "../../vista/consultaRequisicionesVista/asincConsultaRequisiciones.php",
        data: {
            accion: "consultarReq",
            empInt: empInt,
            req: req,
            idUser: idUser

        },
        dataType: "json",
        beforeSend: function() {},
        success: function(data){

            var lista = '';
            var lista2 = '';
            var listaTotal = '';

            $.each(data, function(llave, valor){

                if (valor.estado == '2' || valor.estado == null) {

                    lista = lista + "<li>" + valor.descripcion + "</li>";

                }
                
                if(valor.estado == '4' && valor.soporteDerogados == ''){
                    
                    lista2 = lista2 + "<li>" + valor.descripcion + "</li>";
                    
                }

            });

            lista = "No presentados: <ul>" + lista + "</ul>";
            lista2 = "Sin soporte de derogación: <ul>" + lista2 + "</ul>";
            
            listaTotal = lista + lista2;

            $("#tituloModal").html("Documentos faltantes");
            $("#cuerpoModal").html(listaTotal);
            $("#modalInfo").modal('toggle');

        }

    });
}

function generarPdf(id) {

    var empInt = $("#idEmpOculto" + id).val();
    var req = $("#idReqOculto" + id).val();
    var idUser = $("#idUserOculto" + id).val();

    $.ajax({
        type: 'POST',
        url: "../../vista/consultaRequisicionesVista/asincConsultaRequisiciones.php",
        data: {
            accion: "generarPdf",
            empInt: empInt,
            req: req,
            idUser: idUser

        },
        dataType: "json",
        beforeSend: function() {

             $('#modalLoad').modal({backdrop: 'static', keyboard: true});
        },
        success: function(data) {

            if (data != null && data != '-1') {

                $("#modalLoad").modal('toggle');
                window.open(data);

            }

            if (data == '-1') {

                $("#modalLoad").modal('toggle');
                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("Ha ocurrido un error generando el archivo.Por favor intente nuevamente, si el problema persiste comuniquese con el area de desarrollo");
                $("#modalInfo").modal('toggle');
            }

        }

    });

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

function limpiar() {

    $("#fechaIni").val('');
    $("#fechaFin").val('');
    $("#estado").val('');
//    $("#contenedorTabla").css('display', 'none');
    $("#contenedorTabla").fadeOut("slow");

}