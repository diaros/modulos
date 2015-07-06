function utf8_encode(str) {
  str = str.replace(/\r\n/g,"\n");
  var output = "";
  for (var n = 0; n < str.length; n++) {
    var c = str.charCodeAt(n);
    if (c < 128) output += String.fromCharCode(c);
    else if((c > 127) && (c < 2048)) {
      output += String.fromCharCode((c >> 6) | 192);
      output += String.fromCharCode((c & 63) | 128);
    }
    else {
      output += String.fromCharCode((c >> 12) | 224);
      output += String.fromCharCode(((c >> 6) & 63) | 128);
      output += String.fromCharCode((c & 63) | 128);
    }
  }
  return output;
}


function valSeleccion() {

    var usuId = $("#usuario").val();
    var empId = $("#empInt").val();

    if (usuId == '' || empId == '') {

    } else {

        consultarRelaciones(usuId, empId);

    }

}

function consultarRelaciones(usuId, empId){

    $.ajax({
        type: 'POST',
        url: "../../vista/relacionPsicologoClienteVista/asincRelacionPsicologoCliente.php",
        data: {
            accion: "consultarRelacion",
            usuId: usuId,
            empId: empId
        },
        dataType: "json",
        beforeSend: function() {
            $("#modalLoad").modal('toggle');
        },
        success: function(data) {
         
            $("#modalLoad").modal('toggle');
            
            if (data == -1) {
                
                $("#tituloModal").html("Advertencia");
                $("#cuerpoModal").html("Ha ocurrido un error. Por favor vuelva a intentarlo. Si el problema persiste comuniquese con el departamento de desarrollo.");
                $("#modalInfo").modal('toggle');

            } else {

               // var datos = JSON.parse(data);
                var datos = data;
                var i = 0;
                $("#datosRelPsicoClient").html("");

                $.each(datos, function(llave, valor) {
                                    
                    if(valor.estado == 'Activo'){
                        
                        var estilo = 'info';
                        
                    }else{
                    
                        var estilo = '';
                    }
                    
                    //nombre = utf8_encode(valor.nombre);
                   
                    $("#datosRelPsicoClient").append(
                            
                                "<tr class='"+estilo+"' ><td>" + valor.nombre + "</td>\n\
                                <td>" + valor.nit + "</td>\n\
                                <td><input id='estadoRelOculto" + i + "' name='estadoRelOculto" + i + "' type='hidden' value=" + valor.estado + "/>\n\
                                <input id='estadoRel" + i + "' name='estadoRel" + i + "' type=checkbox></td>\n\
                                <input type='hidden' id='idRelOculto"+i+"' name='idRelOculto"+i+"' value="+valor.id_relacion_sicologo_cliente+">\n\
                                <input type='hidden' id='nitCliente"+i+"' name='nitCliente"+i+"' value="+valor.nit+" ></tr>"

                            );

                    if ($("#estadoRelOculto" + i + "").val() == 'Activo/') {

                        $("#estadoRel" + i + "").prop("checked", true);

                    } else {

                        $("#estadoRel" + i + "").prop("checked", false);
                    }

                    i = i + 1;

                });

//                $("#tablaRelPsicologoCliente").css("display","block");    
                $("#tablaRelPsicologoCliente").fadeIn("slow");
                
                $("#guardar").prop("disabled", false);
                $("#totalReg").val(i);
            }
        }

    });

}

function valClientesSeleccionados(){
    
    document.crearPsicologoCliente.accion.value = "relacionar";
    document.forms['crearPsicologoCliente'].submit();
    
}

function reiniciar(){

    document.getElementById("crearPsicologoCliente").reset();
//  $("#tablaRelPsicologoCliente").css("display", "none");
    $("#tablaRelPsicologoCliente").fadeOut("slow");
    
    $("#guardar").prop("disabled", true);
    
}


