$(document).ready( function () {
//    $('#registrosLab').DataTable();
});

//$('#registrosLab').DataTable( {
//    ordering: true
//    
//} );

function valNit(){
    
    var nit;    
    nit = $("#nit").val();
    
    if(nit !== ''){
        
        $.ajax({
           
            type:"post",
            url:"../../vista/crearLaboratorioVista/asincCrearLaboratorio.php",
            data:{
                accion:"valExistenciaLab",
                nit:nit                
            },
            datatype:"json",
            beforeSend:function(){},
            
            success:function(data){
                                
                datos = JSON.parse(data);
                
                if(datos != ''){                   
               
                    $.each(datos,function(llave,valor){
                                                
                        $("#idLab").val(valor.id_laboratorio);
                        $("#nombre").val(valor.nombre_labo);
                        $("#ciudad").val(valor.ciudad);
                        $("#direccion").val(valor.direccion);
                        $("#telefono").val(valor.telefono);
                        $("#contacto").val(valor.contacto);
                        $("#mail").val(valor.mail);
                        $("#estado").val(valor.estado);
                        
                    });  
                    
                     $("#tituloModal").html("Informacion");
                     $("#cuerpoModal").html("El nit ingresado ya se encuentra registrado. Recuerde que puede actualizar los datos del laboratorio.");
                     $("#modalInfo").modal('toggle');
                     $("#guardar").val("Actualizar");
                    
                }
                
            }
            
        });
        
    }
    
    
}

function validarVacios(){
    
     var nit = $("#nit").val();
     var nombre = $("#nombre").val();
     var ciudad = $("#ciudad").val();
     var direccion = $("#direccion").val();
     var telefono = $("#telefono").val();
     var contacto = $("#contacto").val();
     var mail = $("#mail").val();
     var estado = $("#estado").val();  
     
     if(nit == '' || nombre == '' || ciudad == '' || direccion == '' || telefono == '' || contacto == '' || mail == '' || estado == '' ){
         
         $("#tituloModal").html("Advertencia");
         $("#cuerpoModal").html("Todos los campos son obligatorios.");
         $("#modalInfo").modal('toggle');
         
     }else{
         
         guardarLab();
         
     }
     
}

function guardarLab(){
    
    var nit = $("#nit").val();
     var nombre = $("#nombre").val();
     var ciudad = $("#ciudad").val();
     var direccion = $("#direccion").val();
     var telefono = $("#telefono").val();
     var contacto = $("#contacto").val();
     var mail = $("#mail").val();
     var estado = $("#estado").val();
     var idLab = $("#idLab").val();
     var accion;
     
     if(idLab == ''){
         
         accion = 'guardar';
         
     }else{
         
         accion = 'actualizar';
     }
     
     $.ajax({
         type:"post",
         url:"../../vista/crearLaboratorioVista/asincCrearLaboratorio.php",
         data:{         
          accion:accion,
          nit:nit,
          nombre:nombre,
          ciudad:ciudad,
          direccion:direccion,
          telefono:telefono,
          contacto:contacto,
          mail:mail,
          estado:estado,
          idLab:idLab
            
         },
         datatype:"json",
         beforeSend:function(){
             $("#modalLoad").modal('toggle');
         },
         success:function(data){
             
             if(data == 1){
                 
                 $("#modalLoad").modal('toggle');
                 $("#tituloModal").html("Informacion");
                 $("#cuerpoModal").html("El registro ha sido exitoso.");
                 $("#modalInfo").modal('toggle');
                 
                 
                 consultarLabs();
                
                 
                 
             }else if(data == 0){
                 $("#modalLoad").modal('toggle');
                 $("#tituloModal").html("Advertencia");
                 $("#cuerpoModal").html("Ha ocurrido un error en el registro. Por favor vuelva a intentarlo. Si el problema persiste comuniquese con el departamento de desarrollo.");
                 $("#modalInfo").modal('toggle');
             }
             
         }
     });    
       
}

function consultarLabs(){
    
    $.ajax({
        type: 'POST',
        url: "../../vista/crearLaboratorioVista/asincCrearLaboratorio.php",
        data:{
            accion:"consultarLab"            
        },
        beforeSend:function(){
            
        },
        success:function(data){
            
            
            if(data == 0){
                
                
            }else{
              var datos = JSON.parse(data);
              var i = 0;
              $("#datosLab").html("");
              $.each(datos,function(llave,valor){
                 
                  $("#datosLab").append(
                    "<tr>\n\
                     <td>"+valor.nit+"</td>\n\
                     <td>"+valor.nombre_labo+"</td>\n\
                     <td>"+valor.suc_nombre+"</td>\n\
                     <td>"+valor.direccion+"</td>\n\
                     <td>"+valor.telefono+"</td>\n\
                     <td>"+valor.contacto+"</td>\n\
                     <td>"+valor.mail+"</td>\n\
                     <td>"+valor.estado+"</td>\n\
                     <td><input id='eliminar"+i+"' name='eliminar"+i+"' value='Eliminar' type='button' class='btn btn-link' onclick='confirmacionEliminar("+i+")'></td>\n\
                     <input type='hidden' id='idLab"+i+"' name='idLab"+i+"' value='"+valor.id_laboratorio+"'></tr>"
                                             
                  );
                  
                  i=i+1;
                  
              });
                
            }
            
        }       
        
    });
    
    
}

function confirmacionEliminar(number){
    
    $("#ocultoId").val(number);
    $("#modalConfirm").modal('toggle');   
    
    
}

function eliminarLab(){
    
    $("#modalConfirm").modal('toggle');
    var number = $("#ocultoId").val();
       
    var idLab = $("#idLab"+number+"").val();
    
    $.ajax({
        type: 'POST',
        url: "../../vista/crearLaboratorioVista/asincCrearLaboratorio.php",
        data:{
            accion:"eliminarLab",
            idLab:idLab
        },
        dataType:"json",
        beforeSend:function(){
            $("#modalLoad").modal('toggle');
        
        },
        success:function(data){
            
            if(data == 1){
                
                consultarLabs();
                
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

function reiniciar(){
    
     $("#guardar").val("Guardar");
     $("#idLab").val("");
    
}


