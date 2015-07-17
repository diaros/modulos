<!DOCTYPE html>

<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.css" rel="stylesheet" />
        <link type="text/css" href="../../css/relacionLabExamenCss/relacionLabExamenCss.css" rel="stylesheet"> 
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet"> 

        <title>Relacion laboratorio examen</title>

    </head>

    <body>

        {$cabecera}

        <div id="contenedor" class="container">

            <legend>Relacion laboratorio examen</legend>

            <div class="alert alert-danger alert-dismissable" style="display:{$mostrarMsj}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Advertencia!</strong> <p>{$msjError}</p>
            </div>

            <div class="alert alert-info alert-dismissable" style="display:{$mostrarMsjExito}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Informacion!</strong> <p>{$msjExito}</p>
            </div>

            <form id="relacionLabExamenForm" name="relacionLabExamenForm" class="form-horizontal" action="../../vista/relacionLabExamenVista/relacionLabExamenVista.php" method="post" autocomplete="off">

                <input type="hidden" name="accion" value="" />
                <input type="hidden" name="totalReg" id="totalReg" value="" />

                <div class="well" id="forma">
                    <div class="col-lg-5">
                        <div class="form-group">

                            <label class="col-md-4 control-label" for="laboratorio">Laboratorio</label>

                            <div class="col-md-8">

                                <select id="laboratorio" name="laboratorio" class="form-control" onchange="valSeleccionLab();">

                                    <option value=""></option>
                                    {section name=laboratorio loop=$laboratorios}
                                        <option value="{$laboratorios[laboratorio].id_laboratorio}">{$laboratorios[laboratorio].nombre}</option>
                                    {/section}

                                </select>

                            </div>

                        </div> 
                    </div>

                    <div class="col-lg-12" id="botones">

                        <input type="button" id="guardar" value="Guardar" class="btn btn-primary" onclick="valExamsSeleccionados();" disabled="true">
                        <input type="button" id="limpiar" value="Limpiar" class="btn btn-danger" onclick="reiniciar();">

                    </div>  

                </div>

                <hr>

                <div id="tablaRelLabExam" class="col-lg-12" style="display:{$mostrarConsulta};">

                    <table class="table table-hover table-striped table-condensed">

                        <thead>

                            <tr>
                                <th>Examen</th>
                                <th>Categoria</th>
                                <th>Valor</th>
                                <th>Estado</th>
                            </tr>

                        </thead>                        

                        <tbody id="datosRelLabExam">
                        </tbody>

                    </table>

                </div>


            </form>


        </div>

        <div class="modal fade" id="modalLoad">
            <div class="modal-dialog">
                <div class="modal-content noFondoModal">
                    <div class="modal-body" style="text-align: center;">
                        {*<img src="../../libs/imagenes/cargando.gif">*}
                        <span class=" fa fa-cog fa-spin fa-6x iconblue"></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalInfo">

            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="tituloModal"></h4>
                    </div>

                    <div class="modal-body" id="cuerpoModal">

                    </div>

                    <div class="modal-footer">

                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->    


        {$footer}

    </body>

    <script src="../../libs/jquery/jquery.js"></script>
    <script src="../../libs/bootstrap/js/bootstrap.js"></script> 
    <script src="../../js/relacionLabExamenJs/relacionLabExamen.js"></script>


</html>