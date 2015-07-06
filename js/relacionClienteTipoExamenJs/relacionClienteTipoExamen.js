function consultarEmpUsuaria() {

    var idEmpInt = $("#empInt").val();

    $.ajax({
        type: 'POST',
        url: "../../vista/relacionClienteTipoExamenVista/asincRelacionClienteTipoExamen.php",
        data: {
            accion: "consultaEmpUsuarias",
            idEmpInt: idEmpInt
        },
        dataType: "json",
        beforeSend: function() {},
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

    });

}

function consultarExamenes() {


    var idEmpInt = $("#empInt").val();
    var nitEmpUsu = $("#empUsu").val();

    $.ajax({
        type: 'POST',
        url: "../../vista/relacionClienteTipoExamenVista/asincRelacionClienteTipoExamen.php",
        data: {
            accion: "consultarExamenes",
            idEmpInt: idEmpInt,
            nitEmpUsu: nitEmpUsu
        },
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

                var datos = JSON.parse(data);
                var i = 0;
                $("#datosExamenes").html("");

                $.each(datos, function(llave, valor) {
                    
                     if(valor.estado_exam == 'Activo'){
                        
                        var estilo = 'danger';
                        
                    }else{
                    
                        var estilo = '';
                    }

                    $("#datosExamenes").append(
                            "<tr class='"+estilo+"'>\n\
                       <td><input type='hidden' id='idExam" + i + "' name='idExam" + i + "' value='" + valor.id_tipo_examen + "'>" + valor.nombre_examen + "</td>\n\
                       <td>" + valor.categoria + "</td>\n\
                       <td><select id='naturaleza" + i + "' name='naturaleza" + i + "' class='form-control'>\n\
                           <option value='0'>Seleccione</option>\n\
                           <option value='1'>Facturable al cliente</option>\n\
                           <option value='2'>Asumido por la empresa</option>\n\
                           <option value='3'>Cobrado al trabajador</option>\n\
                           </select>\n\
                       </td>\n\
                       <td><input type='hidden' id='vlrOculto" + i + "' name='vlrOculto" + i + "' value=" + valor.vlr_examen + "><input type='text' id='vlrExamen" + i + "' name='vlrExamen" + i + "' value=" + valor.vlr_examen + " onchange='valNumerico(this);'></td>\n\
                       <td><input id='estadoExamenOculto" + i + "' name='estadoExamenOculto" + i + "' type='hidden' value=" + valor.estado_exam + "/>\n\
                       <input id='estadoExamen" + i + "' name='estadoExamen" + i + "' type=checkbox onchange='valCheck("+i+");'></td>\n\
                       <input type='hidden' id='idRelacionOculto" + i + "' name='idRelacionOculto" + i + "' value='" + valor.id_relacion + "' ></tr>"

                            );

                    if ($("#estadoExamenOculto" + i + "").val() == 'Activo/') {

                        $("#estadoExamen" + i + "").prop("checked", true);

                    } else {

                        $("#estadoExamen" + i + "").prop("checked", false);
                    }
                    
                    if (valor.facturable != null) {

                        $("#naturaleza" + i + "").val(valor.facturable);
                    }
                    
                    if($("#empInt").val() == 3){                    
                        
//                        if(valor.estado_exam == 'Activo'){
                              
                              $("#naturaleza"+i).val(2);
                              $("#naturaleza"+i).prop("disabled",true);
                            
//                        }                       
                    }

                    i = i + 1;
                });

                $("#totalReg").val(i);

//              $("#tablaTipoExamenes").css("display", "block");
                $("#tablaTipoExamenes").fadeIn("slow");
                
                $("#guardar").prop("disabled", false);

            }
        }

    });

}

function valCheck(number){
    
    if($("#estadoExamen"+number).prop('checked') == false && $("#empInt").val() != '3'){
       
        $("#naturaleza"+number).val("0");
        $("#vlrExamen"+number).val("0");
        $("#vlrEOculto"+number).val("");
        
    }else if($("#estadoExamen"+number).prop('checked') == false && $("#empInt").val() == '3'){
        
        $("#vlrExamen"+number).val("0");
        $("#vlrEOculto"+number).val("");
        
    }
    
    if($("#estadoExamen"+number).prop('checked') == true && $("#empInt").val() == '3'){
        
        $("#naturaleza"+number).val(2);
        
        
    }
    
    
}

function valExamSeleccionados() {    
    
   var longTabla = $("#tablaExamenes >tbody >tr").length;
   var i;
   for(i = 0; i<= longTabla ; i++){
      
       $("#naturaleza"+i).prop("disabled",false);
       
   }

    document.crearRelacionClienteExamen.accion.value = "relacionar";
    document.forms['crearRelacionClienteExamen'].submit();

}

function valNumerico(elemento) {

    var id = elemento.id;
    var x = $.isNumeric(elemento.value);

    if (x === false && elemento.value !== "") {

        $("#tituloModal").html("Advertencia");
        $("#cuerpoModal").html("Debe ingresar un valor numerico.");
        $("#modalInfo").modal('toggle');

        $('#' + id + '').val("");

    }

}

function reiniciar() {

    document.getElementById("crearRelacionClienteExamen").reset();
    
//    $("#tablaTipoExamenes").css("display", "none");
    $("#tablaTipoExamenes").fadeOut("slow");
    
    $("#guardar").prop("disabled", true);
}