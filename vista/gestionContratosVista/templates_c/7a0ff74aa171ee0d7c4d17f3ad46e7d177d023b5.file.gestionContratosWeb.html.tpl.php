<?php /* Smarty version Smarty-3.1.13, created on 2015-07-15 11:45:46
         compiled from "..\..\web\gestionContratosWeb\gestionContratosWeb.html.tpl" */ ?>
<?php /*%%SmartyHeaderCode:137915446de60ebf4a2-59156914%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7a0ff74aa171ee0d7c4d17f3ad46e7d177d023b5' => 
    array (
      0 => '..\\..\\web\\gestionContratosWeb\\gestionContratosWeb.html.tpl',
      1 => 1436219454,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '137915446de60ebf4a2-59156914',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5446de60f3a333_03658363',
  'variables' => 
  array (
    'cabecera' => 1,
    'empresaInterna' => 1,
    'footer' => 1,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5446de60f3a333_03658363')) {function content_5446de60f3a333_03658363($_smarty_tpl) {?><!DOCTYPE html>
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

        <?php echo $_smarty_tpl->tpl_vars['cabecera']->value;?>
 
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
                                    <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['empInt'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['name'] = 'empInt';
$_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['empresaInterna']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['total']);
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['empresaInterna']->value[$_smarty_tpl->getVariable('smarty')->value['section']['empInt']['index']]['cod_Empr'];?>
"><?php echo $_smarty_tpl->tpl_vars['empresaInterna']->value[$_smarty_tpl->getVariable('smarty')->value['section']['empInt']['index']]['nom_empr'];?>
</option>
                                    <?php endfor; endif; ?>    
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
                <div class="modal-content">

                    <div class="modal-body" style="text-align: center;">
                        <img src="../../libs/imagenes/cargando.gif">
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
                                    
                                    <input id="fechaFinContra" name="fechaFinContra"  placeholder="" class="form-control input-sm datepicker" type="text"  disabled="true">
                                </div>

                            </div>

                        </div>

                        <div class="col-md-12" style="margin-top: 5px; text-align: right;">


                            <input type="button" value="Contrato" class="btn btn-primary" onclick="generarContrato();">
                            <input type="button" value="Limpiar" class="btn btn-danger" onclick="">

                        </div>   

                    </div>

                    <div class="modal-footer">
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->   

        <?php echo $_smarty_tpl->tpl_vars['footer']->value;?>


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

</html><?php }} ?>