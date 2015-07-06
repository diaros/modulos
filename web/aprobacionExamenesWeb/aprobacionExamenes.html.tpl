<!DOCTYPE html>
<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">        

        <link type="text/css" href="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/css/datepicker3.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" />
        <link type="text/css" href="../../css/aprobacionExamenesCss/aprobacionExamenesMedicosCss.css" rel="stylesheet" />
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet" /> 

        <title>Aprobacion Examenes</title>

    </head>

    <body>

        {$cabecera}

        <div id="contenedor" class="container">

            <legend>Aprobación Examenes</legend>

            <div class="alert alert-danger alert-dismissable" style="display:{$mostrarMsj}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Advertencia!</strong> <p>{$msjError}</p>
            </div>

            <div class="alert alert-info alert-dismissable" style="display:{$mostrarMsjExito}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Informacion!</strong> <p>{$msjExito}</p>
            </div>

            <form id="aprobacionExamenesForm" name="aprobacionExamenesForm" class="form-horizontal" action="../../vista/aprobacionExamenesVista/aprobacionExamenesVista.php" method="post" autocomplete="off"> 

                <div id="forma" class="well">

                    <input type="hidden" name="accion" value=""/>

                    <div class="col-lg-5">

                        <div class="form-group ">
                            <label class="col-md-4 control-label" for="fechaIni">Fecha inicial:</label>  
                            <div class="col-md-8">
                                <input id="fechaIni" name="fechaIni" placeholder="Fecha inicial" class="form-control input-md datepicker" type="text">
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="fechaFin">Fecha final:</label>  
                            <div class="col-md-8 ">
                                <input id="fechaFin" name="fechaFin" placeholder="Fecha final" class="form-control input-md datepicker" type="text">
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-5 ">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="solicitud">No. Solicitud:</label>  
                            <div class="col-md-8">
                                <input id="solicitud" name="solicitud" placeholder="No. Solicitud" class="form-control input-md" type="text">                                
                            </div>
                        </div>
                        
                    </div>

                    <div class="col-lg-5 ">
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="cedula">Cedula:</label>  
                            <div class="col-md-8">
                                <input id="cedula" name="cedula" placeholder="Cedula" class="form-control input-md" type="text">                                
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-5 ">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="estado">Estado:</label>
                            <div class="col-md-8">
                                <select id="estado" name="estado" class="form-control">
                                    <option value=""></option>
                                    <option value="1">Ejecutado</option>
                                    <option value="0">No ejecutado</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12" id="botones">

                        <input type="button" id="aprobar" value="Ejecutar" class="btn btn-success" onclick="valSeleccionados();" style="display:{$mostrarBtn}">
                        <input type="button" id="consultar" value="Consultar" class="btn btn-primary" onclick="validarVacios();">
                        <input type="reset" id="limpiar" value="Limpiar" class="btn btn-danger" onclick="reiniciar();">

                    </div>

                </div>

                <hr>

                <div id="tablaAprobacionExamenes" class="col-lg-12" style="display:{$mostrarConsulta};">

                    <table class="table table-hover table-striped table-condensed" id="datosExamenes">

                        <thead>

                            <tr>
                                <th>Id orden</th>
                                <th>Empleado</th>
                                <th>Cedula</th>
                                <th>Examen</th>
                                    {*                                <th>Laboratorio</th>*}
                                <th>Estado</th>
                                <th>Apto</th>                               
                                <th>Ejecutado</th>    
                            </tr>
                            {*                            <tr>*}
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>
                            <input id="marcarTodos" name="marcarTodos" type="checkbox" onclick="marcar();">
                        </th>

                        {*                            </tr>*}

                        </thead>

                        <tbody>

                            {section name=reporte loop=$reporte}
                                <tr>

                            <div style="display: none;">{$number++}</div>

                            <td>{$reporte[reporte].id_solicitud_examen}</td>
                            <td>{$reporte[reporte].nombre}</td>
                            <td>{$reporte[reporte].cedula}</td>
                            <td>{$reporte[reporte].nombre_examen}</td>
                            {*                                    <td>{$reporte[reporte].nombre_labo}</td>*}
                            <td>{$reporte[reporte].estado}
                                <input type="hidden" id="estadoOculto{$number}" name="estadoOculto{$number}" value="{$reporte[reporte].estado}"/>
                                <input type="hidden" id="idItem{$number}" name="idItem{$number}" value="{$reporte[reporte].idReg}"/>
                            </td>

                            <td>
                                <select id="apto{$number}" name="apto{$number}" disabled="true">
                                    <option value="-1"></option>
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                </select>
                                <input type="hidden" id="aptoOculto{$number}" name="aptoOculto{$number}" value="{$reporte[reporte].apto}">    
                            </td>

                            <td>
                                <input id="estado{$number}" name="estado{$number}" type="checkbox" onchange="valEstado(estadoOculto{$number},{$number},{$reporte[reporte].idReg});">
                            </td>

                            </tr>
                        {/section}    
                        <tr>                           
                        </tr>

                        </tbody>

                    </table>

                    <div id="paginador">

                        <input type="hidden" value="{$paginaAct}" id="indicePagina"/>
                        <ul class="pagination pagination-sm">
                            <li><a href="../../vista/aprobacionExamenesVista/aprobacionExamenesVista.php?fechaIni={$fechaIni}&fechaFin={$fechaFin}&cedula={$cedula}&solicitud={$idSolicitud}&estado={$estado}&usuElab={$usuElab}&accion=Consultar&pagina={$paginaPrev}"><<</a></li>

                            {section name=pagina loop=$paginador}                    
                                <li id="pag{$paginador[pagina].pagina}" class="">
                                    <a href="../../vista/aprobacionExamenesVista/aprobacionExamenesVista.php?fechaIni={$fechaIni}&fechaFin={$fechaFin}&cedula={$cedula}&solicitud={$idSolicitud}&estado={$estado}&usuElab={$usuElab}&accion=Consultar&pagina={$paginador[pagina].pagina}">{$paginador[pagina].pagina}</a>
                                </li>                    
                            {/section}

                            <li><a href="../../vista/aprobacionExamenesVista/aprobacionExamenesVista.php?fechaIni={$fechaIni}&fechaFin={$fechaFin}&cedula={$cedula}&solicitud={$idSolicitud}&estado={$estado}&usuElab={$usuElab}&accion=Consultar&pagina={$paginaPos}">>></a></li>

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
                        <h4 class="modal-title">Advertencia</h4>
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
    <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/bootstrap-datepicker.js"></script>
    <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/locales/bootstrap-datepicker.es.js"></script>        
    <script src="../../libs/bootstrap/js/bootstrap.js"></script>  
    <script src="../../js/aprobacionExamenesJs/aprobacionExamenes.js"></script>

</html>