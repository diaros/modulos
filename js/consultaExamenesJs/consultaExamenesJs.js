$(document).on("ready", inicio);

//$(document).ready( function () {
//    $('#registrosExamenes').DataTable();
//});
//
//$('#registrosExamenes').DataTable( {
//    ordering: true
//    
//} );

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
    var empresaInt = $("#empresaInt").val();
    var cliente = $("#cliente").val();
    var solIni = $("#solIni").val();
    var solFin = $("#solFin").val();

    if (fechaIni == '' && fechaFin == '' && empresaInt == '' && cliente == '' && solIni == '' && solFin == '') {

        $("#cuerpoModal").html("Debe ingresar alguno de los filtros para poder realizar la consulta.");
        $("#modalInfo").modal('toggle');

    } else {
        
        if (fechaIni != '' && fechaFin == '') {

            $("#cuerpoModal").html("Para realizar la consulta por rango de fechas debe ingresar la fecha final");
            $("#modalInfo").modal('toggle');

        }else if (fechaIni == '' && fechaFin != ''){
            
            $("#cuerpoModal").html("Para realizar la consulta por rango de fechas debe ingresar la fecha inicial");
            $("#modalInfo").modal('toggle');
            
        }else{            
            
            if(solIni != '' && solFin == ''){
                
                $("#cuerpoModal").html("Para realizar la consulta por rango del numero identificante de la orden, debe completar el rango");
                $("#modalInfo").modal('toggle');
                
            }else if(solIni == '' && solFin != ''){
                
                $("#cuerpoModal").html("Para realizar la consulta por rango del numero identificante de la orden, debe completar el rango");
                $("#modalInfo").modal('toggle');
                
            }else{
                
                consultar();
            }           
        }    
    }
}

function consultar() {

    document.consultaExamenesForm.accion.value = "Consultar";
    document.forms['consultaExamenesForm'].submit();

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

function consultarEmpClienteCE(){
    
     var idEmpInt = $("#empresaInt").val();

    $.ajax({
        type: 'POST',
        url: "../../vista/consultaExamenesVista/asincConsultarExamenes.php",
        data: {
            accion: "consultaEmpUsuarias",
            idEmpInt: idEmpInt
        },
        dataType: "json",
        beforeSend: function() {},
        success: function(data) {
            console.log(data);
            if(data == -1){               
            }else{     

            var datos = data;
            $("#cliente").html("");
            $("#cliente").append(
                    "<option value=''></option>"
                    );
            $.each(datos, function(llave, valor) {

                $("#cliente").append(
                        "<option value='" + llave + "'>" + valor + "</option>"
                        );

            });
            
             }

        }

    }).done(function() {

    });

    
    
    
}

function generarExcel(){
  
    var fechaIni = $("#fechaIniOculto").val();
    var fechaFin = $("#fechaFinOculto").val();
    var empresaInt = $("#empresaIntOculto").val();
    var cliente = $("#clienteOculto").val();
    var solIni = $("#solIniOculto").val();
    var solFin = $("#solFinOculto").val();
    var cedula = $("#cedulaOculto").val();
    var estado = $("#estadoOculto").val();
    
    $.ajax({
       
        type: 'POST',
        url: "../../vista/consultaExamenesVista/asincConsultarExamenes.php",
        data:{
            accion:"reporteExamenes",
            fechaIni:fechaIni,
            fechaFin:fechaFin,
            empresaInt:empresaInt,
            cliente:cliente,
            solIni:solIni,
            solFin:solFin,
            cedula:cedula,
            estado:estado
        },
        datatype:"json",
        beforeSend:function(){
            
            $('#modalLoad').modal({backdrop: 'static', keyboard: true});
            
        },
        success:function(data){
            
            $('#modalLoad').modal('toggle')
            window.open(data);
            
        }
        
    });  
    
}

function reiniciar() {
    
    document.getElementById("consultaExamenesForm").reset(); 
//    $("#reporteExcel").css("display","none");
    $("#reporteExcel").fadeOut("slow");
    
//    $("#tablaConsultaExamenes").css("display", "none");
    $("#tablaConsultaExamenes").fadeOut("slow");

}

