<!DOCTYPE html>

<html>

    <head>
        
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">       

        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.css" rel="stylesheet" />
        <link type="text/css" href="../../css/relacionClienteTipoExamenCss/relacionClienteTipoExamenCss.css" rel="stylesheet"> 
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet"> 

        <title>Relacion cliente tipo examen</title>        

    </head>

    <body>
        {$cabecera}

        <div id="contenedor" class="container">

            <legend>Relacion cliente examen</legend>

            <div class="alert alert-danger alert-dismissable" style="display:{$mostrarMsj}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Advertencia!</strong> <p>{$msjError}</p>
            </div>

            <div class="alert alert-info alert-dismissable" style="display:{$mostrarMsjExito}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Informacion!</strong> <p>{$msjExito}</p>
            </div>

            <form id="crearRelacionClienteExamen" name="crearRelacionClienteExamen" class="form-horizontal" action="../../vista/relacionClienteTipoExamenVista/relacionClienteTipoExamenVista.php" method="post" autocomplete="off">

                <div class="well" id="forma">

                    <input type="hidden" name="accion" value="" />
                    <input type="hidden" name="totalReg" id="totalReg" value="" />

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="empInt">Empresa interna</label>
                            <div class="col-md-8">
                                <select id="empInt" name="empInt" class="form-control" onchange="consultarEmpUsuaria();">

                                    <option value=""></option>
                                    {section name=empInt loop=$empInternas}
                                        <option value="{$empInternas[empInt].cod_Empr}">{$empInternas[empInt].nom_empr}</option>
                                    {/section}

                                </select>
                            </div>
                        </div>                     

                    </div>

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="empUsu">Empresa usuario</label>
                            <div class="col-md-8">
                                <select id="empUsu" name="empUsu" class="form-control" onchange="consultarExamenes();">                                   

                                </select>
                            </div>
                        </div>                     

                    </div>

                    <div class="col-lg-12" id="botones">

                        <input type="button" id="guardar" value="Guardar" class="btn btn-primary" onclick="valExamSeleccionados();" disabled="true">
                        <input type="button" id="limpiar" value="Limpiar" class="btn btn-danger" onclick="reiniciar();">

                    </div>                

                </div>

                <hr>

                <div id="tablaTipoExamenes" class="col-lg-12" style="display:{$mostrarConsulta};">

                    <table class="table table-hover table-striped table-condensed" id="tablaExamenes">

                        <thead>
                            <tr>
                                <th>Examen</th>
                                <th>Categoria</th>
                                <th>Naturaleza</th>
                                <th>Valor</th>
                                <th>Estado</th>
                            </tr>
                        </thead>                        

                        <tbody id="datosExamenes">
                        </tbody>
                        
                    </table>

                </div>

            </form>

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

        {$footer}

    </body>
    
     <script src="../../libs/jquery/jquery.js"></script>  
     <script src="../../libs/bootstrap/js/bootstrap.js"></script> 
     <script src="../../js/relacionClienteTipoExamenJs/relacionClienteTipoExamen.js"></script>

</html>