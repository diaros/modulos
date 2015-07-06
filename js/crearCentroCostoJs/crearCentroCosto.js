function consultarEmpCliente() {

    var idEmpInt = $("#empresaInt").val();

    $.ajax({
        type: 'POST',
        url: "../../vista/crearCentroCostoVista/asincCentroCosto.php",
        data: {
            accion: "consultaEmpUsuarias",
            idEmpInt: idEmpInt
        },
        dataType: "json",
        beforeSend: function() {

            $("#modalLoad").modal('toggle');

        },
        success: function(data) {

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

    }).done(function() {

        consultarArbol(idEmpInt);

    });

}

function consultarArbol(idEmpInt) {

    $.ajax({
        type: 'POST',
        url: "../../vista/crearCentroCostoVista/asincCentroCosto.php",
        data: {
            
            accion: "consulArbol",
            idEmpInt: idEmpInt

        },
        datatype: "json",
        beforeSend: function() {
        },
        success: function(data) {

            var datos = JSON.parse(data);

            $("#arbCliente").html("");
            $("#arbCliente").append(
                    "<option value=''></option>"
                    );
            $.each(datos, function(llave, valor) {

                $("#arbCliente").append(
                        "<option value='" + valor.cod_nive + "'>" + valor.nom_nive + "</option>"
                        );

            });
            $("#modalLoad").modal('toggle');
        }
    });

}

function valTipoFac() {

    var tipoFac = $("#tipoFac").val()

    if (tipoFac != 1) {

        $("#campArbCli").fadeIn(800);
        $("#campIdClient").fadeIn(800);

    } else {

        $("#arbCliente").val("");
        $("#idClieKactus").val("");

        $("#campArbCli").fadeOut(800);
        $("#campIdClient").fadeOut(800);
    }

}

function valNumerico() {

    var aiu = $("#aiu").val();

    var res = $.isNumeric(aiu);

    if (res == false) {

        $("#tituloModal").html("Advertencia");
        $("#cuerpoModal").html("El valor ingresado en el campo AIU debe ser numerico.");
        $("#modalInfo").modal('toggle');

        $("#aiu").val("");

    }

}

function reiniciar() {

    document.getElementById("crearClienteForm").reset();
    //$("#tablaCentroCosto").css("display","none");

}

function valVaciosCC() {

    var empInt = $("#empresaInt").val();
    var empClient = $("#empUsu").val();
    var aiu = $("#aiu").val();
    var tipoFac = $("#tipoFac").val();
    var arbCliente = $("#arbCliente").val();
    var identCliente = $("#idClieKactus").val();

    if (tipoFac == '1') {

        if (empInt == '' || empClient == '' || aiu == '' || tipoFac == '') {

            $("#tituloModal").html("Advertencia");
            $("#cuerpoModal").html("Todos los campos son obligatorios.");
            $("#modalInfo").modal('toggle');


        } else {

            guardarCentroCosto();

        }

    } else if (tipoFac != '' && tipoFac != '1') {


        if (empInt == '' || empClient == '' || aiu == '' || tipoFac == '' || arbCliente == '' || identCliente == '') {

            $("#tituloModal").html("Advertencia");
            $("#cuerpoModal").html("Todos los campos son obligatorios.");
            $("#modalInfo").modal('toggle');


        } else {

            guardarCentroCosto();

        }

    }
}

function guardarCentroCosto() {

    var empInt = $("#empresaInt").val();
    var empClient = $("#empUsu").val();
    var aiu = $("#aiu").val();
    var tipoFac = $("#tipoFac").val();
    var arbCliente = $("#arbCliente").val();
    var identCliente = $("#idClieKactus").val();
    var aceptaAptos;
    
    if($("#res1").prop('checked')){
        
        aceptaAptos = $("#res1").val();
        
    }else{
        
        aceptaAptos = $("#res2").val();
    }
    
    $.ajax({
        type: 'POST',
        url: "../../vista/crearCentroCostoVista/asincCentroCosto.php",
        data: {
            accion: "guardarCC",
            idEmpInt: empInt,
            idEmpCliente: empClient,
            aiu: aiu,
            tipoFac: tipoFac,
            arbCliente: arbCliente,
            identClienteKactus: identCliente,
            aceptaAptos:aceptaAptos

        },
        datatype: "json",
        beforesend: function() {



        },
        success: function(data) {

            if (data == 1) {

                $("#tituloModal").html("Información");
                $("#cuerpoModal").html("El registro a sido exitoso.");
                $("#modalInfo").modal('toggle');

               
                reiniciar();
                consultarCentroCosto();


            } else if (data == -1) {

                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("Ha ocurrido un error en el registro. Por favor vuelva a intentarlo. Si el problema persiste comuniquese con el departamento de desarrollo.");
                $("#modalInfo").modal('toggle');


            } else if (data == -2) {

                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("Ya existe un centro de costo parametrizado para la empresa interna y la empresa cliente seleccionada.");
                $("#modalInfo").modal('toggle');

            }

        }

    });

}

function confirmacionEliminarCentroCosto(number) {

    var idCentroCosto = $("#idCentroCosto" + number).val();

    $("#ocultoId").val(idCentroCosto);
    $("#modalConfirm").modal('toggle');

}

function eliminarCentroCosto() {

    $("#modalConfirm").modal('toggle');

    var idCentroCosto = $("#ocultoId").val();

    $.ajax({
        type: 'POST',
        url: "../../vista/crearCentroCostoVista/asincCentroCosto.php",
        data: {
            accion: "eliminarCC",
            idCentroCosto: idCentroCosto
        },
        datatype: "json",
        beforeSend: function() {},
        success: function(data) {

            if (data == 1) {

                $("#tituloModal").html("Información");
                $("#cuerpoModal").html("El registro ha sido eliminado.");
                $("#modalInfo").modal('toggle');
                consultarCentroCosto();

            } else if (data == -1) {

                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("Ha ocurrido un error en la eliminación del registro, por favor vuelva a intentarlo. Si el fallo persiste por favor comuniquese con el departamento de desarrollo.");
                $("#modalInfo").modal('toggle');

            }


        }
    });

}

function consultarCentroCosto(){
    
    $.ajax({
        
        type: 'POST',
        url: "../../vista/crearCentroCostoVista/asincCentroCosto.php",
        data:{
            accion:"consultarCC"
        },
        datatype:"json",
        beforeSend:function(){
            
        },
        success:function(data){
            
            if(data == -1){
                
                
            }else{               
               
                var i = 0;
                $("#datosCentroCosto").html("");
                var datos = JSON.parse(data);
                
//              $("#tablaCentroCosto").css("display","block");
                $("#tablaCentroCosto").fadeIn("slow");
                
                $.each(datos,function(llave,valor){
                   
                     $("#datosCentroCosto").append(
                        
                        "<tr><td>"+valor.id_empresa_interna+"</td>\n\
                             <td>"+valor.id_empresa_cliente+"</td>\n\
                             <td>"+valor.aiu+"</td>\n\
                             <td>"+valor.tipo_facturacion+"</td>\n\
                             <td>"+valor.id_cliente_kactus+"</td>\n\
                             <td>"+valor.cobro_aptos+"</td>\n\
                             <td><input id='eliminar"+i+"' name='eliminar"+i+"' value='Eliminar' type='button' class='btn btn-link' onclick='confirmacionEliminarCentroCosto("+i+")'></td>\n\
                             <input type='hidden' id='idCentroCosto"+i+"' name='idCentroCosto"+i+"' value='"+valor.id_tipo_cobro+"'></tr>"
                        );
                
                 i=i+1;
                    
                });
                
            }
            
            
        }
        
    });
    
}

