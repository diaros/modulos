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

    $('#cita').datetimepicker({
        format: 'LT'
    });
}

function consultarObserv() {

    var empInt = $("#empresaInt").val();
    var req = $("#requisicion").val();
    var idUser = $("#idUser").val();

    if (idUser != "") {

        $.ajax({
            type: 'POST',
            url: "../../vista/gestionContratosVista/asincGestionContratos.php",
            data: {
                accion: "consultarObservacion",
                empInt: empInt,
                req: req,
                idUser: idUser
            },
            dataType: "json",
            beforeSend: function() {
            },
            success: function(data) {

                if (data != null && data != '-1') {

                    $("#observ").val(data.trim());
                }

                if (data == '-1') {

                    $("#tituloModal").html("Advertencia");
                    $("#cuerpoModal").html("No existen registros asociados a los datos ingresados");
                    $("#modalInfo").modal('toggle');
                }
            }

        });

    }
}

function validarVacios() {

    var empInt = $("#empresaInt").val();
    var req = $("#requisicion").val();

    if (empInt === '' || req === '') {

        return (-1);

    } else {

        return (1);

    }

}

function generarCartaInformativa() {

    var empInt = $("#empresaInt").val();
    var req = $("#requisicion").val();
    var idUser = $("#idUser").val();

    var valVacios = validarVacios();

    if (valVacios === 1) {

        $.ajax({
            type: 'POST',
            url: "../../vista/gestionContratosVista/asincGestionContratos.php",
            data: {
                accion: "generarCartaInformativa",
                empInt: empInt,
                req: req,
                idUser: idUser
            },
            dataType: "json",
            beforeSend: function() {
                $('#modalLoad').modal({backdrop: 'static', keyboard: true});
            },
            success: function(data) {

                if (data !== null && data != "-1") {

                    $("#modalLoad").modal('toggle');
                    window.open(data);

                }

                if (data == "-1") {

                    $("#modalLoad").modal('toggle');
                    $("#tituloModal").html("Advertencia");
                    $("#cuerpoModal").html("No existen registros asociados a los datos ingresados");
                    $("#modalInfo").modal('toggle');

                }

            }

        });

    } else if (valVacios === -1) {

        $("#tituloModal").html("Advertencia");
        $("#cuerpoModal").html("Los campos Empresa Interna y Numero requisición son obligatorios");
        $("#modalInfo").modal('toggle');
    }


}

function generarCertificadoInduccion() {

    var empInt = $("#empresaInt").val();
    var req = $("#requisicion").val();
    var idUser = $("#idUser").val();

    var valVacios = validarVacios();

    if (valVacios === 1) {

        $.ajax({
            type: 'POST',
            url: "../../vista/gestionContratosVista/asincGestionContratos.php",
            data: {
                accion: "generarCertificadoInduccion",
                empInt: empInt,
                req: req,
                idUser: idUser
            },
            dataType: "json",
            beforeSend: function() {

                $('#modalLoad').modal({backdrop: 'static', keyboard: true});

            },
            success: function(data) {

                if (data !== null && data != "-1") {

                    $("#modalLoad").modal('toggle');
                    window.open(data);

                }

                if (data == "-1") {

                    $("#modalLoad").modal('toggle');
                    $("#tituloModal").html("Advertencia");
                    $("#cuerpoModal").html("No existen registros asociados a los datos ingresados");
                    $("#modalInfo").modal('toggle');

                }
            }
        });

    } else {

        $("#tituloModal").html("Advertencia");
        $("#cuerpoModal").html("Los campos Empresa Interna y Numero requisición son obligatorios");
        $("#modalInfo").modal('toggle');

    }

}

function confirmarCarta() {

    var empInt = $("#empresaInt").val();
    var req = $("#requisicion").val();
    var idUSer = $("#idUser").val();

    if (empInt !== "" && req !== "" && idUSer !== "") {

        $("#modalCartaPresentacion").modal('toggle');

    } else {

        $("#tituloModal").html("Advertencia");
        $("#cuerpoModal").html("Los campos Empresa Interna, Numero requisición y No Identificacion son obligatorios");
        $("#modalInfo").modal('toggle');

    }

}

function confirmarContrato() {

    var empInt = $("#empresaInt").val();
    var req = $("#requisicion").val();

    if (empInt !== "" && req !== "") {

        $("#modalParametrosContrato").modal('toggle');

    } else {

        $("#tituloModal").html("Advertencia");
        $("#cuerpoModal").html("Los campos Empresa Interna y Numero requisición son obligatorios");
        $("#modalInfo").modal('toggle');


    }
}

function generarCartaPresentacion() {

    var empInt = $("#empresaInt").val();
    var req = $("#requisicion").val();
    var idUser = $("#idUser").val();

    var atentamente = $("#atentamente").val();
    var cita = $("#cita").val();
    var direccion = $("#direccion").val();

    if (atentamente == "" || cita == "" || direccion == "") {

        $("#textModalCarta").html("Los campos Atentamente, Cita y Dirección son obligatorios");
        //$("#divMsjCarta").css("display", "block");
        $("#divMsjCarta").fadeIn("slow");

    } else {

        $.ajax({
            type: 'POST',
            url: "../../vista/gestionContratosVista/asincGestionContratos.php",
            data: {
                accion: "generarcartaPresentacion",
                empInt: empInt,
                req: req,
                idUser: idUser,
                att: atentamente,
                cita: cita,
                direccion: direccion
            },
            datatype: "json",
            beforeSend: function() {

                $('#modalLoad').modal({backdrop: 'static', keyboard: true});

            },
            success: function(data) {

                if (data !== null) {

                    $("#modalLoad").modal('toggle');
                    $("#modalCartaPresentacion").modal('toggle');
                    window.open(data);
                    limpiarCamposCartaPresentacion();

                }
            }
        });
    }
}

function generarClausulaAdicional() {

    var empInt = $("#empresaInt").val();
    var req = $("#requisicion").val();
    var idUser = $("#idUser").val();

    var valVacios = validarVacios();

    if (valVacios === 1) {

        $.ajax({
            type: 'POST',
            url: "../../vista/gestionContratosVista/asincGestionContratos.php",
            data: {
                accion: "generarClausulaAdicional",
                empInt: empInt,
                req: req,
                idUser: idUser

            },
            dataType: "json",
            beforeSend: function() {

                $('#modalLoad').modal({backdrop: 'static', keyboard: true});

            },
            success: function(data) {

                if (data !== null && data != "-1") {

                    $("#modalLoad").modal('toggle');
                    window.open(data);

                }

                if (data == "-1") {

                    $("#modalLoad").modal('toggle');
                    $("#tituloModal").html("Advertencia");
                    $("#cuerpoModal").html("No existen registros asociados a los datos ingresados");
                    $("#modalInfo").modal('toggle');

                }

            }

        });

    } else {

        $("#tituloModal").html("Advertencia");
        $("#cuerpoModal").html("Los campos Empresa Interna y Numero requisición son obligatorios");
        $("#modalInfo").modal('toggle');


    }



}

function generarDecreto3377() {

    var empInt = $("#empresaInt").val();
    var req = $("#requisicion").val();
    var idUser = $("#idUser").val();

    var valVacios = validarVacios();

    if (valVacios === 1) {

        $.ajax({
            type: 'POST',
            url: "../../vista/gestionContratosVista/asincGestionContratos.php",
            data: {
                accion: "generarDecreto3377",
                empInt: empInt,
                req: req,
                idUser: idUser

            },
            dataType: "json",
            beforeSend: function() {
                $('#modalLoad').modal({backdrop: 'static', keyboard: true});
            },
            success: function(data) {

                if (data !== null && data != "-1") {

                    $("#modalLoad").modal('toggle');
                    window.open(data);

                }

                if (data == "-1") {

                    $("#modalLoad").modal('toggle');
                    $("#tituloModal").html("Advertencia");
                    $("#cuerpoModal").html("No existen registros asociados a los datos ingresados");
                    $("#modalInfo").modal('toggle');

                }

            }

        });

    } else {

        $("#tituloModal").html("Advertencia");
        $("#cuerpoModal").html("Los campos Empresa Interna y Numero requisición son obligatorios");
        $("#modalInfo").modal('toggle');

    }

}

function generarContrato() {

    var valCampos = validarCamposContrato();

    if (valCampos == 1) {

        var empInt = $("#empresaInt").val();
        var req = $("#requisicion").val();
        var idUser = $("#idUser").val();

        var logo = $("input[name=radios]:checked").val();
        var perSal = $("input[name=salario]:checked").val();
        var tipContra = $("input[name=tipo]:checked").val();
        var fechaFin = $("#fechaFinContra").val();
        var adicionales = $("#adicionales").val();
        var valVacios = validarVacios();

        $.ajax({
            type: 'POST',
            url: "../../vista/gestionContratosVista/asincGestionContratos.php",
            data: {
                accion: "generarContrato",
                empInt: empInt,
                req: req,
                idUser: idUser,
                logo: logo,
                perSal: perSal,
                tipContra: tipContra,
                fechaFin: fechaFin,
                adicionales:adicionales

            },
            beforeSend: function() {

                $('#modalLoad').modal({backdrop: 'static', keyboard: true});

            },
            success: function(data) {


                $("#modalLoad").modal('toggle');

                if (data !== null && data != '-1') {

                    window.open(data);
                    $("#modalParametrosContrato").modal('toggle');
                }

                if (data == '-1') {

                    $("#modalParametrosContrato").modal('toggle');
                    $("#tituloModal").html("Advertencia");
                    $("#cuerpoModal").html("No existen registros asociados a los datos ingresados");
                    $("#modalInfo").modal('toggle');
                }

            }

        });

        //$("#divMsjContrato").css("display", "none");
        $("#divMsjContrato").fadeOut("slow");

    } else {

        $("#textModalContrato").html("El campo Fecha in contrato es obligatorio ");
        //$("#divMsjContrato").css("display", "block");
        $("#divMsjContrato").fadeIn("slow");

    }
}

function fechaFinContrato() {

    if ($("input[name=tipo]:checked").val() === 'inferior') {

        $("#fechaFinContra").removeAttr("disabled");

    } else if ($("input[name=tipo]:checked").val() === 'obraTipo1' || $("input[name=tipo]:checked").val() === 'obraTipo2') {

        $("#fechaFinContra").val('');
        $("#fechaFinContra").prop("disabled", true);

    }

}

function validarCamposContrato() {

    var tipContra = $("input[name=tipo]:checked").val();

    if (tipContra == 'inferior' && $("#fechaFinContra").val() == '') {

        return -1;

    } else {

        return 1;

    }

}

function limpiarCamposCartaPresentacion() {

    $("#atentamente").val("");
    $("#cita").val("");
    $("#direccion").val("");
    //$("#divMsjCarta").css("display", "none");
    $("#divMsjCarta").fadeOut("slow");

}

function generarPaqueteContrato() {

   // var valCampos = validarCamposContrato();
    var valVacios = validarVacios();

    if (valVacios == 1) {

        var empInt = $("#empresaInt").val();
        var req = $("#requisicion").val();
        var idUser = $("#idUser").val();

//        var logo = $("input[name=radios]:checked").val();
//        var perSal = $("input[name=salario]:checked").val();
//        var tipContra = $("input[name=tipo]:checked").val();
//        var fechaFin = $("#fechaFinContra").val();
        //var valVacios = validarVacios();

        $.ajax({
            type: 'POST',
            url: "../../vista/gestionContratosVista/asincGestionContratos.php",
            data: {
                accion: "generarPaqueteContrato",
                empInt: empInt,
                req: req,
                idUser: idUser,
//                logo: logo,
//                perSal: perSal,
//                tipContra: tipContra,
//                fechaFin: fechaFin

            },
            dataType: "json",
            beforeSend: function() {

                $('#modalLoad').modal({backdrop: 'static', keyboard: true});

            },
            success: function(data) {

                $("#modalLoad").modal('toggle');

                if (data !== null && data != '-1') {

                    window.open(data);
                    //$("#modalParametrosContrato").modal('toggle');
                }

                if (data == '-1') {

                    $("#modalParametrosContrato").modal('toggle');
                    $("#tituloModal").html("Advertencia");
                    $("#cuerpoModal").html("No existen registros asociados a los datos ingresados");
                    $("#modalInfo").modal('toggle');
                }

            }

        });

        //$("#divMsjContrato").css("display", "none");
        $("#divMsjContrato").fadeOut("slow");

    } else {
        
        $("#tituloModal").html("Advertencia");
        $("#cuerpoModal").html("Los campos Empresa Interna y Numero requisición son obligatorios");
        $("#modalInfo").modal('toggle');

//        $("#textModalContrato").html("El campo Fecha in contrato es obligatorio ");
//        $("#divMsjContrato").css("display", "block");

    }



}

function limpiarCampos() {

    $("#empresaInt").val("");
    $("#requisicion").val("");
    $("#idUser").val("");
    $("#adicionales").val("");
    $("#observ").val("");

}

function listaChequeo() {

    var empInt = $("#empresaInt").val();
    var req = $("#requisicion").val();
    var idUSer = $("#idUser").val();

    if (empInt !== "" && req !== "" && idUSer !== "") {

        window.open("../../vista/listaChequeoVista/listaChequeoVista.php?empInt=" + empInt + "&req=" + req + "&id=" + idUSer + "");

    } else {

        $("#tituloModal").html("Advertencia");
        $("#cuerpoModal").html("Los campos Empresa Interna, Numero requisición y No Identificacion son obligatorios");
        $("#modalInfo").modal('toggle');

    }

}

function consultarUsuariosxReq() {

    var idEmpInt = $("#empresaInt").val();
    var req = $("#requisicion").val();

    $.ajax({
        type: 'POST',
        url: "../../vista/gestionContratosVista/asincGestionContratos.php",
        data: {
            accion: "consultarUsuariosxReq",
            idEmpInt: idEmpInt,
            req: req
        },
        dataType: "json",
        beforeSend: function() {

            $('#modalLoad').modal({backdrop: 'static', keyboard: true});
            $("#observ").val('');

        },
        success: function(data) {
            
            console.log(data);
           

            $('#modalLoad').modal("toggle");
            
             $("#idUser").html("");
                $("#idUser").append(
                        "<option value=''></option>"
                        );

            if (data != null) {              

                $.each(data, function(llave, valor) {

                    $("#idUser").append(
                            "<option value='" + llave + "'>" + valor + "-" + llave + "</option>"
                            );

                });


            }else{
                
                
                $("#tituloModal").html("Informacion");
                $("#cuerpoModal").html("No existen registros asociados con los parametros ingresados");
                $("#modalInfo").modal('toggle');
                
            }


        }

    });

}

function valEmpresaInterna(){
    
    var idEmpInt = $("#empresaInt").val();;
    
    if(idEmpInt == 2 || idEmpInt == 3){
        
        $("#obraTipo1").prop('disabled',true);
        $("#obraTipo1").prop('checked',false);
        
    }else{
        
         $("#obraTipo1").prop('disabled',false);
    }
    
}