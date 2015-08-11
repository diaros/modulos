'use strict';

$(document).on("ready", inicio);

$("#plantilla").popover({placement: 'top', html: true, trigger: 'hover', content: 'Descargar formato de planilla con usuarios pre cargdos<br>'});
$("#registrar").popover({placement: 'left', html: true, trigger: 'hover', content: 'Subir planilla de nomina<br>'});

function inicio() {

    $('#mes').datepicker({
        language: "es",
        format: "mm-yyyy",
        viewMode: "months",
        minViewMode: "months",
        startDate: '-2m',
        endDate: '+1m'
    });

}

function limpiarForm() {
    
    $("#contenedorTabla").slideUp(1000);
    $("#contenedorTablaErrores").slideUp(1000);

    $("#empresaInt").prop('disabled', false);
    $("#empUsu").prop('disabled', false);
    $("#centroCosto").prop('disabled', false);
    $("#ciudad").prop('disabled', false);
    $("#mes").prop('disabled', false);
    $("#periocidad").prop('disabled', false);

    $("#empresaInt").val('');
    $("#empUsu").html("");
    $("#centroCosto").html("");
    $("#ciudad").val('');
    $("#mes").val('');
    $("#periocidad").val('');
    $("#nomArchivoOculto").val('');
    $(":file").filestyle('clear');

    //$("#divDiasHabiles").fadeOut(1000);
    //$("#divAdicionales").fadeOut(1000);
    //$("#guardar").fadeOut(1000);
    //$("#finalizar").fadeOut(1000);

    $("#plantilla").fadeOut(1000);
    $("#contenedorBtnCargar").fadeOut(1000);
    $("#registrar").fadeOut(1000);
    $("#nomArchivoOculto").val("");

    $("#hrsHabiles").html("");
    $("#hrsDominicales").html("");
    $("#hrsFestivos").html("");
    $("#totalUsers").html("");
    $("#estadoPlanilla").html("");
    $("#totalAdicionales").html("");

    $("#datosUsuario").html("");

    $("#registrar").removeClass('disabled');
    $("#plantilla").removeClass('disabled');
    $("#consultar").removeClass('disabled');
    $("#finalizar").removeClass('disabled');   

    $("#cabeceraErrores").html("");
    $("#datosErrores").html("");

    
    $("#contentUserSinReg").html("");
}

function consultarEmpClienteBySupervisor() {

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

function consultarCC() {

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

                    $("#centroCosto").append(
                            "<option value='" + valor.cod_ccos + "'>"+ valor.cod_ccos +"-"+ valor.nom_clie + "</option>"
                            );
                });

            }

        }

    });

}

function valVacios() {

    var empInt = $("#empresaInt").val();
    var empCli = $("#empUsu").val();
    var centroCosto = $("#centroCosto").val();
    var ciudad = $("#ciudad").val();
    var periocidad = $("#periocidad").val()


    if (empInt != '' && empCli != '' && centroCosto != '' && ciudad != '' && periocidad != '') {
        generarPlantilla();
    } else {

        $("#tituloModal").html("Advertencia");
        $("#cuerpoModal").html("Todos los campos son obligatorios.");
        $("#modalInfo").modal('toggle');

    }

}

function generarPlantilla() {

    var empInt = $("#empresaInt").val();
    var empCli = $("#empUsu").val();
    var centroCosto = $("#centroCosto").val();
    var ciudad = $("#ciudad").val();
    var periocidad = $("#periocidad").val();
    var mes = $("#mes").val();

    $("#empresaInt").prop('disabled', true);
    $("#empUsu").prop('disabled', true);
    $("#centroCosto").prop('disabled', true);
    $("#ciudad").prop('disabled', true);
    $("#mes").prop('disabled', true);
    $("#periocidad").prop('disabled', true);

    $.ajax({
        type: 'POST',
        url: "../../vista/reporteNominaPlanoVista/asincReporteNominaPlano.php",
        data: {
            accion: "generarPlantilla",
            empInt: empInt,
            empCli: empCli,
            centroCosto: centroCosto,
            ciudad: ciudad,
            mes: mes,
            periocidad: periocidad
        },
        dataType: "json",
        beforeSend: function() {

            $('#modalLoad').modal({backdrop: 'static', keyboard: true});

        },
        success: function(data) {

            $("#modalLoad").modal('hide');

            if (data != '-1') {

                $("#registrar").fadeIn(1000);
                $("#plantilla").fadeIn(1000);
                $("#contenedorBtnCargar").fadeIn(1000);
                $("#nomArchivoOculto").val(data);

            } else {

                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("Ha ocurrido un error.Por favor intente nuevamente, si el problema persiste comuniquese con el area de desarrollo");
                $("#modalInfo").modal('show');

            }

        }

    }).done(function() {


    });

}

function descargarPlantilla() {

    var rutaArchivo = $("#nomArchivoOculto").val();
    window.open(rutaArchivo);

}

function valArchivo() {

    var archivo = $("#planillaNomina").val();

    if (archivo != '') {

        var ext = valExtension();

        if (ext == true) {

            subirArchivo();

        } else {

            $("#tituloModal").html("Advertencia");
            $("#cuerpoModal").html("Recuerde que la extencion del archivo debe ser .xls o .xlsx");
            $("#modalInfo").modal('toggle');
        }

    } else {

        $("#tituloModal").html("Advertencia");
        $("#cuerpoModal").html("Por favor seleccione un archivo a cargar.");
        $("#modalInfo").modal('toggle');

    }

}

function subirArchivo() {

    var empInt = $("#empresaInt").val();
    var empCli = $("#empUsu").val();
    var centroCosto = $("#centroCosto").val();
    var ciudad = $("#ciudad").val();
    var mes = $("#mes").val();
    var periocidad = $("#periocidad").val();

    $("#empIntOculto").val(empInt);
    $("#empCliOculto").val(empCli);
    $("#centroCostoOculto").val(centroCosto);
    $("#ciudadOculto").val(ciudad);
    $("#mesOculto").val(mes);
    $("#periocidadOculto").val(periocidad);

    var formulario = new FormData(document.getElementById("formReporteNominaPlano"));

    $.ajax({
        type: 'POST',
        url: "../../vista/reporteNominaPlanoVista/asincReporteNominaPlano.php",
        contentType: false,
        data: formulario,
        processData: false,
        cache: false,
        beforeSend: function() {
            $('#modalLoad').modal({backdrop: 'static', keyboard: true});
        },
        success: function(data) {
        }

    }).done(function(data) {

        var datos = JSON.parse(data);
        var objDatos = datos[0];
        var tipoError =  datos[0][0];
        
        //        
        if(tipoError === 'orden encabezados'){
            
            mostrarMalordenEncabezados(datos);
            
        }else if(tipoError === 'adicionales incorrectos'){
            
            mostrarAdicionalesIncorrectos(datos);
            
        }else if(tipoError === 'errores en datos'){
            
            construirTablaErrores(datos);
            
        }else if(tipoError === 'Error insertando encabezado'){
              
              $("#modalLoad").modal('toggle');
              $("#tituloModal").html("Advertencia");
              $("#cuerpoModal").html("Error insertando encabezado. Por favor intente el registro nuevamente. Si el fallo persiste comuniquelo al departamento de desarrollo");
              $("#modalInfo").modal('toggle');
            
        }else if(tipoError === 'Error insertando detalle'){
                
              $("#modalLoad").modal('toggle');
              $("#tituloModal").html("Advertencia");
              $("#cuerpoModal").html("Error insertando detalle. Por favor intente el registro nuevamente. Si el fallo persiste comuniquelo al departamento de desarrollo");
              $("#modalInfo").modal('toggle');
                
            
        }else{
            
            consultarDatosRegistro(data);
            
        }        
        //        
        
//        z = Object.keys(datos);       
//
//        if (typeof objDatos !== 'undefined') {
//
//            key = Object.keys(objDatos);
//
//            if (key[0] == 'id') {
//
//                consultarDatosRegistro(data);
//
//            } else {
//
//                mostrarErroresEncabezados(datos);
//            }
//
//        } else {
//
//            if ($.isArray(datos[z[0]])) {
//
//                construirTablaErrores(datos);
//
//            } else {
//
//                mostrarErroresEncabezados(datos);
//
//            }
//
//        }

    });
}

function construirTablaErrores(datos) {

    var filasColumnasErrores = '';
    $("#cabeceraErrores").html("");
    $("#datosErrores").html("");
    $("#contenedorTablaErrores").slideUp(1000);
    var iter = 0;

    $.each(datos, function(llave, valor) {

        if (iter > 0) {

//            var auxValor = parseInt(llave) + 1;

//            filasColumnasErrores = filasColumnasErrores + "<tr><td class='tdNum'>" + auxValor + "</td>";

            $.each(valor, function(llave2, valor2) {

                filasColumnasErrores = filasColumnasErrores + "<td class='tdText'>" + valor2 + "</td>";

            });

            filasColumnasErrores = filasColumnasErrores + "</tr>";


        }

        iter++;

    });

    var tablaErroresDatos = "<table class='table table-hover table-condensed table-striped'>\n\
                         <thead>\n\
                         <tr><td class='tdText'>Detalle</td>\n\
                         </tr>\n\
                         </thead>\n\
                         <tbody>\n\
                         " + filasColumnasErrores + "</tbody>\n\
                         </table>";

    $("#datosErrores").append(tablaErroresDatos);

    $("#contenedorTablaErrores").slideDown(1000);

    $("#modalLoad").modal('toggle');
}

function mostrarMalordenEncabezados(datos){

    var posDato = datos[0][0];
    var iter = 0;
    
    if (posDato == 'orden encabezados') {

        var filasColumnas = '';
        $("#cabeceraErrores").html("");
        $("#datosErrores").html("");
        $("#contenedorTablaErrores").slideUp(1000);

        $.each(datos, function(llave, valor) {

            if (iter > 0) {

               var auxValor = 0;
                if (valor < 13) {

                    auxValor = parseInt(valor) + 1;

                    filasColumnas = filasColumnas + "<tr>\n\
                        <td class='tdNum'>" + auxValor + "</td>\n\
                        </tr>";

                }
            }
            
            iter++;
        });

        var tablaErrores = "<p>Las siguietes columnas no se encuentran en la posición indicada o no cuentan con los nombres indicados:</p><br><table class='table table-hover table-striped table-condensed'>\n\
                <thead>\n\
                <tr>\n\
                <td class='tdNum'>Posición Columna</td>\n\
                </tr>\n\
                </thead>\n\
                <tbody>\n\
                " + filasColumnas + "\
                </tbody>\n\
                </table>";

        $('#modalLoad').modal('toggle');
        $("#tituloModalDatos").html("Advertencia");
        $("#cuerpoModalDatos").html(tablaErrores);
        $("#modalInfoDatos").modal('toggle');



    }
    
}

function mostrarAdicionalesIncorrectos(datos){
    
    var posDato = datos[0][0];
    var iter = 0;
    
    if (posDato == 'adicionales incorrectos') {
        
        var filasColumnas = '';
        $("#cabeceraErrores").html("");
        $("#datosErrores").html("");
        $("#contenedorTablaErrores").slideUp(1000);

        $.each(datos, function(llave, valor) {

            if (iter > 0) {

//                var auxValor = 0;

                filasColumnas = filasColumnas + "<tr>\n\
                        <td>" + valor + "</td>\n\
                        </tr>";

            }
             iter++;

        });


        var tablaErrores = "<p>Las siguientes adicionales ingresados no se encuentran parametrizados :</p><br><table class='table table-hover table-striped table-condensed'>\n\
                <thead>\n\
                <tr>\n\
                <td class='tdNum'>Cod Adicional</td>\n\
                </tr>\n\
                </thead>\n\
                <tbody>\n\
                " + filasColumnas + "\
                </tbody>\n\
                </table>";

        $('#modalLoad').modal('toggle');
        $("#tituloModalDatos").html("Advertencia");
        $("#cuerpoModalDatos").html(tablaErrores);
        $("#modalInfoDatos").modal('toggle');
        
    }
    
}

//ya no se va a usar .... REvisar
//function mostrarErroresEncabezados(datos) {
//
//    var posDato = datos[0][0];
//
//    if (posDato == 'orden encabezados') {
//
//        filasColumnas = '';
//        $("#cabeceraErrores").html("");
//        $("#datosErrores").html("");
//        $("#contenedorTablaErrores").fadeOut(1000);
//
//        $.each(datos, function(llave, valor) {
//
//            auxValor = 0;
//
//            if (valor < 13) {
//
//                auxValor = parseInt(valor) + 1;
//
//                filasColumnas = filasColumnas + "<tr>\n\
//                        <td>" + auxValor + "</td>\n\
//                        </tr>";
//
//            }
//
//        });
//
//        tablaErrores = "<p>Las siguietes columnas no se encuentran en la posición indicada o no cuentan con los nombres indicados:</p><br><table class='table table-hover table-striped table-condensed'>\n\
//                <thead>\n\
//                <tr>\n\
//                <td>Posición Columna</td>\n\
//                </tr>\n\
//                </thead>\n\
//                <tbody>\n\
//                " + filasColumnas + "\
//                </tbody>\n\
//                </table>";
//
//        $('#modalLoad').modal('toggle');
//        $("#tituloModalDatos").html("Advertencia");
//        $("#cuerpoModalDatos").html(tablaErrores);
//        $("#modalInfoDatos").modal('toggle');
//
//
//
//    } else {
//
//        filasColumnas = '';
//        $("#cabeceraErrores").html("");
//        $("#datosErrores").html("");
//        $("#contenedorTablaErrores").fadeOut(1000);
//
//        $.each(datos, function(llave, valor) {
//
//            filasColumnas = filasColumnas + "<tr>\n\
//                        <td>" + valor + "</td>\n\
//                        </tr>";
//            
//        });
//
//
//        tablaErrores = "<p>Las siguientes adicionales ingresados no se encuentran parametrizados :</p><br><table class='table table-hover table-striped table-condensed'>\n\
//                <thead>\n\
//                <tr>\n\
//                <td>Cod Adicional</td>\n\
//                </tr>\n\
//                </thead>\n\
//                <tbody>\n\
//                " + filasColumnas + "\
//                </tbody>\n\
//                </table>";
//
//        $('#modalLoad').modal('toggle');
//        $("#tituloModalDatos").html("Advertencia");
//        $("#cuerpoModalDatos").html(tablaErrores);
//        $("#modalInfoDatos").modal('toggle');
//
//
//
//    }
//
//
//
//}
////////////////////////////////////////////////////


function consultarDatosRegistro(data) {

    var datos = JSON.parse(data);
    var idReg1;

    $.each(datos, function(llave, valor) {

        var idReg2 = valor.id;
        idReg1 = idReg2;
    });


    $.ajax({
        type: 'POST',
        url: "../../vista/reporteNominaPlanoVista/asincReporteNominaPlano.php",
        data: {
            accion: "consultarRegistro",
            idReg: idReg1
        },
        async: false,
        dataType: "json",
        beforeSend: function() {
        },
        success: function(data) {
        }

    }).done(function(data) {
        
        if(data === '0'){
            
              $("#tituloModal").html("Advertencia");
              $("#cuerpoModal").html("No existen registros asociados, por favor verifique su archivo.");
              $("#modalInfo").modal('toggle');
            
        }else if(data === '-1'){
            
              $("#tituloModal").html("Advertencia");
              $("#cuerpoModal").html("Ha ocurrido un fallo. Por favor vuelva a intentarlo. Si el proble persiste cominiquelo al departamento de desarrollo");
              $("#modalInfo").modal('toggle');
     
            
        }else {
            
             construirTabla(data,idReg1);
        }

       


    });


}

function construirTabla(data,idReg) {

    var totalHabiles = 0;
    var totalDominicales = 0;
    var totalFestivos = 0;
    var totalUsers = 0;
    var pos = 1;

    var diash = '';
    var diasd = '';
    var diasf = '';

    var filas = '';
    var dias = '';

    $("#cabeceraErrores").html("");
    $("#datosErrores").html("");
    $("#contenedorTablaErrores").slideUp(1000);

    if (data != '-1') {

        $("#filaEncabezados").html("");

        $("#filaEncabezados").append(
                "<td class='tdTitle'>Cedula</td>\n\
                 <td class='tdTitle'>Nombre</td>\n\
                 <td class='tdTitle'>Hrs Habiles</td>\n\
                 <td class='tdTitle'>Hrs Dominicales</td>\n\
                 <td class='tdTitle'>Hrs festivos</td>\n\
                 <td class='tdTitle'>Dias Habiles</td>\n\
                 <td class='tdTitle'>Dias Dominicales</td>\n\
                 <td class='tdTitle'>Dias Festivos</td>\n\
                 <td class='tdTitle'>Adicionales</td>"
                );

        $.each(data, function(llave, valor) {

            var diash = '';
            var diasd = '';
            var diasf = '';

            var dias = consultaDiasByid(valor.id, valor.id_usuario);

            $.each(dias, function(llave2, valor2) {

                if (valor2.tipo.trim() == 'H') {
                    diash = diash + " " + valor2.fecha;
                }

                if (valor2.tipo.trim() == 'D') {
                    diasd = diasd + " " + valor2.fecha;
                }

                if (valor2.tipo.trim() == 'F') {
                    diasf = diasf + " " + valor2.fecha;
                }

            });

            filas = filas + "<tr id='" + pos + "FilaDatos' >";

            filas = filas + "<td id = '" + pos + "idUser' class='tdNum'>" + valor.id_usuario + "</td>\n\
                            <td id = '" + pos + "nomUser' class='tdText'>" + valor.ape_empl + " " + valor.nom_empl + "</td>\n\
                            <td id = '" + pos + "hrsHabiles' class='tdNum'>" + valor.horas_habiles + "</td>\n\
                            <td id = '" + pos + "hrsDominic' class='tdNum'>" + valor.horas_dominicales + "</td>\n\
                            <td id = '" + pos + "hrsFesti' class='tdNum'>" + valor.horas_festivos + "</td>\n\
                            <td id = '" + pos + "celDiasH' class='tdTitle'><input type='button' class='btn btn-link' id='btnDiasH" + pos + "' onclick='mostrarDias(this.id);' value='Consultar'><input type='hidden' id='" + pos + "diasH' value='" + diash + "'></td>\n\
                            <td id = '" + pos + "celDiasD' class='tdTitle'><input type='button' class='btn btn-link' id='btnDiasD" + pos + "' onclick='mostrarDias(this.id);' value='Consultar'><input type='hidden' id='" + pos + "diasd' value='" + diasd + "'></td>\n\
                            <td id = '" + pos + "celDiasF' class='tdTitle'><input type='button' class='btn btn-link' id='btnDiasF" + pos + "' onclick='mostrarDias(this.id);' value='Consultar'><input type='hidden' id='" + pos + "diasf' value='" + diasf + "'></td>\n\
                            <td id = '" + pos + "celConceptos' class='tdTitle'><input type='button' class='btn btn-link' id='btnConceptos" + pos + "' onclick='mostrarconceptos(this.id);' value='Consultar'><input type='hidden' id='idPlanilla" + pos + "' value='" + valor.id + "'></td>";

            filas = filas + "</tr>";

            totalHabiles = parseFloat(totalHabiles) + parseFloat(valor.horas_habiles);
            
//            totalDominicales = parseFloat(totalDominicales) + parseFloat(valor.horas_dominicales);
//            totalFestivos = parseFloat(totalFestivos) + parseFloat(valor.horas_festivos);

            totalUsers++;

            pos++;

        });
        
        totalDomFest();

        $("#hrsHabiles").html(totalHabiles);
        
        $("#totalUsers").html(totalUsers);

        $("#contenedorEstadoPlanilla").removeClass('panel-info');
        $("#contenedorEstadoPlanilla").addClass('panel-danger');

        $("#datosUsuario").append(filas);
        var vlrTotalConceptos = totalConceptos();
        
        if($.isNumeric(vlrTotalConceptos) !== true){
            
            vlrTotalConceptos = 0;
            
        }

        vlrTotalConceptos = formatPesos(vlrTotalConceptos);      
        
        $("#totalAdicionales").html(vlrTotalConceptos);

        //inhabilitar botones       
        $("#registrar").addClass('disabled');
        $("#plantilla").addClass('disabled');
        $("#consultar").addClass('disabled');
        //
        
        var idPlanilla = $("#idPlanilla1").val();
        $("#estadoPlanilla").html("PW-" + idPlanilla + " | Sin terminar");
              
            $("#contenedorTabla").slideDown(2500);

//        $("#panelUserReg").addClass('animated wow pulse');
//        $("#panelHrsOrdi").addClass('animated wow pulse');

        $("#modalLoad").modal('toggle');

    }
    
    cantUsuariosSinRegistrar(idReg);

}

function cantUsuariosSinRegistrar(idReg){    

    var idEmpInt = $("#empresaInt").val();
    var centroCosto = $("#centroCosto").val();
    var ciudad = $("#ciudad").val();
     
     $.ajax({
         
         type: 'POST',
         url:"../../vista/reporteNominaPlanoVista/asincReporteNominaPlano.php",
         data:{
             
             accion:"cantUserSinReg",
             idPlanilla:idReg,
             idEmpInt:idEmpInt,
             centroCosto:centroCosto,
             ciudad:ciudad
             
         },
         dataType: 'json',
        beforeSend:function(){},
        success: function(data) {}
         
     }).done(function(data){
            
        if(data != '0' && data != '-1'){
//         $("#contentUserSinReg").addClass('animated wow pulse');        
        $("#contentUserSinReg").html("<div class='panel panel-danger'>\n\
                                <div class='panel-heading'>\n\
                                   <div class='row'>\n\
                                       <div class='col-xs-1'>\n\
                                            <i class='fa fa-exclamation-triangle fa-4x'></i>\n\
                                       </div>\n\
                                       <div class='col-xs-11 text-right'><div class='huge numeroInfo'>Advertencia : Existen empleados sin registrar! consultelos \n\
                                            <a id='linkUserFaltantes' type='button' onclick='valUsersSinReg();'> aqui</a>\n\
                                       </div>\n\
                                    </div>\n\
                                    </div>\n\
                                   </div>\n\
                                </div>");      

        }
         
     });
     
     
 }
 
function valUsersSinReg(){           
    
    var idEmpInt = $("#empresaInt").val();
    var centroCosto = $("#centroCosto").val();
    var ciudad = $("#ciudad").val();
    var idPlanilla = $("#idPlanilla1").val();
     
     $.ajax({
         
         type: 'POST',
         url:"../../vista/reporteNominaPlanoVista/asincReporteNominaPlano.php",
         data:{
             
             accion:"valUserSinReg",
             idPlanilla:idPlanilla,
             idEmpInt:idEmpInt,
             centroCosto:centroCosto,
             ciudad:ciudad
             
         },
         dataType: 'json',
        beforeSend:function(){
            
            $("#modalLoad").modal('show');
        },
        success: function(data) {            
            console.log(data);
            if(data != '-1' ){
                
                var filaUsuarios = '';
                var tablaUserSinreg = '';
                
                $.each(data,function(llave,valor){              
          
                    filaUsuarios = filaUsuarios + "<tr><td class='tdText'>"+valor.apellido+" "+valor.nombre+"</td><td class='tdNum'>"+valor.cedula+"</td></tr>";                  
                    
                });  
                
                tablaUserSinreg = "<table class='table table-hover table-striped table-condensed'>\n\
                                   <thead>\n\
                                   <tr><td class='tdText'>Nombre</td><td class='tdNum'>Cedula</td></tr>\n\
                                   </thead>\n\
                                   <tbody>\n\
                                   "+filaUsuarios+"</tbody>\n\
                                   </table>";
                
                $("#tituloModalDatos").html("Usuarios sin registrar");
                $("#cuerpoModalDatos").html(tablaUserSinreg);
                $("#modalLoad").modal('hide');
                $("#modalInfoDatos").modal('toggle');
                
            }else{
                $("#modalLoad").modal('hide');
                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("Ha ocurrido un error en la consulta, por favor vuelva a intentarlo. Si el fallo persiste por favor comuniquese con el departamento de desarrollo.");
                $("#modalInfo").modal('toggle');
                
            }
        
        }
         
     }).done(function(){
         
         
     });
     
 }

function mostrarDetAdicionales() {

    var idPlanilla = $("#idPlanilla1").val();

    $.ajax({
        type: 'POST',
        url: '../../vista/reporteNominaPlanoVista/asincReporteNominaPlano.php',
        data: {
            accion: 'consultarDetalleConceptos',
            idPlanilla: idPlanilla
        },
        async: false,
        dataType: "json",
        beforeSend: function() {
           $("#modalLoad").modal('show');
        },
        success: function() {
        }

    }).done(function(data) {

        var acumDetConceptos = 0;
        var filaDetConceptos = '';
        var vlrDetConcepto = 0;
        var tablaDetConceptos = '';

        $.each(data, function(llave, valor3) {

            filaDetConceptos = filaDetConceptos + "<tr><td class='tdText'>" + valor3.nombre + "</td><td class='tdNum'>" + valor3.totalConcepto + "</td></tr>";
            vlrDetConcepto = parseFloat(valor3.totalConcepto);
            acumDetConceptos = acumDetConceptos + vlrDetConcepto;
        });

        acumDetConceptos = formatPesos(acumDetConceptos);

        tablaDetConceptos = "<table class='table table-hover table-striped table-condensed'>\n\
                                    <thead>\n\
                                        <tr>\n\
                                            <td class='tdText'>Nombre</td><td class='tdNum'>Valor</td>\n\
                                        </tr>\n\
                                    </thead>\n\
                                    <tbody>\n\
                                    " + filaDetConceptos + "\
                                    <tr class='active danger'><td class='tdNum'>Total</td><td class='tdNum'>" + acumDetConceptos + "</td></tr><tbody>\n\
                                  </table>";

        $("#tituloModalDatos").html("Detalle Conceptos");
        $("#cuerpoModalDatos").html(tablaDetConceptos);
        $("#modalLoad").modal('hide');
        $("#modalInfoDatos").modal('toggle');

    });
}

function totalConceptos() {

    var idPlanilla = $("#idPlanilla1").val();
    var datoTotalConceptos = '';

    $.ajax({
        type: 'POST',
        url: "../../vista/reporteNominaPlanoVista/asincReporteNominaPlano.php",
        data: {
            accion: "consultarTotalConceptos",
            idPlanilla: idPlanilla
        },
        async: false,
        dataType: "json",
        beforeSend: function() {
        },
        success: function() {
        }

    }).done(function(data) {

        var total = 0;

        $.each(data, function(llave, valor) {

            total = parseFloat(valor.total);

        });

        datoTotalConceptos = total;

    });

    return datoTotalConceptos;
}

function totalDomFest(){
    
    var idPlanilla = $("#idPlanilla1").val();
    var datoTotalDominicales = '';
    var datoTotalFestivos = '';
    
   
    $.ajax({
        type: 'POST',
        url: "../../vista/reporteNominaPlanoVista/asincReporteNominaPlano.php",
        data:{
            accion:"consultartotalDomFest",
            idPlanilla:idPlanilla
            
        },
        dataType:"json",
        beforeSend:function(){},
        success:function(data){
            
            
            
        }        
        
    }).done(function(data){
        
        if(data != '-1'){            
            
            //falta recorrer la consulta en data para agregar los valores al template....            
            $("#hrsDominicales").html(totalDominicales);
            $("#hrsFestivos").html(totalFestivos);
    
            
        }      
        
    });
    
}

function mostrarconceptos(id) {

    var datos = null;

    var longId = id.length;
    var idLinea = id.substring(12, longId);

    var idPlanilla = $("#idPlanilla" + idLinea + "").val();
    var idUsuario = $("#" + idLinea + "idUser").html();
    $("#cuerpoModal").html("");

    var filaConceptosUsuario = '';
    var vlrConcepto = '';

    $.ajax({
        type: 'POST',
        url: "../../vista/reporteNominaPlanoVista/asincReporteNominaPlano.php",
        data: {
            accion: "consultarConceptos",
            idPlanilla: idPlanilla,
            idUsuario: idUsuario
        },
        dataType: "json",
        beforeSend: function() {
           $("#modalLoad").modal('show');
        },
        success: function() {
        }

    }).done(function(data) {

        var acumConceptos = 0;

        $.each(data, function(llave, valor2) {

            filaConceptosUsuario = filaConceptosUsuario + "<tr><td class='tdText'>" + valor2.nombre + "</td><td class='tdNum'>" + valor2.valor + "</td></tr>";
            vlrConcepto = parseFloat(valor2.valor);
            acumConceptos = acumConceptos + vlrConcepto;

        });

        acumConceptos = formatPesos(acumConceptos);

        var tablaConceptosUsuario = "<table class='table table-hover table-striped table-condensed'>\n\
                                    <thead>\n\
                                        <tr>\n\
                                            <td class='tdText'>Nombre</td><td class='tdNum'>Valor</td>\n\
                                        </tr>\n\
                                    </thead>\n\
                                    <tbody>\n\
                                    " + filaConceptosUsuario + "\
                                    <tr class='active danger'><td class='tdNum'>Total</td><td class='tdNum'>" + acumConceptos + "</td></tr><tbody>\n\
                                  </table>";

        $("#tituloModalDatos").html("Conceptos");
        $("#cuerpoModalDatos").html(tablaConceptosUsuario);
        $("#modalLoad").modal('hide');
        $("#modalInfoDatos").modal('toggle');

    });


}

function consultaDiasByid(id, id_usuario) {

    var datos = null;

    $.ajax({
        type: 'POST',
        url: "../../vista/reporteNominaPlanoVista/asincReporteNominaPlano.php",
        data: {
            accion: "consulTarDias",
            idPlanilla: id,
            idUsuario: id_usuario
        },
        dataType: "json",
        async: false,
        beforeSend: function() {
        },
        success: function() {
        }

    }).done(function(data) {

        datos = data;


    });

    return datos;

}

function mostrarDias(id) {

    var arregloDias = Array();
    var tablaDiasUsuario = '';
    var filasDiasUsuario = '';
    arregloDias = [];

    var longId = id.length;
    var idLinea = id.substring(8, longId);
    var tipoDia = id.substring(7, 8);

    if (tipoDia == 'H') {

        var dias = $("#" + idLinea + "diasH").val();
        dias = dias.trim();
        arregloDias = dias.split(" ");

        $.each(arregloDias, function(llave, valor) {

            filasDiasUsuario = filasDiasUsuario + "<tr>\n\
                        <td class='tdText'>" + valor + "</td><td class='tdText'>Hábil</td>\n\
                        </tr>";

        });

        tablaDiasUsuario = "<table class='table table-hover table-striped table-condensed'>\n\
                <thead>\n\
                <tr>\n\
                <td class='tdText'>Fecha Dia</td><td class='tdText'>Tipo</td>\n\
                </tr>\n\
                <thead>\n\
                <tbody>\n\
                " + filasDiasUsuario + "\
                </tbody>\n\
                </table>";

        $("#tituloModalDatos").html("Dias Habiles");
        $("#cuerpoModalDatos").html(tablaDiasUsuario);
        $("#modalInfoDatos").modal('toggle');
    }

    if (tipoDia == 'D') {

        var dias = $("#" + idLinea + "diasd").val();
        dias = dias.trim();
        arregloDias = dias.split(" ");

        $.each(arregloDias, function(llave, valor) {

            filasDiasUsuario = filasDiasUsuario + "<tr>\n\
                        <td class='tdText'>" + valor + "</td><td class='tdText'>Dominical</td>\n\
                        </tr>";

        });

        tablaDiasUsuario = "<table class='table table-hover table-striped table-condensed'>\n\
                <thead>\n\
                <tr>\n\
                <td class='tdText'>Fecha Dia</td><td class='tdText'>Tipo</td>\n\
                </tr>\n\
                <thead>\n\
                <tbody>\n\
                " + filasDiasUsuario + "\
                </tbody>\n\
                </table>";

        $("#tituloModalDatos").html("Dias Dominicales");
        $("#cuerpoModalDatos").html(tablaDiasUsuario);
        $("#modalInfoDatos").modal('toggle');
    }

    if (tipoDia == 'F') {

        var dias = $("#" + idLinea + "diasf").val();
        dias = dias.trim();
        arregloDias = dias.split(" ");

        $.each(arregloDias, function(llave, valor) {

            filasDiasUsuario = filasDiasUsuario + "<tr>\n\
                        <td class='tdText'>" + valor + "</td><td class='tdText'>Festivo</td>\n\
                        </tr>";

        });

        tablaDiasUsuario = "<table class='table table-hover table-striped table-condensed'>\n\
                <thead>\n\
                <tr>\n\
                <td class='tdText'>Fecha Dia</td><td class='tdText'>Tipo</td>\n\
                </tr>\n\
                <thead>\n\
                <tbody>\n\
                " + filasDiasUsuario + "\
                </tbody>\n\
                </table>";

        $("#tituloModalDatos").html("Dias Festivos");
        $("#cuerpoModalDatos").html(tablaDiasUsuario);
        $("#modalInfoDatos").modal('toggle');
    }

}

function consultaDiasByCedula(id, cedula) {

    $.ajax({
        type: 'POST',
        url: "../../vista/reporteNominaPlanoVista/asincReporteNominaPlano.php",
        data: {
            accion: "consultarDias",
            id: id,
            cedula: cedula

        },
        dataType: "json",
        beforeSend: function() {

        },
        success: function() {

        }
    }).done(function() {



    });

}

function valExtension() {

    var nombreArchivo = $("#planillaNomina").val();
    var longNombreArchivo = nombreArchivo.length;
    var ext = nombreArchivo.substring(longNombreArchivo - 3, longNombreArchivo);
    var ext2 = nombreArchivo.substring(longNombreArchivo - 4, longNombreArchivo);

    if (ext == 'xls' || ext2 == 'xlsx') {

        return true;

    } else {

        return false;
    }

}

function confirmFinalizar() {

    var cuerpoConfirmar = '';

    cuerpoConfirmar = "<p>Esta seguro que desea finalizar esta planilla?</p>\n\
                       <div class='col-lg-12' id='botones2'>\n\
                                <input type='button' id='btnFinalizar' value='Confirmar' class='btn btn-primary' onclick='finalizarPlanilla();'>\n\
                       </div>";

    $("#tituloModalDatos").html("Confirmar");
    $("#cuerpoModalDatos").html(cuerpoConfirmar);
    $("#modalInfoDatos").modal('toggle');

}

function finalizarPlanilla() {

    var idPlanilla = $("#idPlanilla1").val();

    $.ajax({
        type: 'POST',
        url: "../../vista/reporteNominaPlanoVista/asincReporteNominaPlano.php",
        data: {
            accion: "finalizarPlanilla",
            idPlanilla: idPlanilla

        },
        dataType: "json",
        beforeSend: function() {
        },
        success: function(data) {

            if (data == '1') {

                $("#contenedorEstadoPlanilla").fadeOut(100);
                $("#estadoPlanilla").html("");
                $("#estadoPlanilla").html("PW-" + idPlanilla + " | Terminada");
                $("#contenedorEstadoPlanilla").removeClass('panel-danger');
                $("#contenedorEstadoPlanilla").addClass('panel-primary');
                $("#contenedorEstadoPlanilla").slideDown(1000);
                $("#modalInfoDatos").modal('toggle');

            } else {
            }
        }

    }).done(function() {
    });

}

function confirmEliminar() {

    var cuerpoConfirmar = '';

    cuerpoConfirmar = "<p>Esta seguro que desea eliminar esta planilla?</p>\n\
                       <div class='col-lg-12' id='botones2'>\n\
                                <input type='button' id='btnEliminar' value='Confirmar' class='btn btn-danger' onclick='eliminarPlanilla();'>\n\
                       </div>";

    $("#tituloModalDatos").html("Confirmar");
    $("#cuerpoModalDatos").html(cuerpoConfirmar);
    $("#modalInfoDatos").modal('toggle');

}

function eliminarPlanilla() {

    var idPlanilla = $("#idPlanilla1").val();

    $.ajax({
        type: 'POST',
        url: "../../vista/reporteNominaPlanoVista/asincReporteNominaPlano.php",
        data: {
            accion: "eliinarPlanilla",
            idPlanilla: idPlanilla

        },
        dataType: "json",
        beforeSend: function() {
        },
        success: function(data) {

            if (data == '1') {

                $("#contenedorEstadoPlanilla").fadeOut(100);
                $("#estadoPlanilla").html("");
                $("#estadoPlanilla").html("PW-" + idPlanilla + " | Eliminada");
                $("#contenedorEstadoPlanilla").removeClass('panel-danger');
                $("#contenedorEstadoPlanilla").addClass('panel-danger');
                $("#contenedorEstadoPlanilla").slideDown(1000);
                $("#modalInfoDatos").modal('toggle');

            } else {


            }
        }

    }).done(function() {

        $("#finalizar").addClass("disabled");

    });


}

function formatPesos(num) {
    var p = num.toFixed(1).split(".");
    return  p[0].split("").reverse().reduce(function(acc, num, i, orig) {
        return  num + (i && !(i % 3) ? "." : "") + acc;
    }, "") + "," + p[1];
}