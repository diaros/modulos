    <!DOCTYPE html>

    <html>

        <head>

            <meta http-equiv="Content-Type" content="text/html:charset=UTF-8" >

            <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet"/>
            <link type="text/css" href="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/css/datepicker3.css" rel="stylesheet"/>
            <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" />
            <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet"/> 
            <link type="text/css" href="../../css/aprobarNominaCss/aprobarNominaCss.css" rel="stylesheet"/> 

            <title>Aprobar Nomina</title>

        </head>

        <body>

            {$cabecera}

            <div id="contenedor" class="container">

                <legend>Aprobar Nomina</legend>

                <form id="formAprobarNomina" name='formAprobarNomina' class="form-horizontal" action='../../vista/aprobarNominaVista/aprobarNominaVista.php' method="post" enctype="multipart/form-data">

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

                            {*<div class="col-lg-4">
                            <div class="form-group">
                            <label class="col-md-4 control-label" for="estado">Estado:</label>
                            <div class="col-md-8">
                            <select id="estado" name="estado" class="form-control">
                            <option value=""></option>
                            {section name=estado loop=$estados}
                            <option value="{$estados[estado].id}">{$estados[estado].estado}</option>
                            {/section}    
                            </select>
                            </div>
                            </div>
                            </div>*}

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

                        </div>

                        <div class="col-lg-12">

                            <div class="col-lg-4">

                            </div>

                        </div>

                        <div class="col-lg-12" style="text-align: right;">
                            <a type="button" id="consultar" class="btn btn-primary" onclick="valvaciosforma();"><span class="fa fa-search"></span> Consultar</a>
                            <a type="reset"  id="limpiar"   class="btn btn-danger"  onclick="limpiarform();"><span class="fa fa-eraser"></span> Limpiar</a>
                        </div>                

                    </div>

                    <hr>

                    <div>                 

                        <div class="row" style="font-size: 10px;">

                            <div class="col-lg-12 col-md-12">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-dollar fa-4x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div id="adicionales" class="huge numeroInfo"></div>
                                                <div>Adicionales</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
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

                            <div class="col-lg-3 col-md-6">
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

                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-clock-o fa-4x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div id="hrsDominicales" class="huge numeroInfo"></div>
                                                <div>Horas Dominicales</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-clock-o fa-4x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div id="hrsFestivos" class="huge numeroInfo"></div>
                                                <div>Horas Festivos</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                               

                        </div>          

                    </div>

                    <div id="contenedorTabla" style="display:{$mostrarTabla}" class="table-responsive">             

                        <div class="panel panel-default">

                            <div class="panel-heading">Nominas registradas</div>

                            <div class="panel-body">

                                <table id="tablaDatosReg" class="table table-condensed table-hover table-striped">

                                    <thead id="cabeceraDatosNomina">

                                        <tr>
                                            <td class="tdNum">Consecutivo</td>
                                            <td class="tdNum">Centro costo</td>
                                            <td class="tdNum">Ciudad</td>
                                            <td class="tdNum">Supervisor</td>
                                            <td class="tdNum">Periodo</td>
                                            <td class="tdNum">Estado</td>
                                            <td class="tdNum"><p>Selecionar todos</p><input id="selecTodos" type="checkbox" onclick="valSelectTodos();"/></td>
                                        </tr>

                                    </thead>

                                    <tbody id="datosNomina">
                                    </tbody>                 

                                </table>

                                <div id="contentBtn2" class="col-lg-12" style="text-align: right;">
                                    <a type="button" id="consultar" class="btn btn-primary" onclick="aprobarRegNom();"><span class="fa fa-check"></span> Aprobar</a>
                                </div> 

                            </div>                        

                        </div>                         

                    </div> 

                </form>            

            </div>

            <div class="modal fade" id="modalLoad">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body" style="text-align: center;">
                            <img src="../../libs/imagenes/cargando.gif">
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

            <script src="../../libs/jquery/jquery.js"></script>  
            <script src="../../libs/bootstrap/js/bootstrap.js"></script>
            <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/bootstrap-datepicker.js"></script>
            <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/locales/bootstrap-datepicker.es.js"></script> 
            <script src="../../js/aprobarNominaJs/aprobarNomina.js"></script> 

        </body>    

    </html>