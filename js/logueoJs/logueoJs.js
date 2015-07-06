// Logueo
function valVacios() {

    var usuario = $("#usuario").val();
    var pass = $("#pass").val();

    if (usuario == '' || pass == '') {

        $("#cuerpoModal").html("Los campos usuario y contraseña son obligatorios");
        $("#modalInfo").modal('toggle');


    } else {

        $.ajax({
            type: "POST",
            url: "../../vista/logueoVista/asincLogueo.php",
            data: "usuario=" + $("#usuario").val() +
                    "&pass=" + $("#pass").val() +
                    "&logueo=" + 'S',
            dataType: "json",
            beforeSend: function() {

                $("#modalLoad").modal('toggle');

            },
            success: function(data) {
                
                datos = JSON.parse(data);              
               
                if (datos == '-1') {

                    $("#modalLoad").modal('toggle');
                    $("#cuerpoModal").html("Usuario y/o contraseña incorrectos");
                    $("#modalInfo").modal('toggle');

                } else {
                    
                    $(location).attr("href", "../../vista/paginaPrincipalVista/paginaPrincipalVista.php");
                  
                }

            }
        }).done(function(data) {
        });
    }
}

function mostrarModal() {

    $("#modalRecordar").modal('toggle');

}

//Recordar contraseña
function valVaciosNick() {

    var nombreUsuario = $("#nombreUsuario").val();
  
    if (nombreUsuario == '') {
        
        $("#msjRecordarPass").html('El campo usuario no puede estar vacio.');
        
    } else {

        $.ajax({
            type: "POST",
            url: "../../vista/logueoVista/asincLogueo.php",
            data: "nombreUsuario=" +nombreUsuario +
                  "&recordarPass=" + 'S',
            dataType: "json",
            beforeSend: function() {                
                 $("#modalLoad").modal('toggle');
            },
            success: function(data) {
                
                datos = JSON.parse(data);
                
                if(datos == '1'){
                    
                    $("#modalLoad").modal('toggle');
                    $("#divMsj").css("display","block");
                    $("#msjRecordarPass").html('La contraseña ha sido enviada al correo electronico asociado al nombre de usuario ingresado.');
                    
                }else if(datos == '0'){
                     
                    $("#modalLoad").modal('toggle');
                    $("#divMsj").css("display","block");
                    $("#msjRecordarPass").html("El nombre de usuario ingresado no cuenta con una contraseña o mail asociado");
                    
                }

            }
        }).done(function(data) {
        });

    }

}

function ocultarMsj(){
    
     $("#divMsj").css("display","none");
    
}

//$(document).ready(function() {
//    $(document).mousemove(function(event) {
//        TweenLite.to($("body"), 
//        .5, {
//            css: {
//                backgroundPosition: "" + parseInt(event.pageX / 8) + "px " + parseInt(event.pageY / '12') + "px, " + parseInt(event.pageX / '15') + "px " + parseInt(event.pageY / '15') + "px, " + parseInt(event.pageX / '30') + "px " + parseInt(event.pageY / '30') + "px",
//            	"background-position": parseInt(event.pageX / 8) + "px " + parseInt(event.pageY / 12) + "px, " + parseInt(event.pageX / 15) + "px " + parseInt(event.pageY / 15) + "px, " + parseInt(event.pageX / 30) + "px " + parseInt(event.pageY / 30) + "px"
//            }
//        })
//    })
//})