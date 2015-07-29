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

function valvaciosforma() {

    var empInt = $("#empresaInt").val();
    var empCli = $("#empUsu").val();
    var centrocosto = $("#centroCosto").val();
    var ciudad = $("#ciudad").val();
    var fecFin = $("#fecFin").val();
    var consecutivo = $("#consecutivo").val();

    if (empInt != '' || empCli !== null || centrocosto != null || ciudad != '' || fecFin != '' || consecutivo != '') {


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

        } else {

            consultarRegNomina();

        }

    } else {

        $("#tituloModal").html("Advertencia");
        $("#cuerpoModal").html("Debe seleccionar alguno de los filtros para realizar la consulta");
        $("#modalInfo").modal('toggle');

    }

}

function consultarRegNomina() {

    var empInt = $("#empresaInt").val();
    var empCli = $("#empUsu").val();
    var centrocosto = $("#centroCosto").val();
    var ciudad = $("#ciudad").val();
    var fecIni = $("#fecIni").val();
    var fecFin = $("#fecFin").val();
    var estado = $("#estado").val();
    var consecutivo = $("#consecutivo").val();

    $.ajax({
        type: 'POST',
        url: '../../vista/consultaNominaVista/asincConsultaNomina.php',
        data: {
            accion: "consultarRegNomina",
            empInt: empInt,
            empCli: empCli,
            centroCosto: centrocosto,
            ciudad: ciudad,
            fechaIni: fecIni,
            fechaFin: fecFin,
            consecutivo: consecutivo
        },
        dataType: "json",
        beforeSend: function() {
            $("#modalLoad").modal('toggle');
        },
        success: function(data) {
            $("#contenedorDatosConsulta").slideUp(1000);
            if (data != '0' && data != '-1') {

                construirTabla(data);
                consultarTotalDatos();

            } else if (data == '0') {

                $("#modalLoad").modal('hide');
                $("#tituloModal").html("Información");
                $("#cuerpoModal").html("No existen registros con los parametros ingresados");
                $("#modalInfo").modal('show');

            } else if (data == '-1') {

                $("#modalLoad").modal('hide');

            }
        }

    });

}

function construirTabla(data) {
    
    console.log(data);
    var tablaDatosReg = $('#tablaDatosReg').DataTable();
    tablaDatosReg.destroy();  
    
    var filaDatos = '';
    $("#datosNomina").html('');
    var pos = 0;

    $.each(data, function(llave, valor) {

        filaDatos = filaDatos + "<tr>\n\
                        <td class = 'tdTitle'><a id='conse-" + pos + "' onclick='consulSolicitud(this.id);'>" + valor.id + "</a></td>\n\\n\
                        <td class = 'tdText'>" + valor.centro_costo + "-"+valor.nom_ccos+" </td>\n\\n\
                        <td class = 'tdText'>" + valor.ciudad + "</td>\n\\n\
                        <td class = 'tdText'>" + valor.nom_empl + " "+valor.ape_empl+" </td>\n\\n\
                        <td class = 'tdNum'>" + valor.periodo + "</td>\n\\n\
                        <td class = 'tdTitle'id='estado-"+pos+"' >" + valor.estado + "</td>\n\
                        <td class = 'tdTitle'><a id='excel-"+pos+"' class='btn btn-link' onclick='generarExcel(this.id);'><span class='fa fa-file-excel-o'></span></a></td>\n\
                        <td class = 'tdTitle'><a id='plano-"+pos+"' class='btn btn-link' onclick='generarPlano(this.id);'><span class='fa fa-file-o'></span></a></td>\n\
                    </tr>";

        pos++;

    });

    $("#datosNomina").append(filaDatos);
    $("#modalLoad").modal('toggle');
    
       $('#tablaDatosReg').DataTable({
         language: {
             search:         "Buscar:",
             "sZeroRecords":    "No se encontraron resultados"
         },
         "info":     false,
         "paging":   false,
         "order": [[ 3, "desc" ]]
    });
}

function consultarTotalDatos() {

    var empInt = $("#empresaInt").val();
    var empCli = $("#empUsu").val();
    var centrocosto = $("#centroCosto").val();
    var ciudad = $("#ciudad").val();
    var fecIni = $("#fecIni").val();
    var fecFin = $("#fecFin").val();
    var estado = $("#estado").val();
    var consecutivo = $("#consecutivo").val();

    $("#hrsFestivos").html("");
    $("#hrsDominicales").html("");
    $("#hrsOrdinarias").html("");
    $("#totalUsers").html("");
    $("#adicionales").html("");

    $.ajax({
        type: 'POST',
        url:"../../vista/consultaNominaVista/asincConsultaNomina.php",
        data: {
            accion: "totalDatos",
            empInt: empInt,
            empCli: empCli,
            centroCosto: centrocosto,
            ciudad: ciudad,
            fechaIni: fecIni,
            fechaFin: fecFin,
            estado: estado,
            consecutivo:consecutivo
        },
        dataType: "json",
        beforeSend: function() {
        },
        success: function(data) {
            console.log(data);
            $.each(data, function(llave, valor) {

                if (llave == 'hrsFestivos') {

                    $("#hrsFestivos").append(valor);

                }

                if (llave == 'hrsDominicales') {

                    $("#hrsDominicales").append(valor);

                }

                if (llave == 'hrsOrdinarias') {

                    $("#hrsOrdinarias").append(valor);

                }

                if (llave == 'totalUsuarios') {

                    if (valor == 0) {
                        $("#totalUsers").append("");
                    } else {
                        $("#totalUsers").append(valor);
                    }
                }

                if (llave == 'totalConceptos') {

                    var aux = formatPesos(parseFloat(valor));
                    
                    if(aux !== 'NaN,undefined'){                    
                        $("#adicionales").append(aux);                        
                    }else {
                        
                        $("#adicionales").append("");
                    }             

                }

            });

        }

    }).done(function() {
        
//        $("#contenedorDatosConsulta").toggle(1000);
        $("#contenedorDatosConsulta").slideDown(1000);
        
    });


}

function consulSolicitud(id) {

    var auxId = $("#" + id + "").html();
    console.log(auxId);
    $("#ocultoIdNomina").val(auxId);

    $.ajax({
        type: 'POST',
        url: '../../vista/aprobarNominaVista/asincAprobarNomina.php',
        data: {
            accion: "regByPlanilla",
            idPlanilla: auxId
        },
        dataType: "json",
        beforeSend: function() {
            
            $("#modalLoad").modal('toggle');

        },
        success: function(data) {
            
            console.log(data);
            var filas = '';
            var pos = 1;
            var totalHabiles = 0;
            var totalDominicales = 0;
            var totalFestivos = 0;
            var totalUsers = 0;
            
            if (data != '-1') {

                //Total conceptos
                var vlrTotalConceptos = totalConceptos(auxId);
                if ($.isNumeric(vlrTotalConceptos) !== true) {
                    vlrTotalConceptos = 0;
                }
                vlrTotalConceptos = formatPesos(vlrTotalConceptos);
                $("#totalAdicionales").html(vlrTotalConceptos);
                //fin Total concepos

                $("#filaEncabezados").html("");
                 $("#datosUsuario").html("");

                $("#filaEncabezados").append(
                        "<td class='tdNum'>Cedula</td>\n\
                 <td class='tdText'>Nombre</td>\n\
                 <td class='tdNum'>Hrs Habiles</td>\n\
                 <td class='tdNum'>Hrs Dominicales</td>\n\
                 <td class='tdNum'>Hrs festivos</td>\n\
                 <td class='tdNum'>Adicionales</td>"
                        );

                $.each(data, function(llave, valor) {

                    var diash = '';
                    var diasd = '';
                    var diasf = '';
                    
                            filas = filas + "<tr id='" + pos + "FilaDatos' >";
                            filas = filas + "<td id = '" + pos + "idUser' class='tdNum'>" + valor.id_usuario + "</td>\n\
                            <td id = '" + pos + "nomUser' class='tdText'>" + valor.ape_empl + " " + valor.nom_empl + "</td>\n\
                            <td id = '" + pos + "hrsHabiles' class='tdNum'>" + valor.horas_habiles + "</td>\n\
                            <td id = '" + pos + "hrsDominic' class='tdNum'>" + valor.horas_dominicales + "</td>\n\
                            <td id = '" + pos + "hrsFesti' class='tdNum'>" + valor.horas_festivos + "</td>\n\
                            <td id = '" + pos + "celConceptos' class='tdNum'><input type='button' class='btn btn-link' id='btnConceptos" + pos + "' onclick='mostrarconceptos(this.id);' value='Consultar'><input type='hidden' id='idPlanilla" + pos + "' value='" + valor.id + "'></td>";

                        filas = filas + "</tr>";
                        
                        totalHabiles = parseFloat(totalHabiles) + parseFloat(valor.horas_habiles);
                        totalDominicales = parseFloat(totalDominicales) + parseFloat(valor.horas_dominicales);
                        totalFestivos = parseFloat(totalFestivos) + parseFloat(valor.horas_festivos);
                        totalUsers++;
                        pos++;                   

                });
                
                $("#hrsHabiles2").html(totalHabiles);
                $("#hrsDominicales2").html(totalDominicales);
                $("#hrsFestivos2").html(totalFestivos);
                $("#totalUsers2").html(totalUsers);

                $("#datosUsuario").append(filas);
                
                $("#modalLoad").modal('toggle');

            }
        }
    });

    $("#modaldetNomina").modal('show');

}

function totalConceptos(id) {

    var idPlanilla = id;
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

function mostrarDetAdicionales() {

    var idPlanilla = $("#ocultoIdNomina").val();

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
        },
        success: function() {
        }

    }).done(function(data) {
        
        console.log(data);
        
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
                                            <td class='tdNum'>Nombre</td><td class='tdNum'>Valor</td>\n\
                                        </tr>\n\
                                    </thead>\n\
                                    <tbody>\n\
                                    " + filaDetConceptos + "\
                                    <tr class='active danger'><td class='tdNum'>Total</td><td class='tdNum'>" + acumDetConceptos + "</td></tr><tbody>\n\
                                  </table>";

        $("#tituloModalDatos").html("Detalle Conceptos");
        $("#cuerpoModalDatos").html(tablaDetConceptos);
        $("#modalInfoDatos").modal('toggle');

    });
}

function detAdicionales() {

    var longreg = $('#tablaDatosReg >tbody >tr').length;
    var regNom = new Array();

    for (var i = 0; i < longreg; i++) {

        regNom[i] = $("#conse-" + i + "").html();

    }

    $.ajax({
        type: 'POST',
        url: '../../vista/aprobarNominaVista/asincAprobarNomina.php',
        data: {
            accion: "detAdicionales",
            idRegNominas: regNom
        },
        dataType: 'json',
        beforeSend: function() {
            $("#modalLoad").modal('show');            
        },
        success: function(data) {



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

        $("#tituloModalDatos").html("Detalle Adicionales");
        $("#cuerpoModalDatos").html(tablaDetConceptos);
        $("#modalLoad").modal('hide');          
        $("#modalInfoDatos").modal('show');

    });

}

function mostrarconceptos(id) {

    var longId = id.length;
    var idLinea = id.substring(12, longId);

    var idPlanilla = $("#ocultoIdNomina").val();
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
        $("#modalInfoDatos").modal('toggle');

    });


}

function detFestivos() {

    var empInt = $("#empresaInt").val();
    var empCli = $("#empUsu").val();
    var centrocosto = $("#centroCosto").val();
    var ciudad = $("#ciudad").val();
    var fecIni = $("#fecIni").val();
    var fecFin = $("#fecFin").val();
    var estado = $("#estado").val();
    var consecutivo = $("#consecutivo").val();
    var filasDetFestivos = '';
    var tablaDetFestivos = '';

    $.ajax({
        type: 'POST',
        url: '../../vista/consultaNominaVista/asincConsultaNomina.php',
        data: {
            accion: "detFestivos",
            empInt: empInt,
            empCli: empCli,
            centroCosto: centrocosto,
            ciudad: ciudad,
            fechaIni: fecIni,
            fechaFin: fecFin,
            estado: estado,
            consecutivo:consecutivo
        },
        dataType: "json",
        beforeSend: function() {
            $("#modalLoad").modal('show');
        },
        success: function(data) {

            console.log(data);

            if (data != '-1' && data != '0') {

                $.each(data, function(llave, valor) {

                    filasDetFestivos = filasDetFestivos + "<tr>\n\
                        <td class='tdText'>" + valor.nombre + " " + valor.apellido + " </td><td class='tdNum'>" + valor.hrsFest + "</td>\n\
                        </tr>";

                });

                tablaDetFestivos = "<table class='table table-hover table-striped table-condensed'>\n\
                <thead>\n\
                <tr>\n\
                <td class='tdNum'>Empleado</td><td class='tdNum'>Hrs Festivos</td>\n\
                </tr>\n\
                <thead>\n\
                <tbody>\n\
                " + filasDetFestivos + "\
                </tbody>\n\
                </table>";

                $("#modalLoad").modal('hide');
                $("#tituloModalDatos").html("Detalle Festivos");
                $("#cuerpoModalDatos").html(tablaDetFestivos);
                $("#modalInfoDatos").modal('show');

            } else if (data == '0') {

                $("#modalLoad").modal('hide');
                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("No existen horas festivas registradas");
                $("#modalInfo").modal('toggle');

            } else if (data == '-1') {

                $("#modalLoad").modal('hide');
                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("Ha ocurrido un fallo. Por favor vuelva a intentarlo. Si el proble persiste cominiquelo al departamento de desarrollo");
                $("#modalInfo").modal('toggle');
            }
        }

    });

}

function detDominicales() {

    var empInt = $("#empresaInt").val();
    var empCli = $("#empUsu").val();
    var centrocosto = $("#centroCosto").val();
    var ciudad = $("#ciudad").val();
    var fecIni = $("#fecIni").val();
    var fecFin = $("#fecFin").val();
    var estado = $("#estado").val();
    var consecutivo = $("#consecutivo").val();
    var filasDetDominicales = '';
    var tablaDetDominicales = '';

    $.ajax({
        type: 'POST',
        url: '../../vista/consultaNominaVista/asincConsultaNomina.php',
        data: {
            accion: "detDominicales",
            empInt: empInt,
            empCli: empCli,
            centroCosto: centrocosto,
            ciudad: ciudad,
            fechaIni: fecIni,
            fechaFin: fecFin,
            estado: estado,
            consecutivo:consecutivo
        },
        dataType: "json",
        beforeSend: function() {
            $("#modalLoad").modal('show');
        },
        success: function(data) {

            console.log(data);

            if (data != '-1' && data != '0') {

                $.each(data, function(llave, valor) {

                    filasDetDominicales = filasDetDominicales + "<tr>\n\
                        <td class='tdText'>" + valor.nombre + " " + valor.apellido + " </td><td class='tdNum'>" + valor.hrsDom + "</td>\n\
                        </tr>";

                });

                tablaDetDominicales = "<table class='table table-hover table-striped table-condensed'>\n\
                <thead>\n\
                <tr>\n\
                <td class='tdText'>Empleado</td><td class='tdNum'>Hrs Domincales</td>\n\
                </tr>\n\
                <thead>\n\
                <tbody>\n\
                " + filasDetDominicales + "\
                </tbody>\n\
                </table>";

                $("#modalLoad").modal('hide');
                $("#tituloModalDatos").html("Detalle Dominicales");
                $("#cuerpoModalDatos").html(tablaDetDominicales);
                $("#modalInfoDatos").modal('show');

            } else if (data == '0') {

                $("#modalLoad").modal('hide');
                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("No existen horas dominicales registradas");
                $("#modalInfo").modal('toggle');

            } else if (data == '-1') {

                $("#modalLoad").modal('hide');
                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("Ha ocurrido un fallo. Por favor vuelva a intentarlo. Si el proble persiste cominiquelo al departamento de desarrollo");
                $("#modalInfo").modal('toggle');
            }
        }

    });


}

function generarExcel(id){

    var longId = id.lenght;
    var auxId = id.substring(6,longId);    
    var consecutivo = $("#conse-"+auxId+"").html();
    
    $.ajax({
        
        type: 'POST',
        url:"../../vista/consultaNominaVista/asincConsultaNomina.php",
        data:{
            accion:"excel",
            consecutivo:consecutivo
        },
        dataType:"json",
        beforeSend:function(){
            
            $("#modalLoad").modal('show');
        },
        success:function(data){
            
            if(data != '-1'){
                
                $("#modalLoad").modal('hide');
                window.open(data);
                
            }else{
                
                $("#modalLoad").modal('hide');
                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("Ha ocurrido un fallo. Por favor vuelva a intentarlo. Si el proble persiste cominiquelo al departamento de desarrollo");
                $("#modalInfo").modal('toggle');
                
            }
            
            
        }
        
    }).done(function(){}); 
    
}

function generarPlano(id){
    
    var longId = id.lenght;
    var auxId = id.substring(6,longId);    
    var consecutivo = $("#conse-"+auxId+"").html();
    
    $.ajax({
        
        type: 'POST',
        url: "../../vista/consultaNominaVista/asincConsultaNomina.php",
        data:{
            accion:"plano",
            consecutivo:consecutivo            
        },
        dataType:"json",
        beforeSend:function(){},
        success: function(data) {

            if (data != '-1') {

                $("#modalLoad").modal('hide');
                window.open(data);

            } else {

                $("#modalLoad").modal('hide');
                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("Ha ocurrido un fallo. Por favor vuelva a intentarlo. Si el proble persiste cominiquelo al departamento de desarrollo");
                $("#modalInfo").modal('toggle');

            }

        }
        
    }).done(function(){});

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

function formatPesos(num) {
    var p = num.toFixed(1).split(".");
    return  p[0].split("").reverse().reduce(function(acc, num, i, orig) {
        return  num + (i && !(i % 3) ? "." : "") + acc;
    }, "") + "," + p[1];
}