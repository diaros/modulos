<!DOCTYPE html>

<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

        <script src="../../libs/jquery/jquery.js"></script>  
        <script src="../../libs/bootstrap/js/bootstrap.js"></script> 
        <script src="../../libs/DataTables-1.10.3/media/js/jquery.dataTables.min.js"></script>
        <script src="../../js/anularSolicitudJs/anularSolicitud.js"></script>

        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/DataTables-1.10.3/media/css/jquery.dataTables.min.css">
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" />
        
        <link type="text/css" href="../../css/anularSolicitudCss/anularSolicitudCss.css" rel="stylesheet"/> 
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet"/> 

        <title>Anular solicitud</title>        

    </head>

    <body>

        {$cabecera}

        <div id="contenedor" class="container">

            <legend>Anular solicitud</legend>

            <div class="alert alert-danger alert-dismissable" style="display:{$mostrarMsj}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Advertencia!</strong> <p>{$msjError}</p>
            </div>

            <div class="alert alert-info alert-dismissable" style="display:{$mostrarMsjExito}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Informacion!</strong> <p>{$msjExito}</p>
            </div>

            <form id="anularSolicitudForm" name="anularSolicitudForm" class="form-horizontal" action="../../vista/anularSolicitudVista/anularSolicitudVista.php" method="post" autocomplete="off">

                <div class="well" id="forma">

                    <input type="hidden" name="accion" value="">

                    <div class="col-lg-5">

                        <div class="form-group">

                            <label class="col-md-4 control-label" for="consOrden">Consecutivo:</label>  

                            <div class="col-md-8">
                                <input id="consOrden" name="consOrden" placeholder="" class="form-control input-md" type="text">                          
                            </div>

                        </div>  

                    </div>

                    <div class="col-lg-12" id="botones">

                        <input type="button" id="anular" name="anular" value="Anular solicitud" class="btn btn-success" onclick="preguntar();" style="display:{$mostrarBtn}">
                        <input type="button" id="consultar" value="Consultar" class="btn btn-primary" onclick="valVaciosOrden();">
                        <input type="button" id="limpiar" value="Limpiar" class="btn btn-danger" onclick="reiniciar();">

                    </div> 

                </div>

                <hr>

                <div id="tablaConsultaOrden" class="col-lg-12" style="display:{$mostrarConsulta};">

                    <table id="tablaDatos" class="table table-hover table-striped table-condensed">

                        <thead>

                            <tr>

                                <th>Consecutivo</th>
                                <th>Empresa interna</th>
                                <th>Empresa cliente</th>
                                <th>Centro costo</th>
                                <th>Laboratorio</th>
                                <th>Usuario elaboro</th>
                                <th>Fecha elaboro</th>
                                <th>Estado</th>
                                <th>Anular</th>

                            </tr>

                        </thead>                        

                        <tbody id="datosOrden">

                            {section name=reporte loop=$reporte}
                                <tr>

                            <div style="display: none;">{$number++}</div>

                            <td>{$reporte[reporte].id_solicitud_examen}</td>
                            <td>{$reporte[reporte].nom_empr}</td>
                            <td>{$reporte[reporte].nom_cliente}</td>
                            <td>{$reporte[reporte].centro_costo}</td>
                            <td>{$reporte[reporte].nombre_lab}</td>
                            <td>{$reporte[reporte].usu_nombre}</td>
                            <td>{$reporte[reporte].fecha_proceso}</td>
                            <td>{$reporte[reporte].nombre}
                                <input type="hidden" id="estadoOculto{$number}" name="estadoOculto{$number}" value="{$reporte[reporte].nombre}"/>
                                <input type="hidden" id="idReg{$number}" name="idReg{$number}" value="{$reporte[reporte].id_solicitud_examen}">
                            </td>

                            <td>
                                <input id="estado{$number}" name="estado{$number}" type="checkbox">
                            </td>

                            </tr>
                        {/section}   

                        </tbody>

                    </table>

                    <div id="paginador">

                        <input type="hidden" value="{$paginaAct}" id="indicePagina"/>
                        
                        <ul class="pagination pagination-sm">
                            <li><a href="../../vista/anularSolicitudVista/anularSolicitudVista.php?solicitud={$idSolicitud}&usuElab={$usuElab}&accion=Consultar&pagina={$paginaPrev}"><<</a></li>

                            {section name=pagina loop=$paginador}                    
                                <li id="pag{$paginador[pagina].pagina}" class="">
                                    <a href="../../vista/anularSolicitudVista/anularSolicitudVista.php?solicitud={$idSolicitud}&usuElab={$usuElab}&accion=Consultar&pagina={$paginador[pagina].pagina}">{$paginador[pagina].pagina}</a>
                                </li>                    
                            {/section}

                            <li><a href="../../vista/anularSolicitudVista/anularSolicitudVista.php?solicitud={$idSolicitud}&usuElab={$usuElab}&accion=Consultar&pagina={$paginaPos}">>></a></li>

                        </ul>               

                    </div>

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

        <div class="modal fade" id="modalConfirm">

            <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="tituloModal"></h4>
                    </div>

                    <div class="modal-body" id="cuerpoModal">

                        <p>Esta seguro que desea anular esta solicitud?</p>

                        <div class="col-lg-12" id="botones2">

                            <input type="button" id="guardar" value="Confirmar" class="btn btn-primary" onclick="eliminarOrden();">

                        </div>

                    </div>

                    <div class="modal-footer">

                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal --> 

        {$footer}

    </body>

</html>