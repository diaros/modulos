
function valVacios() {

    var modulo = $("#modulo").val();
    var descripcion = $("#descripcion").val();

    if (modulo == '' || descripcion == '') {

        $("#tituloModal").html("Advertencia");
        $("#cuerpoModal").html("Los campos Modulo y Descripcion son obligatorios");
        $("#modalInfo").modal('toggle');


    } else {

        enviarNotificacion();

    }

}


function enviarNotificacion() {

    var modulo = $("#modulo").val();
    var descripcion = $("#descripcion").val();

    $.ajax({
        type: 'POST',
        url: "../../vista/soporteVista/asincSoporte.php",
        data: {
            accion: "notificacion",
            modulo: modulo,
            descripcion: descripcion

        },
        dataType: "json",
        beforeSend: function() {

            $('#modalLoad').modal({backdrop: 'static', keyboard: true});

        },
        success: function(data){
            
            $("#modalLoad").modal('toggle');

            if (data == '-1') {

                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("Ha ocurrido un error enviando la solicitud de soporte. Por favor vuelva a intentarlo, si el problema persiste por favor comuniquese con el departamento de desarrollo.");
                $("#modalInfo").modal('toggle');

            }else{

                $("#tituloModal").html("Información");
                $("#cuerpoModal").html("Solicitud de soporte enviada con exito.En el trascurso del dia se le estara notificando el estado de su solicitud");
                $("#modalInfo").modal('toggle');

            }

        }

    }).done(function(){
       
       limpiar();
        
    });

}

function limpiar(){
    
    document.soporteForm.reset();
    
}