<!DOCTYPE html>
<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">    

        <link type="text/css" href="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/css/datepicker3.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" />
        {*        <link type="text/css" href="../../libs/DataTables-1.10.3/media/css/jquery.dataTables.min.css">*}
        <link type="text/css" href="../../css/consultaExamenesCss/consultaExamenesCss.css" rel="stylesheet" />
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet" />

        <title>Consulta Examenes</title>

    </head>

    <body>
        {$cabecera}

        <div id="contenedor" class="container">

            <legend>Consulta Examenes</legend>

            <div class="alert alert-danger alert-dismissable" style="display:{$mostrarMsj}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Advertencia!</strong> <p>{$msjError}</p>
            </div>

            <div class="alert alert-info alert-dismissable" style="display:{$mostrarMsjExito}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Informacion!</strong> <p>{$msjExito}</p>
            </div>

            <form id="consultaExamenesForm" name="consultaExamenesForm" class="form-horizontal" action="../../vista/consultaExamenesVista/consultaExamenesVista.php" method="post" autocomplete="off">

                <div id="forma" class="well">

                    <input type="hidden" name="accion" value="" />

                    <div class="col-lg-5">

                        <div class="form-group ">
                            <label class="col-md-4 control-label" for="fechaIni">Fecha inicial:</label>  
                            <div class="col-md-8">
                                <input id="fechaIniOculto" name="fechaIniOculto" value="{$fechaIni}" type="hidden">
                                <input id="fechaIni" name="fechaIni"  placeholder="Fecha inicial" class="form-control input-md datepicker" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="fechaFin">Fecha final:</label>  
                            <div class="col-md-8 ">
                                <input id="fechaFinOculto" name="fechaFinOculto" value="{$fechaFin}" type="hidden">
                                <input id="fechaFin" name="fechaFin" placeholder="Fecha final" class="form-control input-md datepicker" type="text">
                            </div>
                        </div>
                    </div>                  

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="empresaInt">Empresa interna:</label>
                            <div class="col-md-8">
                                <input type="hidden" id="empresaIntOculto" name="empresaIntOculto" value="{$empresaInt}">
                                <select id="empresaInt" name="empresaInt" class="form-control" onchange="consultarEmpClienteCE();">
                                    <option value=""></option>
                                    {section name=empInt loop=$empresaInterna}
                                        <option value="{$empresaInterna[empInt].cod_Empr}">{$empresaInterna[empInt].nom_empr}</option>
                                    {/section}    
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="cliente">Cliente:</label>
                            <div class="col-md-8">
                                <input type="hidden" id="clienteOculto" name="clienteOculto" value="{$cliente}">
                                <select id="cliente" name="cliente" class="form-control">
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-5 ">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="cedula">Cedula:</label>  
                            <div class="col-md-8">
                                <input id="cedulaOculto" name="cedulaOculto" value="{$cedula}" type="hidden"> 
                                <input id="cedula" name="cedula" placeholder="Cedula" class="form-control input-md" type="text">                                
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-5 ">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="estado">Estado:</label>
                            <div class="col-md-8">
                                <input id="estadoOculto" name="estadoOculto" value="{$estado}" type="hidden"> 
                                <select id="estado" name="estado" class="form-control">
                                    <option value=""></option>
                                    <option value="1">Ejecutado</option>
                                    <option value="0">No ejecutado</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="solicitud">Rango de id:</label>  
                            <div class="col-md-3">
                                <input id="solIniOculto" name="solIniOculto" value="{$solIni}" type="hidden"> 
                                <input id="solIni" name="solIni" placeholder="Id. inicial" class="form-control input-md" type="text"> 
                            </div>

                            <div class="col-md-1">
                                <span class="glyphicon glyphicon-minus"></span>
                            </div>
                            <div class="col-md-3">
                                <input id="solFinOculto" name="solFinOculto" value="{$solFin}" type="hidden"> 
                                <input id="solFin" name="solFin" placeholder="Id. Final" class="form-control input-md" type="text"> 
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-12" id="botones">

                        <button type="button" id="reporteExcel" name="reporteExcel" class="btn btn-success" style="display:{$mostrarBtnExcel}" onclick="generarExcel();"><span class="glyphicon glyphicon-file"></span> Reporte Excel </button>
                        <input type="button" id="consultar" value="Consultar" class="btn btn-primary" onclick="validarVacios();">
                        <input type="reset" id="limpiar" value="Limpiar" class="btn btn-danger" onclick="reiniciar();">

                    </div>

                </div>

                <hr>

                <div id="tablaConsultaExamenes" class="col-lg-12" style="display:{$mostrarConsulta};">

                    <table id="registrosExamenes" class="table table-hover table-striped table-condensed">

                        <thead>

                            <tr>
                                <th>Id orden</th>
                                <th>Empleado</th>
                                <th>Cedula</th>
                                <th>Examen</th>
                                    {*                                <th>Laboratorio</th>*}
                                <th>Estado</th>   
                            </tr>

                        </thead>

                        <tbody>

                            {section name=reporte loop=$reporte}
                                <tr>

                            <div style="display: none;">{$number++}</div>
                            <td>{$reporte[reporte].id_solicitud_examen}</td>
                            <td>{$reporte[reporte].nombre}</td>
                            <td>{$reporte[reporte].cedula}</td>
                            <td>{$reporte[reporte].nombre_examen}</td>
                            {*                            <td>{$reporte[reporte].nombre_labo}</td>*}
                            <td>{$reporte[reporte].estado}
                                <input type="hidden" id="estadoOculto{$number}" name="estadoOculto{$number}" value="{$reporte[reporte].estado}"/>
                                <input type="hidden" id="idItem{$number}" name="idItem{$number}" value="{$reporte[reporte].idReg}">
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
                            <li><a href="../../vista/consultaExamenesVista/consultaExamenesVista.php?fechaIni={$fechaIni}&fechaFin={$fechaFin}&empresaInt={$empresaInt}&cliente={$cliente}&solIni={$solIni}&solFin={$solFin}&cedula={$cedula}&estado={$estado}&accion=Consultar&pagina={$paginaPrev}"><<</a></li>

                            {section name=pagina loop=$paginador}                    
                                <li id="pag{$paginador[pagina].pagina}" class="">
                                    <a href="../../vista/consultaExamenesVista/consultaExamenesVista.php?fechaIni={$fechaIni}&fechaFin={$fechaFin}&empresaInt={$empresaInt}&cliente={$cliente}&solIni={$solIni}&solFin={$solFin}&cedula={$cedula}&estado={$estado}&accion=Consultar&pagina={$paginador[pagina].pagina}">{$paginador[pagina].pagina}</a>
                                </li>                    
                            {/section}

                            <li><a href="../../vista/consultaExamenesVista/consultaExamenesVista.php?fechaIni={$fechaIni}&fechaFin={$fechaFin}&empresaInt={$empresaInt}&cliente={$cliente}&solIni={$solIni}&solFin={$solFin}&cedula={$cedula}&estado={$estado}&accion=Consultar&pagina={$paginaPos}">>></a></li>

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
    <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/bootstrap-datepicker.js"></script>
    <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/locales/bootstrap-datepicker.es.js"></script>        
    <script src="../../libs/bootstrap/js/bootstrap.js"></script>  
    {*<script src="../../libs/DataTables-1.10.3/media/js/jquery.dataTables.min.js"></script>*}
    <script src="../../js/consultaExamenesJs/consultaExamenesJs.js"></script>

</html>