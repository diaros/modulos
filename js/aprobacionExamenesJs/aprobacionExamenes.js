$(document).on("ready", inicio);

var arregloItems = new Array();
var i;

$(function() {
   
    $("#marcarTodos").popover({placement: 'left', html: true, trigger: 'hover', title: '<b>Descripcion<b>', content: 'Marcar todos<br>'});
    
});

function marcar(){    
    
    if($("#marcarTodos").prop("checked")){
        
        var longreg = $('#datosExamenes >tbody >tr').length;
                 
        for (i = 1; i < longreg; i++){      
            
            $("#estado"+i).prop("checked",true);
            $("#apto"+i).val(1);
            $("#apto"+i).prop("disabled",false);
          
        }
        
    }else{
        
        var longreg = $('#datosExamenes >tbody >tr').length;        
        
        for (i = 1; i < longreg; i++){      
            
            $("#estado"+i).prop("checked",false);
            $("#apto"+i).val(2);
            $("#apto"+i).prop("disabled",true);
          
        }      
        
    }   
    
}

function  valAptos(){

    var longreg = $('#datosExamenes >tbody >tr').length;
    var y;

    for (i = 1; i < longreg; i++) {

        y = $('#aptoOculto' + i + '').val();

        if (y === '') {

            $("#apto" + i).val(-1);

        } else if ($("#aptoOculto" + i).val() == '1') {

            $("#apto" + i).val(1);

        } else if ($("#aptoOculto" + i).val() == '0') {

            $("#apto" + i).val(0);

        }

    }
}

function inicio(){

    $('.datepicker').datepicker({
        
        language: "es",
        orientation: "auto",
        autoclose: true,
        format: "yyyy/mm/dd",
        todayBtn: "linked",
        todayHighlight: true
        
    });
    
    var id = $("#paginaAct").val(); 
    
    valAptos();
    
}

function validarVacios() {

    var fechaIni = $("#fechaIni").val();
    var fechaFin = $("#fechaFin").val();
    var cedula = $("#cedula").val();
    var estado = $("#estado").val();
    var idSolicitud = $("#solicitud").val();

    if (fechaIni == '' && fechaFin == '' && cedula == '' && estado == '' && idSolicitud == '') {

        $("#cuerpoModal").html("Debe ingresar alguno de los filtros para poder realizar la consulta.");
        $("#modalInfo").modal('toggle');

    } else {

        if (cedula != '' || estado != '' || idSolicitud != '') {

            if (fechaIni == '' && fechaFin == '') {

                consultar();

            } else {

                if (fechaIni != '' && fechaFin == '') {

                    $("#cuerpoModal").html("Para realizar la consulta por rango de fechas debe ingresar la fecha final");
                    $("#modalInfo").modal('toggle');

                } else {

                    if (fechaIni != '' && fechaFin != '') {

                        var validacionFechas = validarFechas(fechaIni, fechaFin);

                        if (validacionFechas == false) {

                            $("#cuerpoModal").html("La fecha inicial no puede ser mayor a la fecha final.Por favor revise los datos ingresados");
                            $("#modalInfo").modal('toggle');

                        } else {

                            consultar();
                        }

                    } else if (fechaIni == '' && fechaFin != '') {

                        $("#cuerpoModal").html("Para realizar la consulta por rango de fechas debe ingresar la fecha inicial");
                        $("#modalInfo").modal('toggle');

                    }
                }

            }

        } else {

            if (fechaIni != '' && fechaFin == '') {

                $("#cuerpoModal").html("Para realizar la consulta por rango de fechas debe ingresar la fecha final");
                $("#modalInfo").modal('toggle');

            } else {

                if (fechaIni != '' && fechaFin != '') {

                    var validacionFechas = validarFechas(fechaIni, fechaFin);

                    if (validacionFechas == false) {

                        $("#cuerpoModal").html("La fecha inicial no puede ser mayor a la fecha final.Por favor revise los datos ingresados");
                        $("#modalInfo").modal('toggle');

                    } else {

                        consultar();
                    }

                } else if (fechaIni == '' && fechaFin != '') {

                    $("#cuerpoModal").html("Para realizar la consulta por rango de fechas debe ingresar la fecha inicial");
                    $("#modalInfo").modal('toggle');

                }
            }
        }
    }
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
    
    var fechaIni = yearIni+mesIni+diaIni;
    var fechaFin = yearFin+mesFin+diaFin;
    
    if (fechaIni > fechaFin) {
        return false;
    }

    return true;
}

function consultar() {

    document.aprobacionExamenesForm.accion.value = "Consultar";
    document.forms['aprobacionExamenesForm'].submit();

}

function reiniciar() {


//    $("#tablaAprobacionExamenes").css("display", "none");
    $("#tablaAprobacionExamenes").fadeOut("slow");
    
//    $("#aprobar").css("display", "none");
    $("#aprobar").fadeOut("slow");


}

function valSeleccionados(){
    
    var longTabla = $('#datosExamenes >tbody >tr').length;
    
    var msj = "Por favor ingrese el campo apto para la fila(s):";
    var flgError = 0;
    
    for(i = 1; i < longTabla; i++){
              
        var check = $("#estado"+i).prop("checked");
        
        if(check == true){
            
            if($("#apto"+i).val() == '-1'){               
               
                 msj = msj+i+",";
                 flgError = 1;
            }          
           
        }        
        
    }
        
    if(flgError == 0){
    
        document.aprobacionExamenesForm.accion.value = "Ejecutar";
        document.forms['aprobacionExamenesForm'].submit();
    
    }else{
        
          $("#cuerpoModal").html(msj);
          $("#modalInfo").modal('toggle');
    }    

}

function valEstado(idEstado, id, idIem) {

    var estado = idEstado.value;

    if (estado == 'Ejecutado') {

        $("#estado" + id + "").prop("checked", false);
        $("#cuerpoModal").html("El registro seleccionado ya se encuentra en estado ejecutado.");
        $("#modalInfo").modal('toggle');

    }else{
        
        if($("#estado"+id).prop("checked")){
            
             $("#apto"+id).prop("disabled",false);
              $("#apto"+id).val("1");
            
        }
        
        if($("#estado"+id).prop("checked") == false){
            
            $("#apto"+id).val("-1");
            $("#apto"+id).prop("disabled",true);
            
        }      
        
    }

}