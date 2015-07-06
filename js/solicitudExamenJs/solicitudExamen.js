function consultarEmpClienteSE() {

    var idEmpInt = $("#empresaInt").val();

    $.ajax({
        type: 'POST',
        url: "../../vista/solicitudExamenVista/asincSolicitudExamen.php",
        data: {
            accion: "consultaEmpUsuarias",
            idEmpInt: idEmpInt
        },
        dataType: "json",
        beforeSend: function() {

           $('#modalLoad').modal({backdrop: 'static', keyboard: true});

        },
        success: function(data){    
                        
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

    }).done(function() {
       
        $("#empUsu").val("");
        $("#centroCosto").val("");
        $("#nivel").val("");
//        $("#campoNivel").css("display", "none");
        $("#campoNivel").fadeOut("slow");

        consultarCiudades();
        consultarCargo(idEmpInt);


    });

}

function consultarCiudades() {

    var idEmpInt = $("#empresaInt").val();

    $.ajax({
        type: 'POST',
        url: "../../vista/solicitudExamenVista/asincSolicitudExamen.php",
        data: {
            accion: "consultarCiudades",
            idEmpInt: idEmpInt
        },
        datatype: "json",
        beforeSend: function() {
        },
        success: function(data) {

            if (data == -1) {

            } else {

                var datos = JSON.parse(data);
                $("#ciudad").html("");
                $("#ciudad").append(
                        "<option value=''></option>"
                        );
                $.each(datos, function(llave, valor) {

                    $("#ciudad").append(
                            "<option value='" + valor.id_ciudad + "'>" + valor.nombre + "</option>"
                            );

                });

            }

        }

    }).done(function() {


        $("#modalLoad").modal('toggle');
    });


}

function consultarTipoFac() {

    var idCliInt = $("#empUsu").val();
    var idEmpInt = $("#empresaInt").val();
    var tipoFac;
    var arbClie;
    var idCliKac;

    $("#centroCosto").val("");
    $("#nivel").val("");
//    $("#campoNivel").css("display", "none");
    $("#campoNivel").fadeOut("slow");

    $.ajax({
        type: 'POST',
        url: "../../vista/solicitudExamenVista/asincSolicitudExamen.php",
        data: {
            accion: "consultarTipoFac",
            idCliInt: idCliInt,
            idEmpInt: idEmpInt
        },
        datatype: "json",
        beforeSend: function() {

            $('#modalLoad').modal({backdrop: 'static', keyboard: true});
        },
        success: function(data) {

            if (data == -1) {

                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("No existe la parametrizacion correspondiente al tipo de facturación para el cliente seleccionado.");
                $("#modalInfo").modal('toggle');

                $("#centroCosto").html("");

                $("#modalLoad").modal('toggle');

            } else {

                var datos = JSON.parse(data);

                $.each(datos, function(llave, valor) {

                    tipoFac = valor.tipo_facturacion;
                    arbClie = valor.arbol_cliente;
                    idCliKac = valor.id_cliente_kactus;

                });

                consultarCC(idCliInt, idEmpInt, tipoFac, arbClie, idCliKac);
                consultarCategoriaExam(idCliInt, idEmpInt);
                $("#tipoFacOculto").val(tipoFac);

            }

        }
    }).done(function() {
    });
}

function consultarCategoriaExam(idCliInt, idEmpInt) {

    $.ajax({
        type: 'POST',
        url: "../../vista/solicitudExamenVista/asincSolicitudExamen.php",
        data: {
            accion: "consultarCatExams",
            idCliInt: idCliInt,
            idEmpInt: idEmpInt
        },
        datatype: "json",
        beforeSend: function() {

        },
        success: function(data) {

            if (data == -1) {

            } else {

                var datos = JSON.parse(data);

                $("#catExam").html("");

                $("#catExam").append(
                        "<option value=''></option>"

                        );

                $.each(datos, function(llave, valor) {

                    $("#catExam").append(
                            "<option value ='" + valor.id_categoria_examen + "'>" + valor.nombre + "</option>"

                            );

                });

            }

        }

    });

}

function consultarCC(idCliInt, idEmpInt, tipoFac, arbClie, idCliKac) {

    $.ajax({
        type: 'POST',
        url: "../../vista/solicitudExamenVista/asincSolicitudExamen.php",
        data: {
            accion: "consultarCC",
            idCliInt: idCliInt,
            idEmpInt: idEmpInt
        },
        datatype: "json",
        beforeSend: function() {
        },
        success: function(data) {

            if (data == -1) {


            } else {

                var datos = JSON.parse(data);
                $("#centroCosto").html("");

                $("#centroCosto").append(
                        "<option value=''></option>"

                        );

                $.each(datos, function(llave, valor) {

                    $("#centroCosto").append(
                            "<option value ='" + valor.cod_clie + "'>" + valor.nom_clie + "-" + "" + valor.cod_clie + "</option>"

                            );

                });

                if (tipoFac != 1) {

                    consultarNivel(idCliInt, idEmpInt, tipoFac, arbClie, idCliKac);

                } else {

                    $("#modalLoad").modal('toggle');
                }
            }
        }
    });
}

function consultarNivel(idCliInt, idEmpInt, tipoFac, arbClie, idCliKac) {

    $.ajax({
        type: 'POST',
        url: "../../vista/solicitudExamenVista/asincSolicitudExamen.php",
        data: {
            accion: "consultarNivel",
            idCliInt: idCliInt,
            idEmpInt: idEmpInt,
            tipoFac: tipoFac,
            arbClie: arbClie,
            idCliKac: idCliKac

        },
        datatype: "json",
        beforeSend: function() {
        },
        success: function(data) {

        //  $("#campoNivel").css("display", "block");
            $("#campoNivel").fadeIn("slow");
            var datos = JSON.parse(data);
            $("#nivel").html("");

            $("#nivel").append(
                    "<option value=''></option>"

                    );

            $.each(datos, function(llave, valor) {

                $("#nivel").append(
                        "<option value='" + valor.cod_nive + "'>" + valor.nom_nive + "-" + valor.cod_nive + "</option>"
                        );

            });

        }

    }).done(function() {

        $("#modalLoad").modal('toggle');

    });
}

function consultarLab() {

    var idCiudad = $("#ciudad").val();

    $.ajax({
        type: 'POST',
        url: "../../vista/solicitudExamenVista/asincSolicitudExamen.php",
        data: {
            accion: "consultarLab",
            idCiudad: idCiudad
        },
        datatype: "json",
        beforeSend: function() {

            $('#modalLoad').modal({backdrop: 'static', keyboard: true});

        },
        success: function(data) {

            if (data == -1) {

                $("#lab").html("");

            } else {

                var datos = JSON.parse(data);
                $("#lab").html("");
                $("#lab").append(
                        "<option value=''></option>"
                        );

                $.each(datos, function(llave, valor) {

                    $("#lab").append(
                            "<option value ='" + valor.id_laboratorio + "'>" + valor.nombre + "</option>"

                            );

                });

            }

        }

    }).done(function() {

        $('#modalLoad').modal('toggle');

    });

}

function consultarCargo(idEmpInt) {

    $.ajax({
        type: 'POST',
        url: "../../vista/solicitudExamenVista/asincSolicitudExamen.php",
        data: {
            accion: "consultarCargo",
            idEmpInt: idEmpInt
        },
        dataType: "json",
        beforeSend: function() {
        },
        success: function(data) {

            //var datos = JSON.parse(data);
            var datos = data;

            $("#cargo").html("");
            $("#cargo").append(
                    "<option value=''></option>"
                    );

            $.each(datos, function(llave, valor) {

                $("#cargo").append(
                        "<option value ='" + valor.cod_carg + "'>" + valor.nom_carg + "</option>"

                        );
            });
        }
    }).done(function() {



    });

}

function consultarUser() {

    var idUser = $("#idUser").val();

    $.ajax({
        type: 'POST',
        url: "../../vista/solicitudExamenVista/asincSolicitudExamen.php",
        data: {
            accion: "consultarUser",
            idUser: idUser
        },
        datatype: "json",
        beforeSend: function() {

            $('#modalLoad').modal({backdrop: 'static', keyboard: true});

        },
        success: function(data) {

            if (data == -1) {

                $("#nomUser").val("");
                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("No existen un usuario registrado con el numero de identificacion ingresado.");
                $("#modalInfo").modal('toggle');

                //$('#modalLoad').modal('toggle');

            } else {

                $("#nomUser").val(data);

            }

        }

    }).done(function() {

        $('#modalLoad').modal('toggle');

    });

}

function reiniciar() {


    if ($("#empresaInt").prop('disabled') == true) {

        $("#idUser").val("");
        $("#nomUser").val("");
        $("#cargoId").val("");

    } else {

        document.getElementById("crearClienteForm").reset();

    }

}

function valVaciosSE() {

    var tipoFac = $("#tipoFacOculto").val();

    var empInt = $("#empresaInt").val();
    var empUsu = $("#empUsu").val();
    var nivel = $("#nivel").val();
    var centroCosto = $("#centroCosto").val();
    var ciudad = $("#ciudad").val();
    var lab = $("#lab").val();
    var idUser = $("#idUser").val();
    var nomUser = $("#nomUser").val();
    var cargo = $("#cargoId").val();
    var idUserLog = $("#idUserLog").val();
    
  

    var tipoReg = $("#tipoReg").val();

    if (tipoReg == 0) {

        if (tipoFac == 1) {

            if (empInt == '' || empUsu == '' || centroCosto == '' || ciudad == '' || lab == '' || idUser == '' || nomUser == '' || cargo == '') {

                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("Todos los campos son obligatorios");
                $("#modalInfo").modal('toggle');

            } else {

                registrarSolicitud(empInt, empUsu, centroCosto, nivel, ciudad, lab, idUser, nomUser, cargo, idUserLog);

            }

        } else {

            if (empInt == '' || empUsu == '' || centroCosto == '' || nivel == '' || ciudad == '' || lab == '' || idUser == '' || nomUser == '' || cargo == '') {

                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("Todos los campos son obligatorios");
                $("#modalInfo").modal('toggle');

            } else {

                registrarSolicitud(empInt, empUsu, centroCosto, nivel, ciudad, lab, idUser, nomUser, cargo, idUserLog);

            }

        }

    } else if (tipoReg == 1) {


    }



}

function registrarSolicitud(empInt, empUsu, centroCosto, nivel, ciudad, lab, idUser, nomUser, cargo, idUserLog) {

    var observ = $("#observ").val();

    $.ajax({
        type: 'POST',
        url: "../../vista/solicitudExamenVista/asincSolicitudExamen.php",
        data: {
            accion: "regSolicitud",
            empInt: empInt,
            empUsu: empUsu,
            centroCosto: centroCosto,
            nivel: nivel,
            ciudad: ciudad,
            lab: lab,
            observ: observ,
            idUser: idUser,
            nomUser: nomUser,
            cargo: cargo,
            idUserLog: idUserLog

        },
        datatype: "json",
        beforeSend: function() {

            $('#modalLoad').modal({backdrop: 'static', keyboard: true});

        },
        success: function(data) {

            if (data == -1) {

                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("Ha ocurrido un error en el registro, por favor vuelva a intentarlo. Si el problema persiste por favor comuniquese con el departamento de desarrollo");
                $("#modalInfo").modal('toggle');


            } else {

                $("#empresaInt").prop('disabled', true);
                $("#empUsu").prop('disabled', true);
                $("#nivel").prop('disabled', true);
                $("#centroCosto").prop('disabled', true);
                $("#ciudad").prop('disabled', true);
                $("#lab").prop('disabled', true);
                $("#observ").prop('disabled', true);
                $("#idOrden").val(data);
                //$("#guardar").css("display", "none");
                $("#guardar").fadeOut("slow");

                $("#idUser").val("");
                $("#nomUser").val("");
                $("#cargoId").val("");

                consultarUsuariosOrden();

            }

        }

    });
}

function consultarUsuariosOrden() {


    var idOrden = $("#idOrden").val();

//    $("#guardarUser").css("display", "inline");
    $("#guardarUser").fadeIn("slow");
//    $("#guardar").css("display", "none");
    $("#guardar").fadeOut("slow");

    $.ajax({
        type: 'POST',
        url: "../../vista/solicitudExamenVista/asincSolicitudExamen.php",
        data: {
            accion: "consultarUsuariosOrden",
            idOrden: idOrden
        },
        datatype: "json",
        beforeSend: function() {
        },
        success: function(data) {

            if (data == -1) {

                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("Ha ocurrido un error en la consulta de los usuarios registrados por favor de clic en el boton 'Recargar tabla'.Si el problema persiste por favor comuniquese con el departamento de desarrollo");
                $("#modalInfo").modal('toggle');

//                $("#cosulUsersOrden").css("display", "inline");
                $("#cosulUsersOrden").fadeIn("slow");
                $('#modalLoad').modal('toggle');

            } else {

                var i = 0;
                $("#datosUsuarios").html("");
//              $("#tablaUsuarios").css("display", "block");
                $("#tablaUsuarios").fadeIn("slow");
                var datos = JSON.parse(data);

                $.each(datos, function(llave, valor) {

                    $("#datosUsuarios").append(
                            "<tr><td>" + valor.id_orden + "</td>\n\
                                 <td>" + valor.nombre + "</td>\n\
                                 <td>" + valor.cedula + "</td> \n\
                                 <td><input type='button' id='eliminar" + i + "' name='eliminar" + i + "' value='Eliminar' class='btn btn-link' onclick='confirmacionEliminarUser(" + i + ")'></td>\n\
                                 <input type='hidden' id='idReg" + i + "' name='idRef" + i + "' value='" + valor.id_examen_item_cedula + "'></tr>"
                            );

                    i = i + 1;

                });

                $("#cosulUsersOrden").css("display", "none");

                if ($('#tablaDatosUsuarios >tbody >tr').length == 0) {

//                    $("#tab2").css("display", "none");
                    $("#tab2").fadeOut("slow");

                } else {

//                    $("#tab2").css("display", "block");
                    $("#tab2").fadeIn("slow");
                }


            }

            $('#modalLoad').modal('toggle');
        }

    }).done(function() {



    });


}

function valVaciosUser() {

    var idUser = $("#idUser").val();
    var nomUser = $("#nomUser").val();
    var cargo = $("#cargoId").val();
    var idOrden = $("#idOrden").val();

    if (idUser == '' || nomUser == '' || cargo == '') {

        $("#tituloModal").html("Advertencia");
        $("#cuerpoModal").html("Los datos correspondientes al usuario son obligatorios");
        $("#modalInfo").modal('toggle');


    } else {

        registrarUsuario(idUser, nomUser, cargo, idOrden);

    }


}

function registrarUsuario(idUser, nomUser, cargo, idOrden) {

    $.ajax({
        type: 'POST',
        url: "../../vista/solicitudExamenVista/asincSolicitudExamen.php",
        data: {
            accion: "regUser",
            idUser: idUser,
            nomUser: nomUser,
            cargo: cargo,
            idOrden: idOrden
        },
        datatype: "json",
        beforeSend: function() {

            $('#modalLoad').modal({backdrop: 'static', keyboard: true});
        },
        success: function(data) {

            if (data == -1) {

                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("Ha ocurrido un error en la base de datos, por favor vuelva a intentarlo. Si el problema persiste por favor comuniquese con el departamento de desarrollo");
                $("#modalInfo").modal('toggle');
                $('#modalLoad').modal('toggle');

            } else if (data == -2) {

                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("El numero de identificación ingresado ya se encuentra registrado en esta orden");
                $("#modalInfo").modal('toggle');
                $('#modalLoad').modal('toggle');

            } else {
//
//                $("#tituloModal").html("Información");
//                $("#cuerpoModal").html("Registo exitoso");
//                $("#modalInfo").modal('toggle');

                $("#idUser").val("");
                $("#nomUser").val("");
                $("#cargoId").val("");

                consultarUsuariosOrden();
            }

        }


    }).done(function() {
    });


}

function confirmacionEliminarUser(number) {

    var idRel = $("#idReg" + number).val();
    $("#ocultoId").val(idRel);
    $("#modalConfirm").modal('toggle');

}

function eliminarUser() {

    $("#modalConfirm").modal('toggle');
    var idReg = $("#ocultoId").val();

    $.ajax({
        type: 'POST',
        url: "../../vista/solicitudExamenVista/asincSolicitudExamen.php",
        data: {
            accion: "eliminarUser",
            idReg: idReg

        },
        datatype: "json",
        beforeSend: function() {
        },
        success: function(data) {

            if (data == -1) {

                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("Ha ocurrido un error en la eliminación del registro, por favor vuelva a intentarlo. Si el fallo persiste por favor comuniquese con el departamento de desarrollo.");
                $("#modalInfo").modal('toggle');
                $("#modalLoad").modal('toggle');
                consultarUsuariosOrden();

            } else {

                $("#tituloModal").html("Información");
                $("#cuerpoModal").html("El registro ha sido eliminado.");
                $("#modalInfo").modal('toggle');
                $("#modalLoad").modal('toggle');
                consultarUsuariosOrden();

            }
        }

    });

}

function conultarExamenes() {

    var catego = $("#catExam").val();
    var nit = $("#empUsu").val();
    var idEmpInt = $("#empresaInt").val();

    $.ajax({
        type: 'POST',
        url: "../../vista/solicitudExamenVista/asincSolicitudExamen.php",
        data: {
            accion: "consulExamenes",
            catego: catego,
            nit: nit,
            idEmpInt: idEmpInt
        },
        datatype: "json",
        beforeSend: function() {

            $('#modalLoad').modal({backdrop: 'static', keyboard: true});

        },
        success: function(data) {

            $("#examen").html("");
            var i = 0;
            if (data == -1) {
            } else {

                var datos = JSON.parse(data);

                $.each(datos, function(llave, valor) {

                    $("#examen").append(
                            "<label class='checkbox' for='" + valor.id_examen + "'>\n\
                             <input type='checkbox' id='" + valor.id_examen + "' name='checkbox' name='" + valor.id_examen + "'>" + valor.nombre + "\
                             <input type='hidden' id='idExam" + i + "' value='" + valor.id_examen + "' ></label>"
                            );
                    i = i + 1;
                });

            }

        }

    }).done(function() {

        $('#modalLoad').modal('toggle');

    });
}

function valVacionExam() {

    var i = 0;
    var j = 0;
    var arregloIdExamenes = new Array();
    var idOrden = $("#idOrden").val();
    var cant = $('#examen >label').length;
    var total = cant;

    for (i = 0; i < cant; i++) {

        var val = $("#idExam" + i).val();

        var check = $('#' + val).is(":checked");


        if (check == false) {

            total = total - 1;

        } else {

            arregloIdExamenes[j] = $("#idExam" + i).val();
            j = j + 1;
        }

    }

    if (idOrden == '' || total == 0) {

        $("#tituloModal").html("Advertencia");
        $("#cuerpoModal").html("Debe seleccionar al menos un examen para ser registrado");
        $("#modalInfo").modal('toggle');

    } else {

        guardarExamen(idOrden, arregloIdExamenes);

    }

}

function guardarExamen(idOrden, arregloIdExamenes) {

    $.ajax({
        type: 'POST',
        url: "../../vista/solicitudExamenVista/asincSolicitudExamen.php",
        data: {
            accion: "registrarExamen",
            idOrden: idOrden,
            arregloIdExamenes: arregloIdExamenes
        },
        datatype: "json",
        beforeSend: function() {
            $('#modalLoad').modal({backdrop: 'static', keyboard: true});
        },
        success: function(data) {

            if (data == -1) {

                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("Ha ocurrido un error en la base de datos, por favor vuelva a intentarlo. Si el problema persiste por favor comuniquese con el departamento de desarrollo");
                $("#modalInfo").modal('toggle');

            } else if (data == 1) {

                $("#catExam").val("");
                $("#examen").html("");

                consultarExamenesOrden(idOrden);

            } else if (data == -2) {

                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("Ya existe el tipo de examen seleccionado en esta orden.");
                $("#modalInfo").modal('toggle');
                $('#modalLoad').modal('toggle');
            }
        }

    }).done(function() {


    });


}

function consultarExamenesOrden() {

    var idOrden = $("#idOrden").val();

    $.ajax({
        type: 'POST',
        url: "../../vista/solicitudExamenVista/asincSolicitudExamen.php",
        data: {
            accion: "consultarExamenesOrden",
            idOrden: idOrden
        },
        datatype: "json",
        beforeSend: function() {
            $('#modalLoad').modal({backdrop: 'static', keyboard: true});
        },
        success: function(data) {

            if (data == -1) {

//                $("#cosulExamsOrden").css("display", "inline");
                $("#cosulExamsOrden").fadeIn("slow");
//                $("#finalizarSol").css("display", "none");
                $("#finalizarSol").fadeOut("slow");

                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("Ha ocurrido un error en la consulta de los examenes registrados por favor de clic en el boton 'Recargar tabla'.Si el problema persiste por favor comuniquese con el departamento de desarrollo");
                $("#modalInfo").modal('toggle');


            } else {

                var i = 0;
                $("#datosExamen").html("");
//                $("#tablaExamen").css("display", "block");
                $("#tablaExamen").fadeIn("slow");
                var datos = JSON.parse(data);

                $.each(datos, function(llave, valor) {

                    $("#datosExamen").append(
                            "<tr><td>" + valor.id_orden + "</td>\n\
                                 <td>" + valor.nombre + "</td>\n\
                                 <td><input type='button' id='eliminar" + i + "' name='eliminar" + i + "' value='Eliminar' class='btn btn-link' onclick='confirmacionEliminarExam(" + i + ")'></td>\n\
                                 <input type='hidden' id='idItem" + i + "' name='idItem" + i + "' value='" + valor.id_item_orden_examen + "'></tr>"
                            );

                    i = i + 1;

                });

//                $("#cosulExamsOrden").css("display", "none");
                $("#cosulExamsOrden").fadeOut("slow");

                if ($('#tablaDatosExamen >tbody >tr').length == 0) {

//                    $("#finalizarSol").css("display", "none");
                      $("#finalizarSol").fadeOut("slow");

                } else {

//                    $("#finalizarSol").css("display", "inline");
                     $("#finalizarSol").fadeIn("slow");
                }

            }

        }

    }).done(function() {

        $('#modalLoad').modal('toggle');

    });

}

function confirmacionEliminarExam(number) {

    var idItem = $("#idItem" + number).val();
    $("#ocultoId2").val(idItem);
    $("#modalConfirm2").modal('toggle');

}

function eliminarExamen() {

    $("#modalConfirm2").modal('toggle');
    var idItem = $("#ocultoId2").val();
    var idOrden = $("#idOrden").val();

    $.ajax({
        type: 'POST',
        url: "../../vista/solicitudExamenVista/asincSolicitudExamen.php",
        data: {
            accion: "eliminarExam",
            idItem: idItem

        },
        datatype: "json",
        beforeSend: function() {
        },
        success: function(data) {

            if (data == -1) {

                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("Ha ocurrido un error en la eliminación del registro, por favor vuelva a intentarlo. Si el fallo persiste por favor comuniquese con el departamento de desarrollo.");
                $("#modalInfo").modal('toggle');
                consultarExamenesOrden(idOrden);

            } else {

                $("#tituloModal").html("Información");
                $("#cuerpoModal").html("El registro ha sido eliminado.");
                $("#modalInfo").modal('toggle');

                consultarExamenesOrden(idOrden);

            }
        }

    });

}

function reiniciarExam() {

    $("#catExam").val("");
    $("#examen").val("");

}

function confirmFinalizarSol() {

    $("#modalConfirm3").modal('toggle');

}

function finalizarSol() {

    $("#modalConfirm3").modal('toggle');
    var idOrden = $("#idOrden").val();

    var arregloUsers = new Array();
    var arregloExamenes = new Array();
    var idEmpInt = $("#empresaInt").val();

    var lengUser = $('#tablaDatosUsuarios >tbody >tr').length;

    var lengExams = $('#tablaDatosExamen >tbody >tr').length;

    for (i = 0; i < lengUser; i++) {

        arregloUsers[i] = $("#idReg" + i).val();

    }

    for (i = 0; i < lengExams; i++) {

        arregloExamenes[i] = $("#idItem" + i).val();

    }

    $.ajax({
        type: 'POST',
        url: "../../vista/solicitudExamenVista/asincSolicitudExamen.php",
        data: {
            accion: "finalizarSol",
            idOrden: idOrden,
            arregloUsers: arregloUsers,
            arregloExamenes: arregloExamenes,
            idEmpInt: idEmpInt
        },
        datatype: "json",
        beforeSend: function() {

            $('#modalLoad').modal({backdrop: 'static', keyboard: true});

        },
        success: function(data) {

            if (data == 1) {

                $("#tituloModal").html("Información");
                $("#cuerpoModal").html("La solicitud ha sido finalizada.");
                $("#modalInfo").modal('toggle');

                reiniciarForm();

                $('#modalLoad').modal('toggle');

            } else {

                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("Ha ocurrido un error en la finalización de la solicitud, por favor vuelva a intentarlo. Si el fallo persiste por favor comuniquese con el departamento de desarrollo.");
                $("#modalInfo").modal('toggle');

                $('#modalLoad').modal('toggle');
            }

        }

    }).done(function() {


    });



}

function reiniciarForm() {

    document.getElementById("crearClienteForm").reset();

    $("#empresaInt").prop('disabled', false);
    $("#empUsu").prop('disabled', false);
    $("#nivel").prop('disabled', false);
    $("#centroCosto").prop('disabled', false);
    $("#ciudad").prop('disabled', false);
    $("#lab").prop('disabled', false);
    $("#observ").prop('disabled', false);

//    $("#guardar").css("display", "inline");
    $("#guardar").fadeIn("slow");
    
//    $("#guardarUser").css("display", "none");
    $("#guardarUser").fadeOut("slow");
    
//    $("#finalizarSol").css("display", "none");
    $("#finalizarSol").fadeOut("slow");
    
//  $("#tablaUsuarios").css("display", "none");
    $("#tablaUsuarios").fadeOut("slow");
    
    
//    $("#tablaExamen").css("display", "none");
    $("#tablaExamen").fadeOut("slow");

    $("#catExam").val("");
    $("#examen").val("");
    $("#idOrden").val("");

//    $("#tab2").css("display", "none");
    $("#tab2").fadeOut("slow");
    
    
//    $("#tab1").css("display", "block");
    $("#tab1").css("slow");

    $("#tab2").removeClass("active");
    $("#tab1").addClass("active");

    $("#selecExamenes").removeClass("active");
    $("#solExamenMedico").addClass("active");

}

$("#cargo").typeahead({    
    source: function(query, process) {
        
        var idEmpresa = $("#empresaInt").val();
        nombres = [];
        map = {};
        
        $.ajax({
            type: "POST",
            url: "../../vista/solicitudExamenVista/asincSolicitudExamen.php",
            data: {
                accion:"consultaPorLetra",
                idEmpresa:idEmpresa,
                texto: query
            },
            dataType: "json",
            beforeSend: function() {},
            success: function(data) {
                
                var datos;

                if (data !== null) {

                    //datos = JSON.parse(data);
                    datos = data;
                    nombres = [];

                    $.each(datos, function(llave, valor) {
                        nombres.push(valor.nom_carg);
                        map[valor.nom_carg] = valor;
                    });

                    if (data !== null && nombres.length > 0)
                        process(nombres);                    
                }                
            }            
        });
    },
    updater: function(item) {
       // console.log(map);
        $("#cargoId").val((map[item].cod_carg));
        return item;
    }
},
{
    hint: true,
    highlight: true,
    minLength:4 
});