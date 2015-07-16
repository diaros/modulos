<!DOCTYPE html>

<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html:charset=UTF-8">
        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/css/datepicker3.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" />
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet"/> 
        <link type="text/css" href="../../css/reporteNominaPlanoCss/reporteNominaPlanoCss.css" rel="stylesheet"/> 
        <link type="text/css" href="../../libs/wow/css/animate.css" rel="stylesheet">

        <title>Reporte Nomina Plano</title>

    </head>

    <body>

        {$cabecera}

        <div id="contenedor" class="container">

            <legend>Reporte Nomina Plano</legend>  

            <form id="formReporteNominaPlano" name='formReporteNominaPlano' class="form-horizontal" action='../../vista/reporteNominaPlanoVista/reporteNominaPlanoVista.php' method="post" enctype="multipart/form-data">

                <div class="well">

                    <div class="col-lg-12">

                        <div class="col-lg-4">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="empresaInt">Empresa interna:</label>
                                <div class="col-md-8">
                                    <select id="empresaInt" name="empresaInt" class="form-control" onchange="consultarEmpClienteBySupervisor();">
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
                                    <select id="empUsu" name="empUsu" class="form-control" onchange="consultarCC();"></select>
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
                                        {section name=ciudad loop=$ciudades}
                                            <option value="{$ciudades[ciudad].suc_codigo}">{$ciudades[ciudad].suc_nombre}</option>
                                        {/section}    
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-4">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="mes">Mes:</label>
                                <div class="col-md-8">
                                    <input id="mes" name="mes"  placeholder="" class="form-control datepicker" type="text">
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-4">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="periocidad">Periodicidad:</label>
                                <div class="col-md-8">
                                    <select id="periocidad" name="periocidad" class="form-control" onchange="">
                                        <option value=""></option>  
                                        <option value="1">Primer quincena</option>                                    
                                        <option value="2">Segunda quincena</option>  
                                        <option value="3">Mensual</option>  
                                    </select>
                                </div>
                            </div>

                        </div>

                    </div>

                    <input type="hidden" id="empIntOculto" name="empIntOculto">
                    <input type="hidden" id="empCliOculto" name="empCliOculto">
                    <input type="hidden" id="centroCostoOculto" name="centroCostoOculto">
                    <input type="hidden" id="ciudadOculto" name="ciudadOculto">
                    <input type="hidden" id="mesOculto" name="mesOculto">
                    <input type="hidden" id="periocidadOculto" name="periocidadOculto">

                    <input type="hidden" id="nomArchivoOculto" name="nomArchivoOculto">

                    <div class="col-lg-12" style="text-align: right;">                                  

                        <a type="button" id="registrar" class="btn btn-primary" onclick="valArchivo();" style="display: none;"><span class="fa fa-arrow-up"></span>  Planilla</a>
                        <a type="button" id="plantilla" class="btn btn-primary" onclick="descargarPlantilla();" style="display: none;"><span class="fa fa-arrow-down"></span>  Planilla</a>
                        <a type="button" id="consultar"  class="btn btn-primary" onclick="valVacios();"><span class="fa fa-search"></span> Consultar</a>
                        <a type="reset"  id="limpiar"   class="btn btn-danger"  onclick="limpiarForm();"><span class="fa fa-eraser"></span> Limpiar</a>

                    </div>

                    <div id="contenedorBtnCargar" class="col-lg-12">

                        <div class="col-lg-5 col-md-offset-1" style="">
                            <input id="planillaNomina" name="planillaNomina" class="filestyle" type="file" data-buttonName="btn-primary" data-size="nr" data-input="true" data-buttonText="Seleccionar" onchange="valExtension();">
                        </div>                   

                    </div>          


                </div>
                
                <hr>
                {* <div class="col-lg-12">
                     
                <img src="../../libs/imagenes/iconos/Kameleon-Free-Pack/Multicolor/SVG/Round Icons/Batman.svg" alt="why so serius?">
                <img src="../../libs/imagenes/iconos/Kameleon-Free-Pack/Multicolor/SVG/Round Icons/Captain-Shield.svg" alt="why so serius?">

                </div>*}


                <div id="contenedorTablaErrores">                

                    <div class="panel panel-default table-responsive">

                        <div class="panel-heading">Listado de errores</div>
                        
                        <div class="panel-body">
                        
                            <table id="tablaErrores" class="table table-hover table-striped table-condensed">

                                <thead id="cabeceraErrores">
                                    <tr id="filaEncabezadosErrores">                                
                                    </tr>
                                </thead>

                                <tbody id="datosErrores">
                                </tbody>

                            </table>
                            
                        </div>    

                    </div>            


                </div>     

                <div id="contenedorTabla">

{*                    <legend>Datos registrados</legend>                   *}

                    <div class="row" style="font-size: 10px;">

                        <div id="contentUserSinReg" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

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
                                            <div id="hrsHabiles" class="huge numeroInfo"></div>
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
                                            <div id="hrsDominicales" class="huge numeroInfo"></div>
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
                                            <div id="hrsFestivos" class="huge numeroInfo"></div>
                                            <div>Horas Festivos</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-9 col-md-6 col-sm-6 col-xs-6">
                            <div id="contenedorEstadoPlanilla" class="panel panel-danger">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-file fa-4x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div id="estadoPlanilla" class="huge numeroInfo"></div>
                                            <div id="infoPlanilla">Estado Planilla</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
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

                    </div>           
                    <!-- /.row --> 

                    <div id="subContentTabla">

                        <div class="panel panel-default table-responsive">
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


                    <div class="col-lg-12" style="text-align: right;">

                        <a type="button" id="finalizar" class="btn btn-primary" onclick="confirmFinalizar();"><span class="fa fa-check"></span>Terminar</a> 
                        <a type="button" id="eliminar" class="btn btn-danger" onclick="confirmEliminar();"><span class="fa fa-close"></span>Eliminar</a>

                    </div>

                </div>                                    

            </form>

        </div>

        <div class="modal fade" id="modalLoad">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body" style="text-align: center;">
                        {*<img src="../../libs/imagenes/cargando.gif">*}
                        <span class=" fa fa-cog fa-spin fa-5x"></span>
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

        <div class="modal fade" id="modalInfoDatos">
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


        {$footer}
        <script src="../../libs/jquery/jquery.js"></script>  
        <script src="../../libs/bootstrap/js/bootstrap.js"></script>
        <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/bootstrap-datepicker.js"></script>
        <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/locales/bootstrap-datepicker.es.js"></script> 
        <script src="../../libs/filestyle/filestyle.js"></script>
        <script src="../../js/reporteNominaPlanoJs/reporteNominaPlano.js"></script> 
        <script src="../../libs/wow/js/wow.min.js"></script>
        <script>
                            new WOW().init();
        </script>

    </body>

</html>