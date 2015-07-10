<!DOCTYPE html>
<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet" />
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.css" rel="stylesheet" />
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet"/>
        <link type="text/css" href="../../css/gestionRequisicionesCss/gestionRequisicionesCss.css" rel="stylesheet"/>      
        
        <title>Consulta requisiciones</title>

    </head>

    <body>

        {$cabecera}

        <div id="contenedor" class="container">

            <legend>Gestion requisiciones</legend>

            <div class="alert alert-danger alert-dismissable" style="display:{$mostrarMsj}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Advertencia!</strong> <p>{$msjError}</p>
            </div>

            <div class="alert alert-info alert-dismissable" style="display:{$mostrarMsjExito}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Información</strong> <p>{$msjExito}</p>
            </div>

            <form id="gestionReqForm" name="gestionReqForm" class="form-horizontal" action="../../vista/gestionRequisicionesVista/gestionRequisicionesVista.php" method="post" autocomplete="off">

                <input type="hidden" id="accion" name="accion">
                <input type="hidden" id="auxIdReg" name="auxIdReg">

                <div class="well" id="formulario" name="formulario">

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-5 control-label" for="fechaIni">Fecha inicial</label>  
                            <div class="col-md-7">
                                <input id="fechaIni" name="fechaIni"  placeholder="" class="form-control input-sm datepicker" type="text" value="{$fechaIni}">
                            </div>
                        </div>                

                    </div>

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-5 control-label" for="fechaFin">Fecha final</label>  
                            <div class="col-md-7">
                                <input id="fechaFin" name="fechaFin"  placeholder="" class="form-control input-sm datepicker" type="text" value="{$fechaFin}">
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-5 control-label" for="empresaInt">Empresa interna:</label>
                            <div class="col-md-7">
                                <select id="empresaInt" name="empresaInt" class="form-control">
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
                            <label class="col-md-5 control-label" for="requisicion">Numero Requisición:</label>  
                            <div class="col-md-7">
                                <input id="requisicion" name="requisicion" placeholder="" class="form-control input-md" type="text" value="{$numReq}">
                            </div>
                        </div>

                    </div>            

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-5 control-label" for="idUser">No Identificación:</label>  
                            <div class="col-md-7">
                                <input id="idUser" name="idUser" placeholder="" class="form-control input-md" type="text" onblur="consultarObserv();" value="{$idUser}">
                            </div>                            
                        </div>

                    </div>

                    <div class="col-lg-5">
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

                    <div class="col-lg-12" style="text-align: right;">

                        <a id="btnAceptar" class="btn btn-success" style="display: none;" onclick="confirmAceptar();">Archivar</a>
                        <a id="btnConsultar" class="btn btn-primary" onclick="consultar();">Consultar</a>
                        <a id="btnLimpiar" class="btn btn-danger" onclick="limpiar();">Limpiar</a>

                    </div>


                </div>

                <hr>

                <div id="contenedorTabla" style="display:{$mostrarTabla}" class="table-responsive"> 

                    <table class="table table-condensed table-hover table-striped" id="datosRequicisiones">

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
                                    Proceso                                
                                </th>
                                
                                <th>
                                    Usuario/Prestamo
                                </th>

                                <th>
                                    Archivar                                
                                </th>

                                <th>
                                    Prestar                                    
                                </th>                     

                            </tr>   


                        </thead>

                        <tbody  id="registros">

                            {section name=reporte loop=$reporte}

                            <div style="display: none;">{$number++}</div>

                            <tr id="fila{$number}">

                            <input id="idReg{$number}" name="idReg{$number}" type="hidden" value="{$reporte[reporte].idReg}">
                            <td>{$reporte[reporte].empresa}<input id="idEmpOculto{$number}" type="hidden" value="{$reporte[reporte].idEmp}"></td>

                            <td>{$reporte[reporte].requisicion}<input id="idReqOculto{$number}" type="hidden" value="{$reporte[reporte].requisicion}"></td>

                            <td>{$reporte[reporte].usuario}<input id="idUserOculto{$number}" type="hidden" value="{$reporte[reporte].usuario}"></td>

                            <td>{$reporte[reporte].fecha}</td>

                            <td>{$reporte[reporte].estado}<input id="estadoOculto{$number}" type="hidden" value="{$reporte[reporte].estado}"></td>

                            <td>{$reporte[reporte].proceso}</td>
                            
                            <td>{$reporte[reporte].observacion}</td>

                            <td><input name="aceptar{$number}" id="aceptar{$number}" type="checkbox" onchange="valCheck();"></td>                               

                            <td><a id="btnCon{$number}" class="btn btn-link" onclick="confirmPrestar({$number});">Prestar</a></td>                                

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

        <div class="modal fade" id="modalConfirmAceptar">

            <div class="modal-dialog">

                <div class="modal-content" style="overflow: hidden;">

                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="tituloModal2">Archivar</h4>

                    </div>

                    <div class="modal-body" id="cuerpoModal2">

                        <p>Confirma la recepcion de las requisiciones seleccionadas?</p>


                        <div class="col-lg-12" id="botones2" style="margin-top:20px;">

                            <input type="button" id="guardar" value="Confirmar" class="btn btn-primary" onclick="aceptar();">                         

                        </div>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal --> 

        <div class="modal fade" id="modalConfirmPrestar">

            <div class="modal-dialog">

                <div class="modal-content" style="overflow: hidden;">

                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="tituloModal2">Prestamo</h4>

                    </div>

                    <div class="modal-body" id="cuerpoModal2">

                        <p>Por favor seleccione el proceso a realizar el prestamo.</p>

                        <div class="form-group">
                            <label class="col-md-5 control-label" for="proceso">Proceso:</label>
                            <div class="col-md-7">
                                <select id="proceso" name="proceso" class="form-control">
                                    <option value=""></option>
                                    {section name=proceso loop=$procesos}
                                        <option value="{$procesos[proceso].id}">{$procesos[proceso].nombre}</option>
                                    {/section}    
                                </select>
                            </div>
                        </div>                        
                                
                        <div class="form-group">
                            
                            <label class="col-md-5 control-label" for="textinput">Observación:</label>  
                            <div class="col-md-7">
                            
                                <input id="observacion" name="observacion" type="text" placeholder="Observación" class="form-control input-md">

                            </div>
                        </div>                   


                        <div class="col-lg-12" id="botones2" style="margin-top:20px;">

                            <input type="button" id="guardar" value="Confirmar" class="btn btn-primary" onclick="prestamo();">                         

                        </div>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal --> 


        {$footer}

    </body>

    <script src="../../libs/jquery/jquery.js"></script>
    <script src="../../libs/bootstrap/js/bootstrap.js"></script>
    <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/bootstrap-datepicker.js"></script>
    <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/locales/bootstrap-datepicker.es.js"></script>     
    <script src="../../js/gestionRequisicionesJs/gestionRequisicionesJs.js"></script>

</html>