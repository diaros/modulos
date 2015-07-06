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

function consultarEmpClienteSE(){

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

            //$('#modalLoad').modal({backdrop: 'static', keyboard: true});

        },
        success: function(data) {

            if (data == -1) {
            }
            else {

                var datos = data;
                $("#empCli").html("");
                $("#empCli").append(
                        "<option value=''></option>"
                        );
                $.each(datos, function(llave, valor) {

                    $("#empCli").append(
                            "<option value='" + llave.trim() + "'>" + valor + "</option>"

                            );

                });

            }

        }

    }).done(function() {
    });

}

function validaPresupuesto() {

    var presupuesto = $("#presupuestoBiplus").val();

    $.ajax({
        type: 'POST',
        url: "../../vista/solicitudCompraVista/asincSolicitudCompra.php",
        data: {
            accion: "consultarPresupuestoBiplus",
            presupuesto: presupuesto

        },
        dataType: "json",
        beforeSend: function() {
        },
        success: function(data) {
            
            console.log(data);

            $("#empCli option[value=" + data.cod_cliente + "]").prop("selected", "selected");
            $("#empCli").prop("disabled", true);

            $("#centroCostoId").val(data.centroCosto);
            $("#actividad").val(data.evento);
            $("#divActividad").css("display", "block");
            $("#actividad").prop("disabled", true);

        }

    });
}

function consultarUsuarioAprueba() {

    var ciudad = $("#ciudad").val();
    var tipoCompra = $("#tipoCompraOculto").val();

    $.ajax({
        type: 'POST',
        url: "../../vista/solicitudCompraVista/asincSolicitudCompra.php",
        data: {
            accion: "consultaUsuAprueba",
            tipoCompra: tipoCompra,
            ciudad: ciudad
        },
        dataType: "json",
        beforeSend: function() {
        },
        success: function(data) {

            if (data == -1) {


            } else {

                var datos = data;

                $("#usuAprueba").html("");
                $("#usuAprueba").append("<option value=''></option>");

                $.each(datos, function(llave, valor) {

                    $("#usuAprueba").append(
                            "<option value= '" + valor.codigo + "'>" + valor.nombre + "</option> "
                            );


                });

            }

        }

    });
}

function asignarTipoCompra(idTipoCompra) {

    $("#tipoCompraOculto").val(idTipoCompra);

    if (idTipoCompra == 'facturable') {

        $("#presupuestoBiplus").val("");
        $("#presupuestoBiplus").prop("disabled", true);

        $("#empCli").val("");
        $("#empCli").prop("disabled", false);

        $("#aiu").val("");
        $("#aiu").prop("disabled", false);

        $("#centroCosto").val("");
        $("#centroCosto").prop("disabled", false);

        $("#actividad").val("");
        
        $("#spanFacturable").css("opacity","1");
        $("#spanPresupuesto").css("opacity","0");
        $("#spanAdministrativa").css("opacity","0");
//      $("#spanFacturable").addClass("fa-check");
//      $("#spanPresupuesto").removeClass("fa-check");
//      $("#spanAdministrativa").removeClass("fa-check");
        
        consultarUsuarioAprueba();

    } else if (idTipoCompra == 'administrativa') {

        $("#empCli").val("");
        $("#empCli").prop("disabled", true);

        $("#presupuestoBiplus").val("");
        $("#presupuestoBiplus").prop("disabled", true);

        $("#aiu").val("");
        $("#aiu").prop("disabled", true);

        $("#centroCosto").val("");
        $("#centroCosto").prop("disabled", false);

        $("#actividad").val("");
        
        $("#spanFacturable").css("opacity","0");
        $("#spanPresupuesto").css("opacity","0");
        $("#spanAdministrativa").css("opacity","1");

//        $("#spanAdministrativa").addClass("fa-check");
//        $("#spanFacturable").removeClass("fa-check");
//        $("#spanPresupuesto").removeClass("fa-check");
        
        consultarUsuarioAprueba();

    } else if (idTipoCompra == 'presupuesto') {

        $("#empCli").val("");
        $("#empCli").prop("disabled", true);

        $("#aiu").val("");
        $("#aiu").prop("disabled", true);

        $("#centroCosto").val("");
        $("#centroCosto").prop("disabled", true);

        $("#presupuestoBiplus").val("");
        $("#presupuestoBiplus").prop("disabled", false);

        $("#actividad").val("");
        
        $("#spanFacturable").css("opacity","0");
        $("#spanPresupuesto").css("opacity","1");
        $("#spanAdministrativa").css("opacity","0");
        
//        $("#spanPresupuesto").addClass("fa-check");
//        $("#spanFacturable").removeClass("fa-check");
//        $("#spanAdministrativa").removeClass("fa-check");

        consultarUsuarioAprueba();

    }

}

function agregarItem() {  
    
    var longreg = $('#tablaItems >tbody >tr').length;
    var resulRegEncabezado = '';

    if (longreg == 1) {

        resulValVacios = valVaciosEncabezado();

        if (resulValVacios == '-1') {

            console.log("hay campos vacios");

        } else {

            resulValVaciosItem = valVaciosItemGenerico(longreg);

            if (resulValVaciosItem == '-1') {

                console.log("campos vacios en el item");

            } else {
                
                resulRegEncabezado = registrarEncabezado();
                
                if(resulRegEncabezado != 1) {
                    
                    agregarFilaItem(longreg);   
                    
                }else{
                    
                    console.log("error en reg encabezado");
                    
                }                          
            
            }

        }

    } else if (longreg > 1) {

        resulValVaciosItem = valVaciosItemGenerico(longreg);

        if (resulValVaciosItem == '-1') {

            console.log("campos vacios en el item");

        } else {

            agregarFilaItem(longreg);

        }

    }

}

function eliminarItem(id) {

    longId = id.length;
    idFila = id.substring(6, longId);

    if (idFila == 1) {

        $("#cantItem" + idFila + "").val("");
        $("#descItem" + idFila + "").val("");
        $("#especItem" + idFila + "").val("");
        $("#ciudadItem" + idFila + "").val("");
        $("#dirItem" + idFila + "").val("");
        $("#contacItem" + idFila + "").val("");

    } else {

        $("#cantItem" + idFila + "").val("");
        $("#descItem" + idFila + "").val("");
        $("#especItem" + idFila + "").val("");
        $("#ciudadItem" + idFila + "").val("");
        $("#dirItem" + idFila + "").val("");
        $("#contacItem" + idFila + "").val("");

        $("#filaItem" + idFila + "").remove();

    }
}

function valVaciosEncabezado() {

    var tipoCompra = $("#tipoCompraOculto").val();

    if (tipoCompra != '') {

        if (tipoCompra == 'facturable') {

            empInt = $("#empresaInt").val();
            telefono = $("#telContacto").val();
            ciudad = $("#ciudad").val();
            concepto = $("#conceptos").val();
            cliente = $("#empCli").val();
            aiu = $("#aiu").val();
            centroCosto = $("#centroCostoId").val();
            fechaReq = $("#fechaReq").val();
            usuAprueba = $("#usuAprueba").val();

            if (empInt.trim() == '' || telefono.trim() == '' || ciudad.trim() == '' || concepto.trim() == '' || cliente.trim() == '' || aiu.trim() == '' || centroCosto == '' || fechaReq == '' || usuAprueba == '') {

                return "-1";

            } else {

                return "1";

            }

        }

    } else {


        return "-1";

    }

}

function registrarEncabezado() {

    empInt = $("#empresaInt").val();
    tipoCompra = $("#tipoCompraOculto").val();
    telefono = $("#telContacto").val();
    ciudad = $("#ciudad").val();
    concepto = $("#conceptos").val();
    cliente = $("#empCli").val();
    aiu = $("#aiu").val();
    centroCosto = $("#centroCostoId").val();
    fechaReq = $("#fechaReq").val();
    usuAprueba = $("#usuAprueba").val();
    descripcion = $("#descripcion").val();
    
    presupuesto = $("#presupuestoBiplus").val();
    actividad = $("#actividad").val(); 
        
    cantidadItem = $("#cantItem1").val();
    descripcionItem = $("#descItem1").val();
    especificaionesItem = $("#especItem1").val();
    ciudadItemItem = $("#ciudadItem1").val();
    direccionItem = $("#dirItem1").val();
    contactoItem = $("#contacItem1").val();       
 
    
    $.ajax({
        
        type: 'POST',
        url:"../../vista/solicitudCompraVista/asincSolicitudCompra.php",
        data:{
            
            accion:"registroEncabezado",
            empInt:empInt,
            tipoCompra:tipoCompra,
            telefono:telefono,
            ciudad:ciudad,
            concepto:concepto,
            cliente:cliente,
            aiu:aiu,
            centroCosto:centroCosto,
            fechaReq:fechaReq,
            usuAprueba:usuAprueba,
            descripcion:descripcion,
            presupuesto:presupuesto,
            actividad:actividad,
            
            cantidadItem:cantidadItem,
            descripcionItem:descripcionItem,
            especificaionesItem:especificaionesItem,
            ciudadItemItem:ciudadItemItem,
            direccionItem:direccionItem,
            contactoItem:contactoItem            
            
        },
        dataType:"json",
        beforeSend:function(){
            
             //$("#divIcon").append("Guardando")             
             $("#divIcon").fadeIn(1000);
            
        },
        success:function(data){
            
            if(data == 1){
                
            
                $("#divIcon").fadeOut(1000);
                $("#spanIcono").addClass("fa-refresh");
                return '1';

            
            }else if(data == -1){
                
                $("#divIcon").fadeOut(1000);
                $("#spanIcono").addClass("fa-exclamation-triangle")
                $("#divIcon").append("Error al registrar el item..")    
                return '-1';
            }
            
             
            
        }
        
    }).done(function(){      
    
        
    });

}

function valVaciosItemGenerico(id) {

    var cantidad = $("#cantItem"+id+"").val();
    var descripcion = $("#descItem"+id+"").val();
    var especificacion = $("#especItem"+id+"").val();
    var ciudad = $("#ciudadItem"+id+"").val();
    var direccion = $("#dirItem"+id+"").val();
    var contacto = $("#contacItem"+id+"").val();

    if (cantidad.trim() == '' || descripcion.trim() == '' || especificacion.trim() == '' || ciudad.trim() == '' || direccion.trim() == '' || contacto.trim() == '') {

        return "-1";


    } else {

        return "1";
    }


}

function agregarFilaItem(longreg){
    
     cantItems = longreg + 1;

                $("#listaItems").append("<tr id='filaItem"+cantItems+"'>\n\
                                    <td>\n\
                                        <input id='cantItem"+cantItems+"' style='text-align: center;' type='text' class='form-control'>\n\
                                    </td>\n\
                                    <td>\n\
                                        <input id='descItem"+cantItems+"' style='text-align: center;' type='text' class='form-control'>\n\
                                    </td>\n\
                                    <td>\n\
                                        <input id='especItem"+cantItems+"' style='text-align: center;' type='text' class='form-control'>\n\
                                    </td>\n\
                                    <td>\n\
                                        <input id='ciudadItem"+cantItems+"' style='text-align: center;' type='text' class='form-control'>\n\
                                    </td>\n\
                                    <td>\n\
                                        <input id='dirItem"+cantItems+"' style='text-align: center;' type='text' class='form-control'>\n\
                                    </td>\n\
                                    <td>\n\
                                        <input id='contacItem"+cantItems+"' style='text-align: center;' type='text' class='form-control'>\n\
                                    </td>\n\
                                    <td>\n\
                                        <a type='button' class='btn btn-primary' id='agregar"+cantItems+"' onclick='agregarItem(this.id);'>\n\
                                            <span class='fa fa-check'></span>\n\
                                        </a>\n\
                                    </td>\n\
                                    <td>\n\
                                        <a type='button' class='btn btn-danger' id='borrar"+cantItems+"' onclick='eliminarItem(this.id);'>\n\
                                            <span class='fa fa-trash'></span>\n\
                                        </a>\n\
                                    </td>\n\
                            </tr>");   
    
    
}

$("#centroCosto").typeahead({
    source: function(query, process){

        var idEmpInt = $("#empresaInt").val();
        nombres = [];
        map = {};

        $.ajax({
            type: 'POST',
            url: "../../vista/solicitudCompraVista/asincSolicitudCompra.php",
            data: {
                accion: "consultarCC",
                idEmpInt: idEmpInt,
                centroCosto: query

            },
            dataType: "json",
            beforeSend: function() {
            },
            success: function(data) {

                console.log(data);
                var datos;

                if (data !== null) {

                    datos = data;
                    nombres = [];

                    $.each(datos, function(llave, valor) {
                        nombres.push(valor.f284_descripcion + "-" + valor.f284_id);
                        map[valor.f284_descripcion + "-" + valor.f284_id] = valor;
                    });

                    if (data !== null && nombres.length > 0)
                        process(nombres);
                }
            }
        });

    },
    updater: function(item)
    {

        $("#centroCostoId").val((map[item].f284_id));
        return item;
    }

});


