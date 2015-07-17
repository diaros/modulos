<!DOCTYPE html>

<html>

    <head>
        
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">        

        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.css" rel="stylesheet" />
        <link type="text/css" href="../../css/relacionPsicoloClienteCss/relacionPsicologoClienteCss.css" rel="stylesheet"> 
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet"> 

        <title>Relacion Psicologo cliente</title>

    </head>

    <body>

        {$cabecera}

        <div id="contenedor" class="container">

            <legend>Relacion psicologo cliente</legend>

            <div class="alert alert-danger alert-dismissable" style="display:{$mostrarMsj}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Advertencia!</strong> <p>{$msjError}</p>
            </div>

            <div class="alert alert-info alert-dismissable" style="display:{$mostrarMsjExito}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Informacion!</strong> <p>{$msjExito}</p>
            </div>

            <form id="crearPsicologoCliente" name="crearPsicologoCliente" class="form-horizontal" action="../../vista/relacionPsicologoClienteVista/relacionPsicologoClienteVista.php" method="post" autocomplete="off">

                <input type="hidden" name="accion" value="" />
                <input type="hidden" name="totalReg" id="totalReg" value="" />


                <div class="well" id="forma">

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="usuario">Psicologo/a</label>
                            <div class="col-md-8">
                                <select id="usuario" name="usuario" class="form-control" onchange="valSeleccion();">

                                    <option value=""></option>
                                    {section name=usuarioPsico loop=$usuariosPsico}
                                        <option value="{$usuariosPsico[usuarioPsico].usu_id}">{$usuariosPsico[usuarioPsico].usu_nombre}</option>
                                    {/section}

                                </select>

                            </div>

                        </div>                     

                    </div>

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="empInt">Empresa interna</label>
                            <div class="col-md-8">

                                <select id="empInt" name="empInt" class="form-control" onchange="valSeleccion();">

                                    <option value=""></option>
                                    {section name=empInt loop=$empInternas}
                                        <option value="{$empInternas[empInt].cod_Empr}">{$empInternas[empInt].nom_empr}</option>
                                    {/section}

                                </select>

                            </div>

                        </div>                     

                    </div>

                    <div class="col-lg-12" id="botones">

                        <input type="button" id="guardar" value="Guardar" class="btn btn-primary" onclick="valClientesSeleccionados();" disabled="true">
                        <input type="button" id="limpiar" value="Limpiar" class="btn btn-danger" onclick="reiniciar();">

                    </div>                               

                </div>

                <hr>

                <div id="tablaRelPsicologoCliente" class="col-lg-12" style="display:{$mostrarConsulta};">

                    <table class="table table-hover table-striped table-condensed">

                        <thead>

                            <tr>
                                <th>Cliente</th>
                                <th>Nit</th>
                                <th>Estado</th>
                            </tr>

                        </thead>                        

                        <tbody id="datosRelPsicoClient">
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
    <script src="../../js/relacionPsicologoClienteJs/relacionPsicologoCliente.js"></script>


</html>