<!DOCTYPE html>

<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/css/datepicker3.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" />
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet"/> 
        <link type="text/css" href="../../css/reporteNominaCss/reporteNominaCss.css" rel="stylesheet"/>      

    </head>

    <body>

        {$cabecera}

        <div id="contenedor" class="container">

            <legend>Reporte nomina</legend>                   

            <form id="formReporteNomina" name='formReporteNomina' class="form-horizontal" action='../../vista/reporteNominaVista/reporteNominaVista.php' method="post" autocomplete="off">

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
                                <label class="col-md-4 control-label" for="empresaInt">Ciudad:</label>
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
                                <label class="col-md-4 control-label" for="quincena ">Quincena:</label>
                                <div class="col-md-8">
                                    <select id="quincena" name="quincena" class="form-control" onchange="">
                                        <option value=""></option>  
                                        <option value="1">Primer quincena</option>                                    
                                        <option value="2">Segunda quincena</option>                                  
                                    </select>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-lg-12" id="botones">

                        <input type="button" id="cosultar" value="Consultar" class="btn btn-primary" onclick="valVacios();">
                        <input type="reset" id="limpiar" value="Limpiar" class="btn btn-danger" onclick="limpiarForm();">

                    </div>  

                </div>              

                <div id="divDiasHabiles" style="display: none;">

                    <legend>Dias habiles<p class="text-primary">Sin terminar | HA-00001</p></legend>

                    <table id="tablaHabiles" class="table table-hover table-striped table-condensed">

                        <thead id="cabeceraDatosUser">
                            <tr id="filaEncabezados">                                
                            </tr>
                        </thead>

                        <tbody id="datosUsuario">
                        </tbody>

                    </table>

                    <div class="col-lg-12" id="botones">

                        <input type="button" id="finalizarHabiles" value="Finalizar" class="btn btn-warning" onclick=""> 
                        <input type="button" id="guardarHabiles" value="Guardar" class="btn btn-success" onclick="guardardiashabiles();" >

                    </div>  

                </div>              

                <div id="divAdicionales" style="display: none;">

                    <legend>Adicionales<p class="text-primary">Sin terminar | AD-00001</p></legend>                   

                    <table id="tablaAdicionales" class="table table-hover table-striped table-condensed">

                        <thead id="cabeceraAdicionales">
                            <tr id="filaEncabezadosAdicionales">                                
                            </tr>
                        </thead>

                        <tbody id="datosUsuarioAdiconales">
                        </tbody>


                    </table>

                    <div class="col-lg-12" id="botones">

                        <input type="button" id="finalizarAdicionales" value="Finalizar" class="btn btn-warning" onclick=""> 
                        <input type="button" id="guardarAdicionales" value="Guardar" class="btn btn-success" onclick="guardaradicionales();">

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

        <hr>

        {$footer}
        <script src="../../libs/jquery/jquery.js"></script>  
        <script src="../../libs/bootstrap/js/bootstrap.js"></script>
        <script src="../../libs/bootstrap/js/typeahead.js"></script>
        <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/bootstrap-datepicker.js"></script>
        <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/locales/bootstrap-datepicker.es.js"></script> 
        {*<script src="../../libs/moment-develop/min/moment.min.js"></script>*}
        {*<script src="../../libs/calendario/bootstrap-datetimepicker-master/src/js/bootstrap-datetimepicker.js"></script>*}
        <script src="../../js/reporteNominaJs/reporteNomina.js"></script> 

    </body>    

</html>