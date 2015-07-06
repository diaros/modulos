<?php /* Smarty version Smarty-3.1.13, created on 2015-05-25 09:32:46
         compiled from "..\..\web\reporteNominaWeb\reporteNomina.html.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8204554d3b67a9c4e4-43713477%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f523e27cbdf56afb4a0eba2510a71fa207391802' => 
    array (
      0 => '..\\..\\web\\reporteNominaWeb\\reporteNomina.html.tpl',
      1 => 1432560977,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8204554d3b67a9c4e4-43713477',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_554d3b68455335_44022176',
  'variables' => 
  array (
    'cabecera' => 1,
    'empresaInterna' => 1,
    'ciudades' => 1,
    'footer' => 1,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_554d3b68455335_44022176')) {function content_554d3b68455335_44022176($_smarty_tpl) {?><!DOCTYPE html>

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

        <?php echo $_smarty_tpl->tpl_vars['cabecera']->value;?>


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
                                        <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['name'] = 'ciudad';
$_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['ciudades']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudad']['total']);
?>
                                            <option value="<?php echo $_smarty_tpl->tpl_vars['ciudades']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ciudad']['index']]['suc_codigo'];?>
"><?php echo $_smarty_tpl->tpl_vars['ciudades']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ciudad']['index']]['suc_nombre'];?>
</option>
                                        <?php endfor; endif; ?>    
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

        <hr>

        <?php echo $_smarty_tpl->tpl_vars['footer']->value;?>

        <script src="../../libs/jquery/jquery.js"></script>  
        <script src="../../libs/bootstrap/js/bootstrap.js"></script>
        <script src="../../libs/bootstrap/js/typeahead.js"></script>
        <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/bootstrap-datepicker.js"></script>
        <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/locales/bootstrap-datepicker.es.js"></script> 
        
        
        <script src="../../js/reporteNominaJs/reporteNomina.js"></script> 

    </body>    

</html><?php }} ?>