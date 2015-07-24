<!DOCTYPE html>

<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html:charset=UTF-8">

        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/css/datepicker3.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" />
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet"/> 
        <link type="text/css" href="../../css/consultaNominaCss/consultaNomina.css" rel="stylesheet"/> 

        <title>Consultar Nomina</title>
    </head>

    <body>

        {$cabecera}

        <div id="contenedor" class="container">

            <legend>Consultar Nomina</legend>

            <form id="formConsultarNomina" name='formAprobarNomina' class="form-horizontal" action='../../vista/consultaNominaVista/consultaNominaVista.php' method="post" enctype="multipart/form-data">

                <div class="well">

                    <div class="col-lg-12">

                        <div class="col-lg-4">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="empresaInt">Empresa interna:</label>
                                <div class="col-md-8">
                                    <select id="empresaInt" name="empresaInt" class="form-control" onchange="consultarempclientebysupervisor();">
                                        <option value=""></option>
                                        {section name=empInt loop=$empresaInterna}
                                            <option value="{$empresaInterna[empInt].cod_Empr}">{$empresaInterna[empInt].nom_empr}</option>
                                        {/section}    
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-4">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="empUsu">Empresa cliente:</label>
                                <div class="col-md-8">
                                    <select id="empUsu" name="empUsu" class="form-control" onchange="consultarcc();"></select>
                                </div>
                            </div>                     

                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="centroCosto">Centro costo:</label>
                                <div class="col-md-8">
                                    <select id="centroCosto" name="centroCosto" class="form-control" onchange=""></select>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-12">

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="ciudad">Ciudad:</label>
                                <div class="col-md-8">
                                    <select id="ciudad" name="ciudad" class="form-control">
                                        <option value=""></option>
                                        {section name=ciudadaux loop=$ciudades}
                                            <option value="{$ciudades[ciudadaux].suc_codigo}">{$ciudades[ciudadaux].suc_nombre}</option>
                                        {/section}    
                                    </select>
                                </div>
                            </div>
                        </div>                      

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="fecIni">Rango Fechas</label>
                                <div class="col-md-8">
                                    <div class="input-group">

                                        <input id="fecIni" name="fecIni" class="form-control fechas datepicker" placeholder="Fecha ini" type="text" onchange="valfechaini();"/>

                                        <span class="input-group-addon">-</span>

                                        <input id="fecFin" name="fecFin" class="form-control fechas datepicker" placeholder="Fecha fin" type="text" disabled/>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="consecutivo">Consecutivo:</label>
                                <div class="col-md-8">
                                    <div class="input-group">

                                        <input id="consecutivo" name="fecIni" class="form-control" placeholder="" type="text"/>                                       

                                    </div>

                                </div>
                            </div>
                        </div>            

                    </div>

                    <div class="col-lg-12" style="text-align: right;">
                        <a type="button" id="consultar" class="btn btn-primary" onclick="valvaciosforma();"><span class="fa fa-search"></span> Consultar</a>
                        <a type="reset"  id="limpiar"   class="btn btn-danger"  onclick="limpiarform();"><span class="fa fa-eraser"></span> Limpiar</a>
                    </div> 

                </div>

                <hr>

                <div id="contenedorDatosConsulta">

                    <div id="contenedorAcumulados">

                        <div class="row" style="font-size: 10px;">

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-dollar fa-4x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div id="adicionales" class="huge numeroInfo"></div>
                                                <div><a class="linkDetalle" id="linkAdicionales" onclick="detAdicionales();">Adicionales</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                <div id="panelUserReg" class="panel panel-info">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-user fa-4x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div id="totalUsers" class="huge numeroInfo"></div>
                                                <div>Usuarios Registrados</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                <div id="panelHrsOrdi" class="panel panel-info">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-clock-o fa-4x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div id="hrsOrdinarias" class="huge numeroInfo"></div>
                                                <div>Horas Ordinarias</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-clock-o fa-4x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div id="hrsDominicales" class="huge numeroInfo"></div>
                                                <div><a class="linkDetalle" id="linkDetDominicales" onclick="detDominicales();">Horas Dominicales</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-clock-o fa-4x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div id="hrsFestivos" class="huge numeroInfo"></div>
                                                <div><a class="linkDetalle" id="linkDetFestivos" onclick="detFestivos();">Horas Festivos</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>                       

                    </div>

                    <div id="contenedorTabla" style="display:{$mostrarTabla}">             

                        <div class="panel panel-default table-responsive">

                            <div class="panel-heading">Nominas registradas</div>

                            <div class="panel-body">

                                <table id="tablaDatosReg" class="table table-condensed table-hover table-striped">

                                    <thead id="cabeceraDatosNomina">

                                        <tr>
                                            <td class="tdTitle">Consecutivo</td>
                                            <td class="tdTitle">Centro costo</td>
                                            <td class="tdTitle">Ciudad</td>
                                            <td class="tdTitle">Supervisor</td>
                                            <td class="tdTitle">Periodo</td>
                                            <td class="tdTitle">Estado</td>
                                            <td class="tdTitle">Excel</td>
                                            <td class="tdTitle">Plano</td>                                            
                                        </tr>

                                    </thead>

                                    <tbody id="datosNomina">
                                    </tbody>                 

                                </table>
                          
                            </div>                        

                        </div>                         

                    </div>

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

        <div class="modal fade modalDatos" id="modalInfoDatos">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="tituloModalDatos"></h4>
                    </div>

                    <div class="modal-body" id="cuerpoModalDatos">
                    </div>

                    <div class="modal-footer" style="margin-top: 20px;">
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->  

        <div id="modaldetNomina" class="modal fade bs-example-modal-lg " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">

            <div class="modal-dialog modal-lg">

                <div class="modal-content modalDatos">

                    <div class="modal-header" id="titulodDetNomina">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Detalle nomina</h4>
                    </div>

                    <div class="modal-body" id="bodyDetModal">

                        <input type="hidden" id="ocultoIdNomina"/>

                        <div class="row" style="font-size: 10px;">

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-dollar fa-4x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div id="totalAdicionales" class="huge numeroInfo"></div>
                                                <div><a id="linkDetAdicionales" onclick="mostrarDetAdicionales();">Detalle Adicionales</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                <div id="panelUserReg" class="panel panel-info">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-user fa-4x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div id="totalUsers2" class="huge numeroInfo"></div>
                                                <div>Usuarios Registrados</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                <div id="panelHrsOrdi" class="panel panel-info">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-clock-o fa-4x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div id="hrsHabiles2" class="huge numeroInfo"></div>
                                                <div>Horas Habiles</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-clock-o fa-4x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div id="hrsDominicales2" class="huge numeroInfo"></div>
                                                <div>Horas Dominicales</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-clock-o fa-4x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div id="hrsFestivos2" class="huge numeroInfo"></div>
                                                <div>Horas Festivos</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">Usuarios registrados</div>
                            <div class="panel-body">
                                <table id="tablaDatos" class="table table-hover table-striped table-condensed">

                                    <thead id="cabeceraDatosUser">
                                        <tr id="filaEncabezados">                                
                                        </tr>
                                    </thead>

                                    <tbody id="datosUsuario">
                                    </tbody>

                                </table>
                            </div>    

                        </div>

                    </div>

                    <div class="modal-footer">

                    </div>

                </div>

            </div>

        </div>
        
        {$footer}

        <script src="../../libs/jquery/jquery.js"></script>  
        <script src="../../libs/bootstrap/js/bootstrap.js"></script>
        <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/bootstrap-datepicker.js"></script>
        <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/locales/bootstrap-datepicker.es.js"></script> 
        <script src="../../js/consultaNominaJs/consultaNomina.js"></script> 

    </body>        

</html>