function validarVacios() {

    var nombre = $("#nombre").val();
    var estado = $("#estado").val();

    if (nombre == '' || estado == '') {

        $("#tituloModal").html("Advertencia");
        $("#cuerpoModal").html("Todos los campos son obligatorios.");
        $("#modalInfo").modal('toggle');

    } else {

        guardarCat();
    }

}

function guardarCat() {

    var nombre = $("#nombre").val();
    var estado = $("#estado").val();

    $.ajax({
        type: "post",
        url: "../../vista/crearCategoriaVista/asincCrearCategoria.php",
        data: {
            accion: "guardarCat",
            nombre: nombre,
            estado: estado
        },
        datatype: "json",
        beforeSend: function() {

            $("#modalLoad").modal('toggle');
        },
        success: function(data) {


            if (data == 1) {

                $("#modalLoad").modal('toggle');
                $("#tituloModal").html("Informacion");
                $("#cuerpoModal").html("El registro ha sido exitoso.");
                $("#modalInfo").modal('toggle');

                consultarCategorias();


            } else if (data == 0) {
                $("#modalLoad").modal('toggle');
                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("Ha ocurrido un error en el registro. Por favor vuelva a intentarlo. Si el problema persiste comuniquese con el departamento de desarrollo.");
                $("#modalInfo").modal('toggle');
            }

        }

    });

}

function consultarCategorias() {

    $.ajax({
        type: "post",
        url: "../../vista/crearCategoriaVista/asincCrearCategoria.php",
        data: {
            accion: "consultarCat"
        },
        beforeSend: function() {
        },
        success: function(data) {

            if (data == 0) {

            } else {

                var datos = JSON.parse(data);
                var i = 0;
                $("#datosCat").html("");
                $.each(datos, function(llave, valor) {

                    $("#datosCat").append(
                         "<tr>\n\
                         <td>" + valor.nombre + "</td>\n\
                         <td>" + valor.estado + "</td>\n\
                         <td><input id='eliminar"+i+"' name='eliminar"+i+"' value='Eliminar' type='button' class='btn btn-link' onclick='confirmacionEliminar("+i+")'></td>\n\
                         <input id='idCat"+i+"' name='idCat"+i+"' type='hidden' value='"+valor.id_categoria_examen+"' ></tr>"

                     );
                     
                    i = i+1;
                });
            }

        }

    });

}

function confirmacionEliminar(number){
    
    $("#ocultoId").val(number);
    $("#modalConfirm").modal('toggle');   
    
    
}

function eliminarCat(){
    
    $("#modalConfirm").modal('toggle');
    var number = $("#ocultoId").val();
       
    var idCat = $("#idCat"+number+"").val();
    
    $.ajax({
        type: 'POST',
        url: "../../vista/crearCategoriaVista/asincCrearCategoria.php",
        data:{
            accion:"eliminarCat",
            idCat:idCat
        },
        datatype:"json",
        beforeSend:function(){
            $("#modalLoad").modal('toggle');
        
        },
        success:function(data){
            
            if(data == 1){
                
                consultarCategorias();
                
                $("#modalLoad").modal('toggle');
                $("#tituloModal").html("Informacion");
                $("#cuerpoModal").html("El registro ha sido eliminado.");
                $("#modalInfo").modal('toggle');
                
            }else if(data == 0){
                
                $("#modalLoad").modal('toggle');
                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("Ha ocurrido un error en la eliminacion. Por favor vuelva a intentarlo. Si el problema persiste comuniquese con el departamento de desarrollo.");
                $("#modalInfo").modal('toggle');
                
            }
            
        }
        
    });
    
}

