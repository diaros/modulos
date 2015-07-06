function valSeleccionLab() {


    var idLab = $("#laboratorio").val();

    $.ajax({
        type: 'POST',
        url: "../../vista/relacionLabExamenVista/asincRelacionLabExamen.php",
        data: {
            accion: 'consultarExamenes',
            idLab: idLab
        },
        datatype: 'json',
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

                $("#datosRelLabExam").html("");

                $.each(datos, function(llave, valor) {

                    if (valor.estado == 'Activo') {

                        var estilo = 'danger';

                    } else {

                        var estilo = '';
                    }
                    
                    $("#datosRelLabExam").append(
                            
                            "<tr class='"+estilo+"'>\n\
                             <td>"+valor.nombre_examen+"\
                             <input type='hidden' id='idExam"+i+"' name='idExam"+i+"' value='"+valor.id_tipo_examen+"'></td>\n\
                             <td>"+valor.categoria+"</td>\n\
                             <td><input type='text' id='vlrExamen"+i+"' name='vlrExamen"+i+"' value='"+valor.vlr_examen+"'></td>\n\
                             <td><input id='estadoRelOculto" + i + "' name='estadoRelOculto" + i + "' type='hidden' value=" + valor.estado + "/>\n\
                             <input id='estadoRel" + i + "' name='estadoRel" + i + "' type=checkbox></td>\n\
                             <input type='hidden' id='idRelOculto"+i+"' name='idRelOculto"+i+"' value="+valor.id_relacion_laboratorio_examen+"></tr>"
                            
                            );
                    
                    if ($("#estadoRelOculto" + i + "").val() == 'Activo/') {

                        $("#estadoRel" + i + "").prop("checked", true);

                    } else {

                        $("#estadoRel" + i + "").prop("checked", false);
                    }

                    i = i + 1;

                });
                
//                $("#tablaRelLabExam").css("display","block");    
                $("#tablaRelLabExam").fadeIn("slow");
                
                $("#guardar").prop("disabled", false);
                $("#totalReg").val(i);

            }

        }

    });


}

function valExamsSeleccionados(){
    
    document.relacionLabExamenForm.accion.value = "relacionar";
    document.forms['relacionLabExamenForm'].submit();     
    
}

function reiniciar() {

    document.getElementById("relacionLabExamenForm").reset();
//    $("#tablaRelLabExam").css("display", "none");
    $("#tablaRelLabExam").fadeOut("slow");
    
    $("#guardar").prop("disabled", true);
}


