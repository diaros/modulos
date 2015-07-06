function confirmarEjecucion() {

    $("#modalConfirm").modal('toggle');

}

function ejecutarSP() {

    var idUser = $("#idUserLog").val();

    $.ajax({
        type: "POST",
        url: "../../vista/ejecutarSPVista/asincEjecutarSP.php",
        data: {
            accion: "ejecutarSP",
            idUser: idUser
        },
        datatype: "json",
        beforeSend: function() {
            
             $("#modalConfirm").modal('toggle');
             $("#modalLoad").modal('toggle');
        },
        success: function(data) {

            if(data == 1){
                
                $("#modalLoad").modal('toggle');
                $("#tituloModal").html("Información");
                $("#cuerpoModal").html("El procedimiento almacenado ha sido ejecutado. En los proximos minutos se estara enviando un informe del estado proceso a su correo electronico.");
                $("#modalInfo").modal('toggle');                
                
            }else{
                
                $("#modalLoad").modal('toggle');
                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("Ha ocurrido un error en la ejecución del procedimiento almacenado. Por favor vuelva a intentarlo mas tarde. Si el problema persiste por favor comuniquese con el departamento de desarrollo");
                $("#modalInfo").modal('toggle'); 
                
            }

        }

    });

}