<!DOCTYPE html>
<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet" />
        <link type="text/css" href="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/css/datepicker3.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.css" rel="stylesheet" />
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet"/>
        <link type="text/css" href="../../css/gestionContratosCss/gestionContratosCss.css" rel="stylesheet"/>
       
        <title>Gestion contratos</title>

    </head>

    <body>        

        {$cabecera} 
        <div id="contenedor" class="container">

            <legend>Gestion de contratos</legend> 

            <form id="gestionContratos" name="gestionContratos" class="form-horizontal" action="../../vista/gestionContratosVista/gestionContratosVista.php" method="post" autocomplete="off">

                <div class="well" id="formulario1" name="formulario1">

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-5 control-label" for="empresaInt">Empresa interna:</label>
                            <div class="col-md-7">
                                <select id="empresaInt" name="empresaInt" class="form-control" onchange="valEmpresaInterna();">
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
                                <input id="requisicion" name="requisicion" placeholder="" class="form-control input-md" type="text" onblur="consultarUsuariosxReq();">
                            </div>
                        </div>

                    </div> 

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-5 control-label" for="idUser">No Identificación:</label>  
                            <div class="col-md-7">
                            {*<input id="idUser" name="idUser" placeholder="" class="form-control input-md" type="text" onblur="consultarObserv();">*}
                              <select id="idUser" name="idUser" class="form-control" onblur="consultarObserv();" >                                    
                              </select>
                            </div>                            
                        </div>

                    </div>                                

                    <div class="col-md-12">                        

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="observ">Observaciones:</label>  
                            <div class="col-md-8">
                                <textarea class="form-control" id="observ" name="observ" readonly="true"></textarea>
                            </div>                            
                        </div>               

                    </div>

                    <div class="col-md-12">                        

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="adicionales">Adicionales:</label>  
                            <div class="col-md-8">
                                <textarea class="form-control" id="adicionales" name="adicionales"></textarea>
                            </div>                            
                        </div>               

                    </div>

                    <div class="col-md-12">

                        <div class="col-md-3">
                            <a class="btn btn-primary btn-lg btn-block btn-huge" onclick="confirmarContrato();"><span class="glyphicon glyphicon-file"></span><br/>Contrato</a>
                        </div>
                        <div class="col-md-3">
                            <a href="#" class="btn btn-primary btn-lg btn-block btn-huge" onclick="generarPaqueteContrato();"><span class="glyphicon glyphicon-file"></span><br/>Paquete Contratación</a>
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-primary btn-lg btn-block btn-huge" onclick="generarDecreto3377();"><span class="glyphicon glyphicon-file"></span><br/>Decreto 1377</a>
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-primary btn-lg btn-block btn-huge" onclick="generarCartaInformativa();"><span class="glyphicon glyphicon-file"></span><br/>Carta informativa</a>
                        </div>                        
                        <div class="col-md-3">
                            <a class="btn btn-primary btn-lg btn-block btn-huge" onclick="generarCertificadoInduccion();"><span class="glyphicon glyphicon-file"></span><br/>Certificado de inducción</a>
                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-primary btn-lg btn-block btn-huge" onclick="generarClausulaAdicional();"><span class="glyphicon glyphicon-file"></span><br/>Clausula Adicional</a>
                        </div>    
                        <div class="col-md-3">
                            <a class="btn btn-primary btn-lg btn-block btn-huge" onclick="confirmarCarta();"><span class="glyphicon glyphicon-file" ></span><br/>Carta presentación</a>
                        </div>
                       {* <div class="col-md-3">
                            <a href="#" class="btn btn-primary btn-lg btn-block btn-huge" onclick="listaChequeo();"><span class="fa fa-list"></span><br/>Lista de chequeo</a>
                        </div>  *}                    
                        <div class="col-md-3">
                            <a class="btn btn-danger btn-lg btn-block btn-huge" onclick="limpiarCampos();"><span class="fa fa-warning"></span><br/>Limpiar</a>
                        </div>                        

                    </div>            

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
                <div class="modal-content noFondoModal">
                    <div class="modal-body" style="text-align: center;">
                        {*<img src="../../libs/imagenes/cargando.gif">*}
                        <span class=" fa fa-cog fa-spin fa-6x iconblue"></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalCartaPresentacion">

            <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header">

                        <h4 class="modal-title" id="tituloModal">Datos Carta Informativa</h4>

                        <div id="divMsjCarta" class="alert alert-info alert-dismissable" style="display: none;">
                            {* <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>*}
                            <strong>Informacion</strong> 
                            <p id="textModalCarta"></p>
                        </div>

                    </div>

                    <div class="modal-body" id="cuerpoModal">

                        <div class="form-group">
                            
                            <label class="col-md-7 control-label" for="atentamente">Atentamente:</label>  
                            <div class="col-md-12">
                                <input id="atentamente" name="atentamente" placeholder="Atentamente" class="form-control input-md" type="text">
                            </div>                            
                            
                        </div>

                        <div class="form-group">

                            <label class="col-md-7 control-label" for="cita">Hora cita:</label>  
                            <div class="col-md-12">
                                <input id="cita" name="cita" placeholder="Cita" class="form-control input-md" type="text">
                            </div>       

                        </div>

                        <div class="form-group">

                            <label class="col-md-7 control-label" for="direccion">Dirección:</label>  
                            <div class="col-md-12">
                                <input id="direccion" name="direccion" placeholder="Dirección" class="form-control input-md" type="text">
                            </div>

                        </div>

                        <div class="col-md-12" style="margin-top: 5px; text-align: right;">

                            <input type="button" value="Aceptar" class="btn btn-primary" onclick="generarCartaPresentacion();">
                            <input type="button" value="Limpiar" class="btn btn-danger" onclick="limpiarCamposCartaPresentacion();">

                        </div>         

                    </div>

                    <div class="modal-footer">
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->   

        <div class="modal fade" id="modalParametrosContrato">

            <div class="modal-dialog" id="dialogContrato">

                <div class="modal-content" >

                    <div class="modal-header">

                        <h4 class="modal-title" id="tituloModal2">Datos Contrato</h4>

                        <div id="divMsjContrato" class="alert alert-info alert-dismissable" style="display: none;">
                            {* <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>*}
                            <strong>Informacion</strong> 
                            <p id="textModalContrato"></p>
                        </div>

                    </div>

                    <div class="modal-body" id="cuerpoModalContrato">

                        <div class="col-md-12">

                            <div class="">
                                <label class="col-md-2 control-label" for="radios">Logo</label>
                                <div class="col-md-4">
                                    <div class="radio">
                                        <label for="sin">
                                            <input name="radios" id="sin" value="sin" checked="checked" type="radio">
                                            Sin logo
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label for="con">
                                            <input name="radios" id="con" value="con" type="radio">
                                            Con logo
                                        </label>
                                    </div>                                   

                                </div>
                            </div>

                        {*    <div class="">

                                <label class="col-md-2 control-label" for="radios">Periocidad Salario</label>
                                <div class="col-md-4">
                                    <div class="radio">
                                        <label for="hora">
                                            <input name="salario" id="hora" value="hora" checked="checked" type="radio">
                                            Hora
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label for="diario">
                                            <input name="salario" id="diario" value="diario" type="radio">
                                            Diario
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label for="mensual">
                                            <input name="salario" id="mensual" value="mensual" type="radio">
                                            Mensual
                                        </label>
                                    </div>                                   
                                </div>

                            </div>*}

                        </div>

                        <div class="col-md-12">

                            <div class="">

                                <label class="col-md-2 control-label" for="obra">Tipo contrato</label>

                                <div class="col-md-4">

                                    <div class="radio">

                                        <label for="obra">
                                            <input name="tipo" id="obraTipo1" value="obraTipo1" checked="checked" type="radio" onclick="fechaFinContrato();">
                                            Obra labor con empresa usuaria
                                        </label>

                                    </div>
                                    
                                    <div class="radio">

                                        <label for="obra">
                                            <input name="tipo" id="obraTipo2" value="obraTipo2" checked="checked" type="radio" onclick="fechaFinContrato();">
                                            Obra labor sin empresa usuaria
                                        </label>

                                    </div>

                                    <div class="radio">

                                        <label for="inferior">
                                            <input name="tipo" id="inferior" value="inferior" type="radio" onclick="fechaFinContrato();">
                                            Inferior a un año
                                        </label>

                                    </div>

                                </div>

                            </div>

                            <div class="">

                                <label class="col-md-4 control-label" for="fechaFinContra">Fecha terminación contrato:</label>  
                                <div class="col-md-4">
                                    {*<input id="fechaIniOculto" name="fechaIniOculto" value="{$fechaIni}" type="hidden">*}
                                    <input id="fechaFinContra" name="fechaFinContra"  placeholder="" class="form-control input-sm datepicker" type="text"  disabled="true">
                                </div>

                            </div>

                        </div>

                        <div class="col-md-12" style="margin-top: 5px; text-align: right;">

{*                            <input type="button" value="Paquete de contratación" class="btn btn-success" onclick="generarPaqueteContrato();">*}
                            <input type="button" value="Contrato" class="btn btn-primary" onclick="generarContrato();">
                            <input type="button" value="Limpiar" class="btn btn-danger" onclick="">

                        </div>   

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
    <script src="../../libs/bootstrap/js/typeahead.js"></script>
    <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/bootstrap-datepicker.js"></script>
    <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/locales/bootstrap-datepicker.es.js"></script> 
    <script src="../../libs/moment-develop/min/moment.min.js"></script>  
    <script src="../../libs/calendario/bootstrap-datetimepicker-master/src/js/bootstrap-datetimepicker.js"></script>  
    <script src="../../libs/Chart.js-master/Chart.min.js"></script>
    <script src="../../js/gestionContratosJs/gestionContratosJs.js"></script>

</html>