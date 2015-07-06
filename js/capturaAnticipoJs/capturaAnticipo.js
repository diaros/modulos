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

    cantItems = 1;

}

function consultaCta() {

    var idUser = $("#idUser").val();

    $.ajax({
        type: 'POST',
        url: "../../vista/capturaAnticipoVista/asincCapturaAnticipo.php",
        data: {
            accion: "consultarCta",
            idUser: idUser

        },
        dataType: 'json',
        beforeSend: function() {

            $("#entidadFin").val("");
            $("#nroCuenta").val("");
            $("#tipoCta").val("");

        },
        success: function(data) {

            console.log(data);

            if (data != "-1") {

                $("#entidadFin").val(data.nom_enti);
                $("#nroCuenta").val(data.nro_cuen);
                $("#tipoCta").val(data.cla_cuen);

                $("#entidadFin").prop("disabled", true);
                $("#nroCuenta").prop("disabled", true);
                $("#tipoCta").prop("disabled", true);

//                consultarDatosUser();

            } else {



            }
        }
    });

}

function valTipoAnticipo(idTipoAnticipo) {

    if (idTipoAnticipo == 'facturable') {

        $("#spanFacturable").css("opacity", "1");
        $("#spanPresupuesto").css("opacity", "0");
        $("#spanAdministrativa").css("opacity", "0");

        $("#nroPresupuesto").val("");
        $("#nroPresupuesto").prop("disabled", true);

        $("#centroCosto").prop("disabled", false);
        $("#cliente").prop("disabled", false);
        $("#unidadNeg").prop("disabled", false);


    } else if (idTipoAnticipo == 'administrativa') {

        $("#spanFacturable").css("opacity", "0");
        $("#spanPresupuesto").css("opacity", "0");
        $("#spanAdministrativa").css("opacity", "1");

        $("#nroPresupuesto").val("");
        $("#nroPresupuesto").prop("disabled", true);

        $("#centroCosto").prop("disabled", false);
        $("#cliente").prop("disabled", false);
        $("#unidadNeg").prop("disabled", false);


    } else if (idTipoAnticipo == 'presupuesto') {

        $("#spanFacturable").css("opacity", "0");
        $("#spanPresupuesto").css("opacity", "1");
        $("#spanAdministrativa").css("opacity", "0");

        $("#nroPresupuesto").prop("disabled", false);

        $("#centroCosto").val("");
        $("#cliente").val("");
        $("#unidadNeg").val("");

        $("#centroCosto").prop("disabled", true);
        $("#cliente").prop("disabled", true);
        $("#unidadNeg").prop("disabled", true);

    }



}

function consultarUniNegocio() {

    var idCentroCosto = $("#idcentroCostoOculto").val();
    var empInt = $("#empresaInt").val();

    $.ajax({
        type: 'POST',
        url: "../../vista/capturaAnticipoVista/asincCapturaAnticipo.php",
        data: {
            accion: "consultarUniNeg",
            idCentroCosto: idCentroCosto,
            empInt: empInt

        },
        dataType: "json",
        beforeSend: function() {



        },
        success: function(data) {

            console.log(data);

            if (data != "-1") {

                var datos = data;

                $("#unidadNeg").html("");
                $("#unidadNeg").append("<option value=''></option>");

                $.each(datos, function(llave, valor) {

                    $("#unidadNeg").append(
                            "<option value= '" + valor.f281_id + "'>" + valor.f281_descripcion + "</option> "
                            );


                });


            } else {


            }

        }

    });

}

function consultarUnidadNegocioPresupuesto() {

    var idPresupuesto = $("#nroPresupuesto").val();

    $.ajax({
        type: 'POST',
        url: "../../vista/capturaAnticipoVista/asincCapturaAnticipo.php",
        data: {
            accion: "consultaUnidadNegocioPresupuesto",
            idPresupuesto: idPresupuesto

        },
        dataType: "json",
        beforeSend: function() {
        },
        success: function(data) {

            console.log(data);

            if (data != "-1") {

                var datos = data;

                $("#unidadNeg").html("");
                $("#unidadNeg").append("<option value=''></option>");

                $.each(datos, function(llave, valor) {

                    $("#unidadNeg").append(
                            "<option value= '" + valor.f281_id + "'>" + valor.f281_descripcion + "</option> "
                            );


                });
                
                $("#unidadNeg").prop("disabled",false);

            } else {}
        }
    }).done(function(){
        
        consultarConceptosPresupuesto();   
        
    });
}

function consultarConceptosPresupuesto(){
    
    var idPresupuesto = $("#nroPresupuesto").val();
    var idCiudad = $("#ciudad").val();
    
    $.ajax({
        
        type: 'POST',
        url: "../../vista/capturaAnticipoVista/asincCapturaAnticipo.php",
        data:{
            
            accion:"consultarConceptosPresupuesto",
            idPresupuesto:idPresupuesto,
            idCiudad:idCiudad            
            
        },
        dataType:"json",
        beforeSend:function(){},
        success:function(data){
            
            console.log(data);
            
            if(data != '-1'){
                
                 var i = 1;
                $("#datosConceptos").html("");
                
                $.each(data, function(llave,valor){
                   
                   $("#datosConceptos").append(
                           "<tr>\n\
                            <td id='codCp"+i+"'>"+valor.cp_cod_copcento+"</td>\n\
                            <td id='nomCp"+i+"'>"+valor.nomConcepto+"</td>\n\
                            <td id='cpValor"+i+"'>"+valor.cp_valor+"</td>\n\
                            <td><input type='text' id='vlrConcepto"+i+"' name='vlrConcepto"+i+"' onblur='valVlrPresupuesto(this.id);'></td>\n\
                            </tr>"
                           );
                    
                    i = i+1;
                    
                });
                
                
                $("#modalConceptosPresupuesto").modal('toggle');
                
                
            }else{
                
                $("#tituloModalInfo").html("Advertencia");
                $("#cuerpoModalInfo").html("No existen conceptos asociados al presupuesto ingresado");
                $("#modalInfo").modal('toggle');                
                
            }
            
        }
        
    });  
    
}

function valVlrPresupuesto(id){
    
    var idLinea = id.substring(11,12);
    
    var valor = $("#vlrConcepto"+idLinea+"").val();
    var valorPresupuesto  = parseFloat($("#cpValor"+idLinea+"").html());
    
    if(valor > valorPresupuesto){
        
        $("#textModalConceptosPresupuesto").html('');
        $("#textModalConceptosPresupuesto").append("El valor ingresado supera el disponible para el presupuesto.");
        $("#divMsjConcepto").fadeIn(500);
        
        $("#vlrConcepto"+idLinea+"").val('');
        
        $("#divMsjConcepto").fadeOut(5500);
        
        
    }
    
    
    
}

$("#centroCosto").typeahead({
    source: function(query, process) {

        var centroCosto = $("#centroCosto").val();
        var empInt = $("#empresaInt").val();
        centroCostos = [];
        map = {};

        $.ajax({
            type: 'POST',
            url: "../../vista/capturaAnticipoVista/asincCapturaAnticipo.php",
            data: {
                accion: "consultarCentroCosto",
                empInt: empInt,
                centroCosto: centroCosto

            },
            dataType: "json",
            beforeSend: function() {
            },
            success: function(data) {

                var datos;

                if (data != null) {

                    datos = data;
                    nombres = [];

                    $.each(datos, function(llave, valor) {

                        nombres.push(valor.f284_descripcion + "-" + valor.f284_id);
                        map[valor.f284_descripcion + "-" + valor.f284_id] = valor;

                    });

                    if (data !== null && nombres.length > 0) {
                        process(nombres);
                    }

                }

            }

        });

    },
    updater: function(item) {

        $("#idcentroCostoOculto").val((map[item].f284_id));
        $("#cliente").val((map[item].f284_descripcion));
        $("#cliente").prop("disabled", true);
        return item;

    }

});


