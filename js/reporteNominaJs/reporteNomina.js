$(document).on("ready", inicio);

function inicio() {

    $('#mes').datepicker({
        language: "es",
        format: "mm-yyyy",
        viewMode: "months",
        minViewMode: "months"
    });

}

function guardaradicionales() {

    arregloUsuAdicionales = construAdicionales();

    var empInt = $("#empresaInt").val();
    var empCli = $("#empUsu").val();
    var centroCosto = $("#centroCosto").val();
    var ciudad = $("#ciudad").val();
    var periodo = $("#mes").val();
    var quincena = $("#quincena").val();

    $.ajax({
        type: 'POST',
        url: "../../vista/reporteNominaVista/asincReporteNomina.php",
        data: {
            accion: "guardarAdicionales",
            arregloUsuAdicionales: arregloUsuAdicionales,
            empInt: empInt,
            empCli: empCli,
            centroCosto: centroCosto,
            ciudad: ciudad,
            periodo: periodo,
            quincena: quincena
        },
        dataType: "json",
        beforeSend: function() {

            $('#modalLoad').modal({backdrop: 'static', keyboard: true});

        },
        success: function(data) {

            $('#modalLoad').modal('toggle');
//
//            if (data == '-1') {
//
//                $("#tituloModal").html("Advertencia");
//                $("#cuerpoModal").html("Ha ocurrido un error en el registro, por favor vuelva a intentarlo. Si el fallo persiste comuniquese con el departamento de desarrollo.");
//                $("#modalInfo").modal('toggle');
//
//
//            } else {
//
//                $("#tituloModal").html("Información");
//                $("#cuerpoModal").html("Se ha guardado exitosamento los registros.");
//                $("#modalInfo").modal('toggle');
//
//            }

        }
    }).done(function() {



    });


}

function guardardiashabiles() {

    arregloUsuHabiles = construArregloHabiles();

    var empInt = $("#empresaInt").val();
    var empCli = $("#empUsu").val();
    var centroCosto = $("#centroCosto").val();
    var ciudad = $("#ciudad").val();
    var periodo = $("#mes").val();
    var quincena = $("#quincena").val();

    $.ajax({
        type: 'POST',
        url: "../../vista/reporteNominaVista/asincReporteNomina.php",
        data: {
            accion: "guardarHabiles",
            arregloUsuHabiles: arregloUsuHabiles,
            empInt: empInt,
            empCli: empCli,
            centroCosto: centroCosto,
            ciudad: ciudad,
            periodo: periodo,
            quincena: quincena
        },
        dataType: "json",
        beforeSend: function() {

            $('#modalLoad').modal({backdrop: 'static', keyboard: true});

        },
        success: function(data) {
            
            console.log(data);

            $('#modalLoad').modal('toggle');

            if (data == '-1') {

                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("Ha ocurrido un error en el registro, por favor vuelva a intentarlo. Si el fallo persiste comuniquese con el departamento de desarrollo.");
                $("#modalInfo").modal('toggle');

            } else {    
                
                var json = JSON.parse(data);
                
                console.log(json.id);
                console.log(json.estado);
                
                $("#tituloModal").html("Información");
                $("#cuerpoModal").html("Se ha guardado exitosamento los registros.");
                $("#modalInfo").modal('toggle');

            }




        }
    }).done(function() {



    });

}

//a modificar...
function guardarNomina() {

    arregloUsuHabiles = construArregloHabiles();
    arregloUsuAdicionales = construAdicionales();

    var empInt = $("#empresaInt").val();
    var empCli = $("#empUsu").val();
    var centroCosto = $("#centroCosto").val();
    var ciudad = $("#ciudad").val();
    var periodo = $("#mes").val();
    var quincena = $("#quincena").val();

    $.ajax({
        type: 'POST',
        url: "../../vista/reporteNominaVista/asincReporteNomina.php",
        data: {
            accion: "guardar",
            arregloUsuHabiles: arregloUsuHabiles,
            arregloUsuAdicionales: arregloUsuAdicionales,
            empInt: empInt,
            empCli: empCli,
            centroCosto: centroCosto,
            ciudad: ciudad,
            periodo: periodo,
            quincena: quincena

        },
        dataType: "json",
        beforeSend: function() {
        },
        success: function() {
        }

    }).done(function() {


    });

    console.log(arregloUsuHabiles);
    console.log(arregloUsuAdicionales);

}

function construArregloHabiles() {

    arregloUsuarios = [];
    i = 0;

    $("#tablaHabiles tbody tr").each(function(index) {

        arregloUsuarios[i] = [];
        j = 0;

        $(this).children("td").each(function(index2) {

            var auxId = '';

            if (index2 <= 1) {

                arregloUsuarios[i][j] = $(this).text().trim();

            } else {

                propiedad = $(this).find('input');
                auxId = propiedad.attr('id');

                if ($("#" + auxId).prop("checked")) {

                    arregloUsuarios[i][j] = auxId;

                } else {

                    arregloUsuarios[i][j] = $("#" + auxId).val();
                }

            }

            j = j + 1;
        });

        i = i + 1;

    });

    return arregloUsuarios;

}

function construAdicionales() {

    arregloAdicionales = [];

    m = 0;

    $("#tablaAdicionales tbody tr").each(function(index) {

        arregloAdicionales[m] = [];
        n = 0;
        $(this).children("td").each(function(index2) {

            var auxId = '';

            if (index2 <= 1) {

                arregloAdicionales[m][n] = $(this).text().trim();

            } else {

                propiedad = $(this).find('input');
                auxId = propiedad.attr('id');

                if ($("#" + auxId).prop("checked")) {

                    arregloAdicionales[m][n] = auxId;

                } else {

                    arregloAdicionales[m][n] = $("#" + auxId).val();
                }

            }

            n = n + 1;

        });
        m = m + 1;
    });

    return arregloAdicionales;

}

function limpiarForm() {

    $("#empresaInt").prop('disabled', false);
    $("#empUsu").prop('disabled', false);
    $("#centroCosto").prop('disabled', false);
    $("#ciudad").prop('disabled', false);
    $("#mes").prop('disabled', false);
    $("#quincena").prop('disabled', false);

    $("#divDiasHabiles").fadeOut(1000);
    $("#divAdicionales").fadeOut(1000);
    $("#guardar").fadeOut(1000);
    $("#finalizar").fadeOut(1000);
}

function consultarCC() {

    var idEmpInt = $("#empresaInt").val();
    var idEmpUsu = $("#empUsu").val();

    $.ajax({
        type: 'POST',
        url: '../../vista/reporteNominaVista/asincReporteNomina.php',
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
            }
            else {

                var datos = data;
                $("#centroCosto").html("");
                $("#centroCosto").append(
                        "<option value=''></option>"
                        );
                $.each(datos, function(llave, valor) {

                    $("#centroCosto").append(
                            "<option value='" + valor.cod_ccos + "'>" + valor.nom_clie + "</option>"
                            );
                });

            }

        }

    });

}

function consultarEmpClienteBySupervisor() {

    var idEmpInt = $("#empresaInt").val();

    $.ajax({
        type: 'POST',
        url: "../../vista/reporteNominaVista/asincReporteNomina.php",
        data: {
            accion: "consultaClientes",
            idEmpInt: idEmpInt
        },
        dataType: "json",
        beforeSend: function() {
        },
        success: function(data) {


            if (data == -1) {
            }
            else {

                var datos = data;
                $("#empUsu").html("");
                $("#empUsu").append(
                        "<option value=''></option>"
                        );
                $.each(datos, function(llave, valor) {

                    $("#empUsu").append(
                            "<option value='" + llave + "'>" + valor + "</option>"

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


    if (empInt != '' && empCli != '' && centroCosto != '' && ciudad != '') {
        consultarUsuarios();
    }

}

function valExistencia() {

    var empInt = $("#empresaInt").val();
    var empCli = $("#empUsu").val();
    var centroCosto = $("#centroCosto").val();
    var ciudad = $("#ciudad").val();
    var periodo = $("#mes").val();

    $.ajax({
        type: 'POST',
        url: "../../vista/reporteNominaVista/asincReporteNomina.php",
        data: {
            accion: "consultarExistencia",
            empInt: empInt,
            empCli: empCli,
            centroCosto: centroCosto,
            ciudad: ciudad,
            periodo: periodo

        },
        dataType: "json",
        beforeSend: function() {


        },
        success: function() {
        }

    });

}

function consultarUsuarios() {

    var empInt = $("#empresaInt").val();
    var empCli = $("#empUsu").val();
    var centroCosto = $("#centroCosto").val();
    var ciudad = $("#ciudad").val();

    $.ajax({
        type: 'POST',
        url: "../../vista/reporteNominaVista/asincReporteNomina.php",
        data: {
            accion: "consultarUsuarios",
            empInt: empInt,
            empCli: empCli,
            centroCosto: centroCosto,
            ciudad: ciudad
        },
        dataType: "json",
        beforeSend: function() {
            $('#modalLoad').modal({backdrop: 'static', keyboard: true});
        },
        success: function() {
        }

    }).done(function(data) {

        if (data != '-1') {

            construirTabla(data);
            $("#empresaInt").prop('disabled', true);
            $("#empUsu").prop('disabled', true);
            $("#centroCosto").prop('disabled', true);
            $("#ciudad").prop('disabled', true);
            $("#mes").prop('disabled', true);
            $("#quincena").prop('disabled', true);

        } else {
        }

    });

}

function construirTabla(data) {

    arregloDomingos = new Array();
    arregloFestivos = new Array();

    l = 0;
    m = 0;

    if (data != '-1') {

        $("#filaEncabezados").html("");

        $("#filaEncabezados").append(
                "<td>Nombre</td>\n\
                 <td>Cedula</td>"
                );

        var numDias = 0;

        if ($("#quincena").val() == 1) {

            var k = 1;
            var arregloDias = [];
            var ind = 1;

            for (var j = 1; j < 16; j++) {

                var fecha = $("#mes").val();
                var arreglofecha = fecha.split("-");

                if (j < 10) {
                    arreglofecha[2] = "0" + j;
                } else {
                    arreglofecha[2] = j;
                }

                var fecha1 = new Date(arreglofecha[1], arreglofecha[0] - 1, arreglofecha[2]);
                var fecha2 = fecha1.toString();

                var dia = fecha2.substr(0, 3);
                var festivo = consultarFestivo(arreglofecha);

                if (dia != 'Sun' && festivo !== true) {

                    $("#filaEncabezados").append(
                            "<td>Dia " + j + "</td>"
                            );

                    numDias = numDias + 1;
                    arregloDias[ind] = j;
                    ind = ind + 1;

                }

            }

            $("#filaEncabezados").append("<td>Observación</td>");


        } else if ($("#quincena").val() == 2) {

            var k = 16;
            var arregloDias = [];
            var ind = 1;

            for (var j = 16; j < 31; j++) {

                festivo = '';
                var fecha = $("#mes").val();
                var arreglofecha = fecha.split("-");

                arreglofecha[2] = j;

                var fecha1 = new Date(arreglofecha[1], arreglofecha[0] - 1, arreglofecha[2]);
                var fecha2 = fecha1.toString();

                var dia = fecha2.substr(0, 3);
                festivo = consultarFestivo(arreglofecha);

                if (dia != 'Sun' && festivo != true) {

                    $("#filaEncabezados").append(
                            "<td>Dia " + j + "</td>"
                            );

                    numDias = numDias + 1;
                    arregloDias[ind] = j;
                    ind = ind + 1;

                } else {
                }
            }

            $("#filaEncabezados").append("<td>Observación</td>");

        }

        var i = 1;
        $("#datosUsuario").html("");

        var filas = '';

        $.each(data, function(llave, valor) {

            filas = filas + "<tr id='fila" + i + "'><td class= 'nombres'>" + valor.nom_empl + " " + valor.ape_empl + "</td><td>" + valor.cod_empl + "</td>";

            for (n = 1; n <= numDias; n++) {

                filas = filas + "<td><input id='" + i + "dia" + arregloDias[n] + "' name='" + i + "dia" + arregloDias[n] + "' type=checkbox checked='checked'></td>";

            }

            filas = filas + "<td><input id='observaciones" + i + "'name='observaciones" + i + "' class=''></td></tr>";

            i = i + 1;

        });

        $("#datosUsuario").append(filas);


        construirTablaAdicionales(data, arregloDomingos, arregloFestivos);


    } else {
    }
}

function construirTablaAdicionales(data) {

    diasCheckAdicionales = '';
    encabezadosAdicionales = '';
    l = 1;
    m = 1;

    //consulta de domingos y festivos
    for (var j = 1; j <= 31; j++) {

        festivo = '';
        var fecha = $("#mes").val();
        var arreglofecha = fecha.split("-");

        if (j < 10) {
            arreglofecha[2] = "0" + j;
        } else {
            arreglofecha[2] = j;
        }

        var fecha1 = new Date(arreglofecha[1], arreglofecha[0] - 1, arreglofecha[2]);
        var fecha2 = fecha1.toString();

        var dia = fecha2.substr(0, 3);
        festivo = consultarFestivo(arreglofecha);

        if (dia != 'Sun' && festivo != true) {
        }
        else {

            if (dia == 'Sun') {
                arregloDomingos[l] = j;
                l = l + 1;
            } else {
                arregloFestivos[m] = j;
                m = m + 1;
            }
        }
    }
    //fin consulta de domingos

    longDomingos = arregloDomingos.length;
    longFestivos = arregloFestivos.length;

    if (data != '-1') {

        $("#filaEncabezadosAdicionales").html("");

        for (i = 1; i < longDomingos; i++) {

            encabezadosAdicionales = encabezadosAdicionales + "<td>D " + arregloDomingos[i] + "</td>";
//            diasCheckAdicionales = diasCheckAdicionales + "<td><input id='" + i + "diaDominical" + arregloDomingos[i] + "' name='" + i + "dia" + arregloDomingos[i] + "' type=checkbox></td>";

        }

        for (i = 1; i < longFestivos; i++) {

            encabezadosAdicionales = encabezadosAdicionales + "<td>F " + arregloFestivos[i] + "</td>";
//            diasCheckAdicionales = diasCheckAdicionales + "<td><input id='" + i + "diaFestivo" + arregloFestivos[i] + "' name='" + i + "dia" + arregloFestivos[i] + "' type=checkbox></td>";

        }

        $("#filaEncabezadosAdicionales").append(
                "<td>Nombre</td>\n\
                 <td>Cedula</td>\n\
                 " + encabezadosAdicionales + " \n\
                 <td>HE</td>\n\
                 <td>HEN</td>\n\
                 <td>HEF</td>\n\
                 <td>HEFN</td>\n\
                 <td>HED</td>\n\
                 <td>HEDN</td>\n\
                 <td>RN</td>\n\
                 <td>AUX_MOV</td>\n\
                 <td>Comisiones</td>\n\\n\
                 <td>Observaciones</td>"
                );



        $("#datosUsuarioAdiconales").html("");
        k = 1;
        $.each(data, function(llave, valor) {

            diasCheckAdicionales = '';

            for (i = 1; i < longDomingos; i++) {

//            encabezadosAdicionales = encabezadosAdicionales + "<td>D " + arregloDomingos[i] + "</td>";
                diasCheckAdicionales = diasCheckAdicionales + "<td><input id='" + k + "diaDominic" + arregloDomingos[i] + "' name='" + k + "diaDominic" + arregloDomingos[i] + "' type=checkbox></td>";

            }

            for (i = 1; i < longFestivos; i++) {

//            encabezadosAdicionales = encabezadosAdicionales + "<td>F " + arregloFestivos[i] + "</td>";
                diasCheckAdicionales = diasCheckAdicionales + "<td><input id='" + k + "diaFestivo" + arregloFestivos[i] + "' name='" + k + "diaFestivo" + arregloFestivos[i] + "' type=checkbox></td>";

            }

            $("#datosUsuarioAdiconales").append(
                    "<tr id='filaAdicionales" + k + "'>\n\
                              <td class= 'nombres'>" + valor.nom_empl + " " + valor.ape_empl + "</td>\n\
                              <td>" + valor.cod_empl + "</td>\n\
                              " + diasCheckAdicionales + "\n\
                              <td><input id='he" + k + "'name='he" + k + "' class='inputTabla'></td>\n\
                              <td><input id='hen" + k + "'name='hen" + k + "' class='inputTabla'></td>\n\
                              <td><input id='hef" + k + "'name='hef" + k + "' class='inputTabla'></td>\n\
                              <td><input id='hefn" + k + "'name='hefn" + k + "' class='inputTabla'></td>\n\
                              <td><input id='hed" + k + "'name='hed" + k + "' class='inputTabla'></td>\n\
                              <td><input id='hedn" + k + "'name='hedn" + k + "' class='inputTabla'></td>\n\
                              <td><input id='rn" + k + "'name='rn" + k + "' class='inputTabla'></td>\n\
                              <td><input id='auxmov" + k + "'name='auxmov" + k + "' class='inputTabla'></td>\n\
                              <td><input id='com" + k + "'name='com" + k + "' class='inputTabla'></td>\n\
                              <td><input id='obserAdicionales" + k + "'name='obserAdicionales" + k + "' class=''></td>\n\
                              </tr>"
                    );

            k = k + 1;

        });

    } else {
    }

    $("#finalizar").fadeIn(2500);
    $("#guardar").fadeIn(2000);
    $("#divDiasHabiles").fadeIn(1000);
    $("#divAdicionales").fadeIn(1500);
    $('#modalLoad').modal('toggle');


}

function consultarFestivo(fecha1) {

    valfestivo = '';

    $.ajax({
        type: 'POST',
        url: "../../vista/reporteNominaVista/asincReporteNomina.php",
        data: {
            accion: "consultarFestivo",
            fecha: fecha1

        },
        dataType: "json",
        async: false,
        beforeSend: function() {
        },
        success: function(data) {
        }

    }).done(function(data) {

        if (data == '1') {
            valfestivo = true;
        } else {
            valfestivo = false;
        }

    });

    return valfestivo;

}