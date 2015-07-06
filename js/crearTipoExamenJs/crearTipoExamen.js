var arreglo = new Array();
var i = 0;
var catAct = false;

function validarVacios() {

    var desc = $("#descripcion").val();
    var paraCli = $("#paraclinico").val();
    var especial = $("#especial").val();
    var estado = $("#estado").val();

    if (desc == '' || paraCli == '' || especial == '' || estado == '' || catAct == false) {

        $("#tituloModal").html("Advertencia");
        $("#cuerpoModal").html("Todos los campos son obligatorios.");
        $("#modalInfo").modal('toggle');


    } else {
        guardarTipoExam();
    }

}

function guardarTipoExam() {

    var desc = $("#descripcion").val();
    var paraCli = $("#paraclinico").val();
    var especial = $("#especial").val();
    var estado = $("#estado").val();

    $.ajax({
        type: 'POST',
        url: "../../vista/crearTipoExamenVista/asincCrearTipoExam.php",
        data: {
            accion: "guardarTipoExam",
            desc: desc,
            paraCli: paraCli,
            especial: especial,
            estado: estado,
            categorias: arreglo

        },
        dataType: 'json',
        beforeSend: function() {
            $("#modalLoad").modal('toggle');
        },
        success: function(data) {

            if (data == 1) {

                $("#modalLoad").modal('toggle');
                $("#tituloModal").html("Informacion");
                $("#cuerpoModal").html("El registro ha sido exitoso.");
                $("#modalInfo").modal('toggle');

                consultarTipoExamenes();
                limpiarForm();

            } else if (data == -1) {

                $("#modalLoad").modal('toggle');
                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("Ha ocurrido un error en el registro. Por favor vuelva a intentarlo. Si el problema persiste comuniquese con el departamento de desarrollo.");
                $("#modalInfo").modal('toggle');

                limpiarForm();

            }
        }
    });


}

function valCheck(id) {

    catAct = false;

    if ($("#" + id + "").prop('checked')) {

        arreglo[i] = id;
        i = i + 1;

    } else {

        var pos = arreglo.indexOf(id);

        if (pos > -1) {

            arreglo.splice(pos, 1);
            i = i - 1;
        }    

    }

    for (j = 0; j <= i; j = j + 1) {

        if ($("#" + arreglo[j] + "").prop("checked")) {

            catAct = true;

        }

    }

}



function eliminarTipoExam(){
    
    $("#modalConfirm").modal('toggle');
    var number = $("#ocultoId").val();
       
    var idTipoExamen = $("#idTipoExam"+number+"").val();
    
    $.ajax({
        type: 'POST',
        url: "../../vista/crearTipoExamenVista/asincCrearTipoExam.php",
        data:{
            accion:"eliminarTipoExamen",
            idTipoExamen:idTipoExamen
        },
        datatype:"json",
        beforeSend:function(){
            $("#modalLoad").modal('toggle');
        
        },
        success:function(data){
            
            if(data == 1){
                
                consultarTipoExamenes();
                
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

function consultarTipoExamenes(){
    
    $.ajax({
       
        type: 'POST',
        url: "../../vista/crearTipoExamenVista/asincCrearTipoExam.php",
        data:{
            accion:"consultarTiposExams"
        },
        beforeSend: function(){
            
            
        },
        success:function(data){            
       
            if (data == 0) {

            } else {

                var datos = JSON.parse(data);
                
                var i = 0;
                $("#datosTipoExam").html("");
                $.each(datos, function(llave, valor) {

                    $("#datosTipoExam").append(
                         "<tr>\n\
                         <td>" + valor.nombre + "</td>\n\
                         <td>" + valor.categoria + "</td>\n\
                         <td>" + valor.paraclinico + "</td>\n\
                         <td>" + valor.especial + "</td>\n\
                         <td>" + valor.estado + "</td>\n\
                         <td><input id='eliminar"+i+"' name='eliminar"+i+"' value='Eliminar' type='button' class='btn btn-link' onclick='confirmacionEliminarTipoExamen("+i+")'></td>\n\
                         <input id='idTipoExam"+i+"' name='idTipoExam"+i+"' type='hidden' value='"+valor.id_tipo+"' ></tr>"

                     );
                     
                    i = i+1;
                });
            }            
            
        }        
        
    });
    
    
    
}

function limpiarForm(){    
   
    $("#descripcion").val("");
    $("#paraclinico").val("");
    $("#especial").val("");
    $("#estado").val("");   
    $("#ocultoId").val("");
     arreglo.length = 0; 
    document.getElementById("crearTipoExamenForm").reset();

}

function confirmacionEliminar(){
    
    
}

function confirmacionEliminarTipoExamen(number){
    
    $("#").val();  
    
}