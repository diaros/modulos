<!DOCTYPE html>
<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet" />
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.css" rel="stylesheet" />
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet"/>
        <link type="text/css" href="../../css/consultaRequisicionesCss/consultaRequisicionesCss.css" rel="stylesheet"/>
        <title>Consulta requisiciones</title>

    </head>

    <body>

        {$cabecera}

        <div id="contenedor" class="container">

            <legend>Consulta requisiciones</legend>
            
             <div class="alert alert-danger alert-dismissable" style="display:{$mostrarMsj}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Advertencia!</strong> <p>{$msjError}</p>
            </div>
            
            <form id="consultarReq" name="consultarReq" class="form-horizontal" action="../../vista/consultaRequisicionesVista/consultaRequisicionesVista.php" method="post" autocomplete="off">

                <input type="hidden" id="accion" name="accion">

                <div class="well" id="formulario" name="formulario">                   

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-5 control-label" for="fechaIni">Fecha inicial</label>  
                            <div class="col-md-7">
                                <input id="fechaIni" name="fechaIni"  placeholder="" class="form-control input-sm datepicker" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-5 control-label" for="estado">Estado</label>  
                            <div class="col-md-7">

                                <select id="estado" name="estado" class="form-control">
                                    <option value=""></option>
                                    {section name=estado loop=$estados}
                                        <option value="{$estados[estado].id}">{$estados[estado].descripcion}</option>
                                    {/section}  
                                </select>

                            </div>
                        </div>

                    </div>

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-5 control-label" for="fechaFin">Fecha final</label>  
                            <div class="col-md-7">
                                <input id="fechaFin" name="fechaFin"  placeholder="" class="form-control input-sm datepicker" type="text">
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-12" style="text-align: right;">

                        <a id="btnConsultar" class="btn btn-primary" onclick="consultar();">Consultar</a>
                        <a id="btnLimpiar" class="btn btn-danger" onclick="limpiar();">Limpiar</a>

                    </div>

                </div>
                                
                <hr>
                
                <div id="contenedorTabla" style="display:{$mostrarTabla}"> 

                <table class="table table-condensed table-hover table-responsive table-striped" id="datosRequicisiones">

                    <thead>

                        <tr>

                            <th>
                                Empresa                                
                            </th>

                            <th>
                                Requisición                                
                            </th>

                            <th>
                                Id usuario                                
                            </th>

                            <th>
                                Fecha revisado                                
                            </th>

                            <th>
                                Estado                                
                            </th>

                            <th>
                                Consultar                                
                            </th>

                            <th>
                                PDF                                
                            </th>                         

                        </tr>                       

                    </thead>

                    <tbody id="registros">

                        {section name=reporte loop=$reporte}

                        <div style="display: none;">{$number++}</div>

                        <tr id="fila{$number}">

                            <td>{$reporte[reporte].empresa}<input id="idEmpOculto{$number}" type="hidden" value="{$reporte[reporte].idEmp}"></td>

                            <td>{$reporte[reporte].requisicion}<input id="idReqOculto{$number}" type="hidden" value="{$reporte[reporte].requisicion}"></td>

                            <td>{$reporte[reporte].usuario}<input id="idUserOculto{$number}" type="hidden" value="{$reporte[reporte].usuario}"></td>

                            <td>{$reporte[reporte].fecha}</td>

                            <td>{$reporte[reporte].estado}</td>        

                            <td><a id="btnCon{$number}" class="btn btn-link" onclick="consulReq({$number});">Consultar</a></td>

                            <td><a id="btnPdf{$number}" class="btn btn-link" onclick="generarPdf({$number});">PDF</a></td>                                           

                        </tr>

                    {/section}                

                    </tbody>

                </table>
                    
                </div>

            </form>

        </div>

        <div class="modal fade" id="modalInfo">

            <div class="modal-dialog">
                
                <div class="modal-content" >

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
                <div class="modal-content">

                    <div class="modal-body" style="text-align: center;">
                        <img src="../../libs/imagenes/cargando.gif">
                    </div>

                </div>
            </div>
        </div>

        {$footer}

    </body>

    <script src="../../libs/jquery/jquery.js"></script>
    <script src="../../libs/bootstrap/js/bootstrap.js"></script>
    <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/bootstrap-datepicker.js"></script>
    <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/locales/bootstrap-datepicker.es.js"></script>     
    <script src="../../js/consultaRequisicionesJs/consultaRequisicionesJs.js"></script>

</html>