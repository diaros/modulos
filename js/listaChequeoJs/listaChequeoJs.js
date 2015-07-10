$(document).on("ready", inicio);

function inicio() {

    var idEmpInt = $("#empresaIntOculto").val();
    var req = $("#reqOculto").val();
    var idUser = $("#idUserOculto").val();

    if (idEmpInt !== '' && req !== '' && idUser !== '') {

        $("#empresaInt").val(idEmpInt);
        $("#requisicion").val(req);
        //consultarUsuariosxReq();
        $("#idUser").val(idUser);
    }

    valEstado();

}

function valhCeckDerogado(){
    
    var estadoPresentado = $("#presentadoDerogado").prop("checked");
    var estadoNoPresentado = $("#noPresentadoDerogado").prop("checked");
    
    if(estadoPresentado == true){
        
        $("#noPresentadoDerogado").prop("checked",false);
        
    }
    
    if(estadoNoPresentado == true){
        
        $("#presentadoDerogado").prop("checked",false);
        
    }  
    
}

function valEstado(){

    var estado;
    var longreg = $('#datosDocumentos >tbody >tr').length;
    var flgExisteDerogados = false;

    for (i = 1; i <= longreg; i++) {

        estado = $("#idEstado" + i).val();

        if (estado == 1) {

            $("#presentado" + i).prop('checked', true);
            $("#fila" + i).addClass("info");

        }

        if (estado == 2) {

            $("#noPresentado" + i).prop('checked', true);
            $("#fila" + i).addClass("danger");

        }

        if (estado == 3) {

            $("#noAplica" + i).prop('checked', true);
            $("#fila" + i).addClass("warning");
        }
        
         if (estado == 4) {

            $("#derogado" + i).prop('checked', true);
            $("#fila" + i).addClass("success");
            flgExisteDerogados = true;
        }

    }    
    
    if(flgExisteDerogados == true){     
        
        mostrarSoporteDerogados();
        
    }   

}

function guardar() {

    var vacios = valVacios();

    if (vacios == -1) {

        $("#tituloModal").html("Advertencia");
        $("#cuerpoModal").html("Los campos Empresa Interna, Numero requisición y No Identificación son obligatorios");
        $("#modalInfo").modal('toggle');

    } else {
        
        valDerogado = existeDerogado();
        var soporteDerogado = $("#soporteDerogado").val();
        
       //if(valDerogado == 1 && $("#existeSoporteDerogadoOculto").val() != '1' && $("#soporteDerogado").val() != ''){ 
        if(soporteDerogado != ''){ 
            
            var accion = 'guardar';
            var estado = '';
            adjuntarArchivo(estado,accion);             
                       
            
        }else{
            
            document.listaChequeoForm.accion.value = "Guardar";
            document.forms['listaChequeoForm'].submit();
            
//            if(valDerogado == 1 && $("#existeSoporteDerogadoOculto").val() != '1'){
//                
//                $("#tituloModal").html("Advertencia");
//                $("#cuerpoModal").html("Debe adjuntar un documento soporte para el/los documento(s) derogados");
//                $("#modalInfo").modal('toggle');                
//                
//            }else{                
//                
//                document.listaChequeoForm.accion.value = "Guardar";
//                document.forms['listaChequeoForm'].submit();                   
//            }           
               
        }
    
    }
}

function consultar() {

    var vacios = valVacios();

    if (vacios == -1) {

        $("#tituloModal").html("Advertencia");
        $("#cuerpoModal").html("Los campos Empresa Interna, Numero requisición y No Identificación son obligatorios");
        $("#modalInfo").modal('toggle');

    } else {

        document.listaChequeoForm.accion.value = "Consultar";
        document.forms['listaChequeoForm'].submit();

    }

}

function existeDerogado() {
    
    flgExisteDerogado = 0;

    longreg = $('#datosDocumentos >tbody >tr').length;

    for (i = 1; i <= longreg; i++) {

        if ($("#derogado" + i).prop("checked") == true) {

            flgExisteDerogado = 1;

        }

    }
    
    if(flgExisteDerogado == 1){
        
          
          $("#filaSoporteDerogados").fadeIn("slow"); 
          $("#filaConsultaSoporteDerogados").fadeIn("slow");
          //mostrarSoporteDerogados();
          return 1;
        
    }else{
        
          $("#filaSoporteDerogados").fadeOut("slow");
          $("#filaConsultaSoporteDerogados").fadeOut("slow");
          $(":file").filestyle('clear');          
          return 2;
    }


}

function valCheckBox(id, number) {   
    
    var id = id;

    if ($("#" + id).prop("checked")) {

        if (id == 'presentado' + number) {    

            $("#noPresentado" + number).prop("checked", false);
            $("#noAplica" + number).prop("checked", false);
            $("#derogado" + number).prop("checked", false);  
            existeDerogado()
            
        }

        if (id == 'noPresentado' + number) {

            $("#presentado" + number).prop("checked", false);
            $("#noAplica" + number).prop("checked", false);
            $("#derogado" + number).prop("checked", false);
            existeDerogado()
        }

        if (id == 'noAplica' + number) {

            $("#presentado" + number).prop("checked", false);
            $("#noPresentado" + number).prop("checked", false);
            $("#derogado" + number).prop("checked", false);
            existeDerogado()

        }
        
        if(id == 'derogado'+number){
            
            $("#presentado" + number).prop("checked", false);
            $("#noPresentado" + number).prop("checked", false);
            $("#noAplica" + number).prop("checked", false);            
            existeDerogado()
          
        }

    } else {

        if (id == 'presentado' + number) {

            if ($("#noPresentado").attr("checked", false) && $("#noAplica").attr("checked", false) && $("#derogado").attr("checked", false)) {

                $("#" + id).prop("checked", true);

            }

            $("#noPresentado" + number).prop("checked", false);
            $("#noAplica" + number).prop("checked", false);
            $("#derogado" + number).prop("checked", false);

        }

        if (id == 'noPresentado' + number) {

            if ($("#presentado").attr("checked", false) && $("#noAplica").attr("checked", false) && $("#derogado").attr("checked", false)) {

                $("#" + id).prop("checked", true);

            }

            $("#presentado" + number).prop("checked", false);
            $("#noAplica" + number).prop("checked", false);
            $("#derogado" + number).prop("checked", false);

        }

        if (id == 'noAplica' + number) {

            if ($("#presentado").attr("checked", false) && $("#noPresentado").attr("checked", false) && $("#derogado").attr("checked", false) ) {

                $("#" + id).prop("checked", true);

            }

            $("#presentado" + number).prop("checked", false);
            $("#noPresentado" + number).prop("checked", false);
            $("#derogado" + number).prop("checked", false);

        }
        
         if (id == 'derogado' + number) {

            if ($("#presentado").attr("checked", false) && $("#noPresentado").attr("checked", false) && $("#noAplica").attr("checked", false)) {

                $("#" + id).prop("checked", true);

            }

            $("#presentado" + number).prop("checked", false);
            $("#noPresentado" + number).prop("checked", false);
            $("#noAplica" + number).prop("checked", false);
            
            existeDerogado();

        }

    }

}

function mostrarSoporteDerogados(){
    
    var empInt = $("#empresaInt").val();
    var req = $("#requisicion").val();
    var idUser = $("#idUser").val();    
    
    $.ajax({
        
        type: 'POST',
        url:"../../vista/listaChequeoVista/asinclistaChequeo.php",
        data:{
            
            accion: "consultarSoporte",
            empInt: empInt,
            req: req,
            idUser: idUser            
            
        },
        dataType:"json",
        beforeSend:function(){},
        success:function(data){
            
            if(data != -1){                
               
                $("#linkSoporteDerogado").attr('href',data);
                $("#filaConsultaSoporteDerogados").fadeIn("slow");  
                $("#filaSoporteDerogados").fadeIn("slow");
                $("#existeSoporteDerogadoOculto").val("1"); 
                $("#linkSoporteDerogado").html("Descargar");
            }      
            
            if(data == -1){
                
                data = '';
                $("#linkSoporteDerogado").removeAttr('href',data);
                $("#filaConsultaSoporteDerogados").fadeIn("slow");  
                $("#filaSoporteDerogados").fadeIn("slow");
                $("#linkSoporteDerogado").html("No se adjuntado soporte");
                $("#existeSoporteDerogadoOculto").val("");   
                
            }
        }        
    });       
}

function limpiar() {

    $("#empresaIntOculto").val("");
    $("#reqOculto").val("");
    $("#idUserOculto").val("");

    $("#empresaInt").val("");
    $("#requisicion").val("");
    $("#idUser").val("");

//    $("#btnGuardar").css("display", "none");
//    $("#datosDocumentos").css("display", "none");
//    $("#btnGenerarPdf").css('display', 'none');
//    $("#btnFinalizar").css('display', 'none');
    
    $("#btnGuardar").fadeOut("slow");
    $("#datosDocumentos").fadeOut("slow");
    $("#btnGenerarPdf").fadeOut("slow");
    $("#btnFinalizar").fadeOut("slow");
    
    $(":file").filestyle('clear');
}

function valVacios() {

    if ($("#empresaInt").val() == '' || $("#requisicion").val() == '' || $("#idUser").val() == '') {

        return -1;

    } else {

        return 1;
    }


}

function marcar(id) {

    //var id = id;

    if ($("#" + id).prop("checked")) {

        if (id == 'marcarTodosPresentado') {

            $("#marcarTodosNoPresentado").prop("checked", false);
            $("#marcarTodosNoAplica").prop("checked", false);
            $("#marcartodosDerogado").prop("checked", false);
            $("#filaSoporteDerogados").fadeOut("slow");
            marcarTodos(id);
        }

        if (id == 'marcarTodosNoPresentado'){

            $("#marcarTodosPresentado").prop("checked", false);
            $("#marcarTodosNoAplica").prop("checked", false);
            $("#marcartodosDerogado").prop("checked", false);
            $("#filaSoporteDerogados").fadeOut("slow");
            marcarTodos(id);
        }

        if (id == 'marcarTodosNoAplica'){

            $("#marcarTodosPresentado").prop("checked", false);
            $("#marcarTodosNoPresentado").prop("checked", false);
            $("#marcartodosDerogado").prop("checked", false);
            $("#filaSoporteDerogados").fadeOut("slow");
            marcarTodos(id);
        }
        
//        if (id == 'marcartodosDerogado') {
//
//            $("#marcarTodosPresentado").prop("checked", false);
//            $("#marcarTodosNoPresentado").prop("checked", false);
//            $("#marcarTodosNoAplica").prop("checked", false);
//            marcarTodos(id);
//        }


    } else {

        if (id == 'marcarTodosPresentado') {

            $("#marcarTodosNoPresentado").prop("checked", false);
            $("#marcarTodosNoAplica").prop("checked", false);
            $("#marcartodosDerogado").prop("checked", false);
            marcarTodos(id);
        }

        if (id == 'marcarTodosoPresentado') {

            $("#marcarTodosPresentado").prop("checked", false);
            $("#marcarTodosNoAplica").prop("checked", false);
            $("#marcartodosDerogado").prop("checked", false);
            marcarTodos(id);
        }

        if (id == 'marcarTodosNoAplica') {

            $("#marcarTodosPresentado").prop("checked", false);
            $("#marcarTodosNoPresentado").prop("checked", false);
            $("#marcartodosDerogado").prop("checked", false);
            marcarTodos(id);
        }
        
//        if (id == 'marcarTodosDerogado') {
//
//            $("#marcarTodosPresentado").prop("checked", false);
//            $("#marcarTodosNoPresentado").prop("checked", false);
//            $("#marcarTodosNoAplica").prop("checked", false);
//            marcarTodos(id);
//        }

    }

}

function generarpdf() {

    var empInt = $("#empresaInt").val();
    var req = $("#requisicion").val();
    var idUser = $("#idUser").val();

    $.ajax({
        type: 'POST',
        url: "../../vista/listaChequeoVista/asincListaChequeo.php",
        data: {
            accion: "generarPdf",
            empInt: empInt,
            req: req,
            idUser: idUser

        },
        dataType: "json",
        beforeSend: function() {

            $('#modalLoad').modal({backdrop: 'static', keyboard: true});
        },
        success: function(data) {

            if (data != null && data != '-1') {

                $("#modalLoad").modal('toggle');
                window.open(data);

            }

            if (data == '-1') {

                $("#modalLoad").modal('toggle');
                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("Ha ocurrido un error generando el archivo.Por favor intente nuevamente, si el problema persiste comuniquese con el area de desarrollo");
                $("#modalInfo").modal('toggle');
            }

        }

    });

}

function valVaciosChequeo(data){

    var flgEstado = 0;
    var psicoAsociado = data;
  
    if(psicoAsociado != ''){
        
      $("#psicoSinErrores").val(psicoAsociado);   
      $("#psicoErrores").val(psicoAsociado);   
        
    }    

    var longreg = $('#datosDocumentos >tbody >tr').length;

    for (i = 1; i <= longreg; i++) {

        if ($("#presentado" + i).prop("checked") == false && $("#noPresentado" + i).prop("checked") == false && $("#noAplica" + i).prop("checked") == false && $("#derogado" + i).prop("checked")==false) {

            flgEstado = 1;

        }

    }

    if (flgEstado == 0) {

        for (i = 1; i <= longreg; i++) {

            if ($("#presentado" + i).prop("checked") == false && $("#noAplica" + i).prop("checked") == false && $("#derogado" + i).prop("checked") == false) {

                flgEstado = -1;

            }

        }
        
        valDerogado = existeDerogado();
        var soporteDerogado = $("#soporteDerogado").val();   
        
        if(soporteDerogado == '' && $("#existeSoporteDerogadoOculto").val() != '1' && valDerogado == 1){
            
             flgEstado = -1;
            
        }   
        
        if (flgEstado == -1){

                  $("#modalConfirmErrores").modal('toggle');

        } else {            

                  $("#modalConfirm").modal('toggle');

        }

    } else {

        //$("#modalConfirmErrores").modal('toggle');
        $("#tituloModal").html("Advertencia");
        $("#cuerpoModal").html("Para finalizar la solicitud debe marcar un estado para todos los documentos.");
        $("#modalInfo").modal('toggle');

    }

}

function consultarPsicoAsignado(){
    
    //return "2";
    
    var empInt = $("#empresaInt").val();
    var req = $("#requisicion").val();
    var idUser = $("#idUser").val();
    
    $.ajax({
       
        type: 'POST',
        url: "../../vista/listaChequeoVista/asincListaChequeo.php",
        data:{
            
            accion:"consultarPsico",
            empInt:empInt,
            req:req,
            idUser:idUser
            
        },        
        dataType:"json",
        beforeSend:function(){
            
            
            
        },
        success:function(data){
            
           valVaciosChequeo(data);
            
        }        
        
    });
    
    
}

function finalizar(estado) {
    
    var flgError = false;   

    if (estado == '1') {

        var idPsicologo = $("#psicoSinErrores").val();

        if (idPsicologo == '') {

            $("#MsjSinErrores").html("Por favor seleccione un psicologo a asociar");
            $("#divMsjSinErrores").css("display", "block");
            flgError = true;

        }
    }

    if (estado == '-1') {

        var idPsicologo = $("#psicoErrores").val();

        if (idPsicologo == '') {

            $("#MsjErrores").html("Por favor seleccione un psicologo a asociar");
            $("#divMsjErrores").css("display", "block");
            flgError = true;

        }

    }

    if (flgError == false) {
        
        valDerogado = existeDerogado();
        var soporteDerogado = $("#soporteDerogado").val();
        
        if(soporteDerogado != ''){ 
            
            var accion = 'finalizar';
            adjuntarArchivo(estado,accion);             
                       
            
        }else{
            
            enviarNotificacion(estado);
            
//            if(valDerogado == 1 && $("#existeSoporteDerogadoOculto").val() != '1'){
//                
//                $("#tituloModal").html("Advertencia");
//                $("#cuerpoModal").html("Debe adjuntar un documento soporte para el/los documento(s) derogados");
//                $("#modalInfo").modal('toggle');                
//                
//            }else{                
//                
//                enviarNotificacion(estado);
//                
//            }          
            
            
        }           

    }

}

function enviarNotificacion(estado){
    
    var empInt = $("#empresaInt").val();
    var req = $("#requisicion").val();
    var idUser = $("#idUser").val();  
    var rutaArchivo = $("#rutaArchivoOculto").val();
    
    if(estado == '1'){
        
        var idPsicologo = $("#psicoSinErrores").val();
        
    }else{
        
        var idPsicologo = $("#psicoErrores").val();
        
    }  
    
    $.ajax({
    type: 'POST',
    url: "../../vista/listaChequeoVista/asincListaChequeo.php",
    data: {
        accion: "notificacion",
        empInt: empInt,
        req: req,
        idUser: idUser,
        idPsicologo: idPsicologo,
        rutaArchivo:rutaArchivo,
        estado: estado
    },
    dataType: "json",
    beforeSend: function(){

        $("#idPsico").val(idPsicologo);

        if (estado == 1) {

            $("#modalConfirm").modal('toggle');
            $('#modalLoad').modal({backdrop: 'static', keyboard: true});

        }

        if (estado == -1) {

            $("#modalConfirmErrores").modal('toggle');
            $('#modalLoad').modal({backdrop: 'static', keyboard: true});

        }

    },
    success: function(data) {

        $("#modalLoad").modal('toggle');

        if (data == '1') {

            $("#tituloModal").html("Información");
            $("#cuerpoModal").html("Enviando notificación por favor espere un momento. <i class='fa fa-refresh fa-spin'></i>");
            $("#modalInfo").modal({backdrop: 'static', keyboard: true});

            document.listaChequeoForm.accion.value = "Finalizar";
            document.forms['listaChequeoForm'].submit();

        }

        if (data == '2') {

            $("#tituloModal").html("Información");
            $("#cuerpoModal").html("Enviando notificación por favor espere un momento <i class='fa fa-refresh fa-spin'></i>");
            $("#modalInfo").modal({backdrop: 'static', keyboard: true});

            document.listaChequeoForm.accion.value = "Finalizar";
            document.forms['listaChequeoForm'].submit();
        }

        if (data == '-1') {

            $("#tituloModal").html("Advertencia");
            $("#cuerpoModal").html("Ha ocurrido un error generando la notificación.Por favor intente nuevamente, si el problema persiste comuniquese con el area de desarrollo");
            $("#modalInfo").modal('toggle');

        }

        if (data == '-2') {

            $("#tituloModal").html("Advertencia");
            $("#cuerpoModal").html("Ha ocurrido un error enviando la notificacion al correo del Psicologo.Por favor intente nuevamente, si el problema persiste comuniquese con el area de desarrollo");
            $("#modalInfo").modal('toggle');

        }
    }
});
    
    
    
    
}

function marcarTodos(id) {
    
    var longreg = $('#datosDocumentos >tbody >tr').length;

    if (id == 'marcarTodosPresentado') {

        for (i = 1; i <= longreg; i++) {

            $("#presentado" + i).prop("checked", true);
            $("#noPresentado" + i).prop("checked", false);
            $("#noAplica" + i).prop("checked", false);
            $("#derogado" + i).prop("checked", false);           

        }
        
          $(":file").filestyle('clear');

    }

    if (id == 'marcarTodosNoPresentado') {

        for (i = 1; i <= longreg; i++) {

            $("#presentado" + i).prop("checked", false);
            $("#noPresentado" + i).prop("checked", true);
            $("#noAplica" + i).prop("checked", false);
            $("#derogado" + i).prop("checked", false);

        }
        
          $(":file").filestyle('clear');

    }

    if (id == 'marcarTodosNoAplica') {

        for (i = 1; i <= longreg; i++) {

            $("#presentado" + i).prop("checked", false);
            $("#noPresentado" + i).prop("checked", false);
            $("#noAplica" + i).prop("checked", true);
            $("#derogado" + i).prop("checked", false);

        }
        
          $(":file").filestyle('clear');

    }
    
//        if (id == 'marcarTodosDerogado') {
//
//        for (i = 1; i <= longreg; i++) {
//
//            $("#presentado" + i).prop("checked", false);
//            $("#noPresentado" + i).prop("checked", false);
//            $("#noAplica" + i).prop("checked", false);
//            $("#derogado" + i).prop("checked", true);
//
//        }
//
//    }


}

function limpiarCampos() {

    $("#btnGenerarPdf").css('display', 'none');
    $("#btnFinalizar").css('display', 'none');
    $("#btnGuardar").css('display', 'none');

}

function consultarUsuariosxReq() {

    var idEmpInt = $("#empresaInt").val();
    var req = $("#requisicion").val();

    $.ajax({
        
        type: 'POST',
        url: "../../vista/gestionContratosVista/asincGestionContratos.php",
        data: {
            accion: "consultarUsuariosxReq",
            idEmpInt: idEmpInt,
            req: req
        },
        dataType: "json",
        beforeSend: function() {

            $('#modalLoad').modal({backdrop: 'static', keyboard: true});
            $("#observ").val('');

        },
        success: function(data) {
        
            $('#modalLoad').modal("toggle");
            
             $("#idUser").html("");
                $("#idUser").append(
                        "<option value=''></option>"
                        );

            if (data != null) {               

                $.each(data, function(llave, valor) {

                    $("#idUser").append(
                            "<option value='" + llave + "'>" + valor + "-" + llave + "</option>"
                            );

                });


            }else{
                
                
                $("#tituloModal").html("Informacion");
                $("#cuerpoModal").html("No existen registros asociados con los parametros ingresados");
                $("#modalInfo").modal('toggle');
                
            }
            
        }

    });

}

function valExtension(){   

    var nombreArchivo = $("#soporteDerogado").val();
    var longNombreArchivo = nombreArchivo.length;
    var ext = nombreArchivo.substring(longNombreArchivo - 3, longNombreArchivo);   

}

function adjuntarArchivo(estado, accion) {

//    if ($("#existeSoporteDerogadoOculto").val() != '1' && $("#soporteDerogado").val() != '') {

        var formulario = new FormData(document.getElementById("listaChequeoForm"));

        $.ajax({
            
            url: '../../vista/listaChequeoVista/asincListaChequeo.php',
            type: 'POST',
            contentType: false,
            data: formulario,
            processData: false,
            cache: false,
            success: function(data) {

                $("#rutaArchivoOculto").val(data);

                if (data != '-1') {

                    if (accion == 'finalizar') {

                        enviarNotificacion(estado);

                    }
                    else if (accion == 'guardar') {

                        cargarFormulario(data);

                    }
                }
            }

        }).done(function(){});

//    }
//    else {
//        
//        console.log("llego al else");
//        
//        if (accion == 'finalizar') {
//            
//            console.log("entro a la op finalizar");
//            enviarNotificacion(estado);
//
//        }
//        else if (accion == 'guardar'){
//
//            cargarFormulario("1");
//        }
//            
//    }

}

function cargarFormulario(resulAdjuntar){ 

    if (resulAdjuntar != -1){        
       
        document.listaChequeoForm.accion.value = "Guardar";
        document.forms['listaChequeoForm'].submit();

    } else {
       
        $("#tituloModal").html("Advertencia");
        $("#cuerpoModal").html("Ha ocurrio un error al adjuntar el archivo de soporte de derogados, por favor vuelva a intentarlo. Si el error persiste por favor comuniquelo al depto de desarrollo.");
        $("#modalInfo").modal('toggle');
    }

}

//No se esta usando
function valEstadoChequeo(){

    var estado;
    var flgEstado = true;
    var longreg = $('#datosDocumentos >tbody >tr').length;

    for (i = 1; i <= longreg; i++) {

        estado = $("#idEstado" + i).val();

        if (estado != 1 && estado != 3) {

            flgEstado = false;

        }

    }

    if (flgEstado == false) {

        $("#modalConfirmErrores").modal('toggle');

    } else {

        $("#modalConfirm").modal('toggle');

    }

}


//$("#sicologo").typeahead({
//    
//    source:function(query, process){
//        
//        nombres = [];
//        map = {};
//        
//        $.ajax({
//            type: 'POST',
//            url:"../../vista/listaChequeoVista/asincListaChequeo.php",
//            data:{
//                
//                accion:'consultarSico',
//                texto:query
//                
//            },
//            datatype:"json",
//            beforeSend:function(){                
//               
//            },
//            success:function(data){
//                
//                console.log(data);
//                
//                   var datos;
//
//                if (data !== null) {
//
//                    datos = JSON.parse(data);
//                    nombres = [];
//
//                    $.each(datos, function(llave, valor) {
//                        nombres.push(valor.usu_nombre);
//                        map[valor.usu_nombre] = valor;
//                    });
//
//                    if (data !== null && nombres.length > 0)
//                        process(nombres);                    
//                }
//                
//            }
//        });
//        
//    },
//    updater:function(item){
//        
//         console.log("llego al updater");
//    }
//    
//},{
//    
//    
//});