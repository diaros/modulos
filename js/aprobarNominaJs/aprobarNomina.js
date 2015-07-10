'use strict';

$(function() {

    $('.datepicker').datepicker({
        language: "es",
        orientation: "auto",
        autoclose: true,
        format: "yyyy/mm/dd",
        todayBtn: "linked",
        todayHighlight: true
    });

});

function consultarempclientebysupervisor() {

    var idEmpInt = $("#empresaInt").val();

    $.ajax({
        type: 'POST',
        url: "../../vista/reporteNominaPlanoVista/asincReporteNominaPlano.php",
        data: {
            accion: "consultaClientes",
            idEmpInt: idEmpInt
        },
        dataType: "json",
        beforeSend: function() {
        },
        success: function(data) {

            if (data == -1) {
                $("#empUsu").html("");
                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("No existen clientes parametrizados a su usuario");
                $("#modalInfo").modal('toggle');
            }
            else {
                var datos = data;
                $("#empUsu").html("");
                $("#empUsu").append(
                        "<option value=''></option>"
                        );
                $.each(datos, function(llave, valor) {
                    $("#empUsu").append(
                            "<option value='" + llave + "'>" + valor + "</option>");

                });
            }
        }
    });
}

function consultarcc() {

    var idEmpInt = $("#empresaInt").val();
    var idEmpUsu = $("#empUsu").val();

    $.ajax({
        type: 'POST',
        url: '../../vista/reporteNominaPlanoVista/asincReporteNominaPlano.php',
        data: {
            accion: "consultaCC",
            idEmpInt: idEmpInt,
            idEmpUsu: idEmpUsu
        },
        dataType: 'json',
        beforeSend: function() {
        },
        success: function(data) {

            if (data == -1) {

                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("Ha ocurrido un fallo. Por favor vuelva a intentarlo. Si el proble persiste cominiquelo al departamento de desarrollo");
                $("#modalInfo").modal('toggle');

            }
            else {

                var datos = data;
                $("#centroCosto").html("");
                $("#centroCosto").append(
                        "<option value=''></option>"
                        );
                $.each(datos, function(llave, valor) {
                    $("#centroCosto").append("<option value='" + valor.cod_ccos + "'>" + valor.cod_ccos + "-" + valor.nom_clie + "</option>");
                });
            }
        }
    });

}

function limpiarform() {

    $("#empresaInt").prop('disabled', false);
    $("#empUsu").prop('disabled', false);
    $("#centroCosto").prop('disabled', false);
    $("#ciudad").prop('disabled', false);
    $("#fecIni").prop('disabled', false);
    $("#fecFin").prop('disabled', true);
    $("#estado").prop('disabled', false);

    $("#empresaInt").val('');
    $("#empUsu").html('');
    $("#centroCosto").html('');
    $("#ciudad").val('');
    $("#fecIni").val('');
    $("#fecFin").val('');
    $("#estado").val('');

}

function valvaciosforma() {

    var empInt = $("#empresaInt").val();
    var empCli = $("#empUsu").val();
    var centrocosto = $("#centroCosto").val();
    var ciudad = $("#ciudad").val();
    var fecFin = $("#fecFin").val();
    var estado = $("#estado").val();

    if (empInt != '' || empCli !== null || centrocosto != null || ciudad != '' || fecFin != '' || estado != '') {


        if (fecFin != '') {

            var valFechas = '';
            var fecIni = $("#fecIni").val();
            var fecFin = $("#fecFin").val();

            valFechas = validarfechas(fecIni, fecFin);

            if (valFechas != true) {

                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("La fecha inicial no puede ser mayor a la fecha final.");
                $("#modalInfo").modal('toggle');

            } else {

                consultarRegNomina();
            }
            
        }else{
            
             consultarRegNomina();
            
        }       

    } else {

        $("#tituloModal").html("Advertencia");
        $("#cuerpoModal").html("Debe seleccionar alguno de los filtros para realizar la consulta");
        $("#modalInfo").modal('toggle');

    }

}

function valfechaini() {

    var fecIni = $("#fecIni").val();

    if (fecIni != '') {

        $("#fecFin").prop('disabled', false);

    } else {

        $("#fecFin").val('');
        $("#fecFin").prop('disabled', true);

    }

}

function valfechafin() {

    console.log("entrol...");

    var valFechas = true;
    var fecIni = $("#fecIni").val();
    var fecFin = $("#fecFin").val();

    valFechas = validarfechas(fecIni, fecFin);

    if (valFechas != true) {

        console.log("entro2");
        $("#tituloModal").html("Advertencia");
        $("#cuerpoModal").html("La fecha inicial no puede ser mayor a la fecha final.");
        $("#modalInfo").modal('toggle');

    } else {
       
        $("#tituloModal").html("Advertencia");
        $("#cuerpoModal").html("Fechas validadas");
        $("#modalInfo").modal('toggle');

    }

}

function consultarRegNomina(){
    
    var empInt = $("#empresaInt").val();
    var empCli = $("#empUsu").val();
    var centrocosto = $("#centroCosto").val();
    var ciudad = $("#ciudad").val();
    var fecIni = $("#fecIni").val();
    var fecFin = $("#fecFin").val();
    var estado = $("#estado").val();
    
    $.ajax({
       
        type: 'POST',
        url: '../../vista/aprobarNominaVista/asincAprobarNomina.php',
        data:{
            accion:"consultarRegNomina",
            empInt:empInt,
            empCli:empCli,
            centroCosto:centrocosto,
            ciudad:ciudad,
            fechaIni:fecIni,
            fechaFin:fecFin,
            estado:estado
        },
        dataType:"json",
        beforeSend:function(){  
            
            $("#modalLoad").modal('toggle');
        },
        success:function(data){            
            
            if(data != '0' && data != '-1'){
                
                construirTabla(data);
                
            }else if(data == '0'){
                
                
            }else if(data == '-1'){
                
                
            }
            
           
        }
        
    });
    
}

function construirTabla(data){
    
    var filaDatos = '';
    $("#datosNomina").html('');
    var pos = 0;
    
    $.each(data, function(llave,valor){
        
       filaDatos = filaDatos + "<tr>\n\
                        <td class = 'tdNum'><a id='conse-"+pos+"' onclick='consulSol(this.id);'>"+valor.id+"</a></td>\n\\n\
                        <td class = 'tdNum'>"+valor.centro_costo+"</td>\n\\n\
                        <td class = 'tdNum'>"+valor.ciudad+"</td>\n\\n\
                        <td class = 'tdNum'>"+valor.usu_creo+"</td>\n\\n\
                        <td class = 'tdNum'>"+valor.periodo+"</td>\n\\n\
                        <td class = 'tdNum'>"+valor.estado+"</td>\n\
                        <td class = 'tdNum'><input id='reg-"+pos+"' name='reg"+pos+"' type='checkbox' /></td>\n\
                    </tr>";
        
        pos++;
        
    });
    
    $("#datosNomina").append(filaDatos);
    $("#modalLoad").modal('toggle');
}

function consulSol(id) {
    console.log($("#" + id + "").html());
}

function valSelectTodos() {

    var longreg = $('#tablaDatosReg >tbody >tr').length;

    if ($("#selecTodos").prop("checked")) {

        for (var i = 0; i < longreg; i++) {

            $("#reg-" + i + "").prop("checked", true);

        }

    } else {

        for (i = 0; i < longreg; i++) {

            $("#reg-" + i + "").prop("checked", false);

        }
    }
}

function aprobarRegNom(){
    
    var longreg = $('#tablaDatosReg >tbody >tr').length;
    var regNom = new Array();
    
    for (var i = 0; i < longreg; i++) {
        
        if($("#reg-" + i + "").prop("checked")){
            
            regNom[i] = $("#conse-"+i+"").html();
            //console.log( $("#conse-"+i+"").html());             
            
        }       
    }
    
    $.ajax({
        type: 'POST' ,
        url: '../../vista/aprobarNominaVista/asincAprobarNomina.php',
        data:{
            accion:"aprobarSolicitudes",
            regNomina:regNom
        },
        dataType: 'json',
        beforeSend:function(){
            
//             $("#modalLoad").modal('toggle');
            
        },
        success:function(data){
            
            if(data == '1'){
                
//                $("#modalLoad").modal('toggle');
                
                $("#tituloModal").html("Información");
                $("#cuerpoModal").html("Nominas aprobadas correctamente");
                $("#modalInfo").modal('toggle');
                consultarRegNomina();
                
                
            }else if(data == '-1'){
                
//                $("#modalLoad").modal('toggle');
                
                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("Ha ocurrido un error aprobando los registros, por favor vuelva a intentarlo nuevamene.Si el fallo persiste comuniquese con el depto de desarrollo");
                $("#modalInfo").modal('toggle');
                limpiarform();
            }
            
        }        
        
    }).done(function(){
        
        
    });
}

function validarfechas(fechaInicial, fechaFinal) {

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
    } else {

        return true;

    }


}