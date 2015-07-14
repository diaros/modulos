<?php /* Smarty version Smarty-3.1.13, created on 2015-07-14 15:32:23
         compiled from "..\..\web\aprobarNominaWeb\aprobarNomina.html.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18587559abb8e47dd98-38056409%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2083bf1e5f0aeb307147600fcf1539c49a2bec48' => 
    array (
      0 => '..\\..\\web\\aprobarNominaWeb\\aprobarNomina.html.tpl',
      1 => 1436905859,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18587559abb8e47dd98-38056409',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_559abb8e6c9108_98402235',
  'variables' => 
  array (
    'cabecera' => 1,
    'empresaInterna' => 1,
    'ciudades' => 1,
    'mostrarTabla' => 1,
    'footer' => 1,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_559abb8e6c9108_98402235')) {function content_559abb8e6c9108_98402235($_smarty_tpl) {?><!DOCTYPE html>

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

        <?php echo $_smarty_tpl->tpl_vars['cabecera']->value;?>


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
                                        <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['name'] = 'ciudadaux';
$_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['ciudades']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['ciudadaux']['total']);
?>
                                            <option value="<?php echo $_smarty_tpl->tpl_vars['ciudades']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ciudadaux']['index']]['suc_codigo'];?>
"><?php echo $_smarty_tpl->tpl_vars['ciudades']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ciudadaux']['index']]['suc_nombre'];?>
</option>
                                        <?php endfor; endif; ?>    
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
                                            <div><a class="linkDetalle" id="linkDetDominicales" onclick="detDominicales();">Horas Dominicales</a></div>
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
                                            <div><a class="linkDetalle" id="linkDetFestivos" onclick="detFestivos();">Horas Festivos</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                               

                    </div>          

                </div>

                <div id="contenedorTabla" style="display:<?php echo $_smarty_tpl->tpl_vars['mostrarTabla']->value;?>
" class="table-responsive">             

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


        <?php echo $_smarty_tpl->tpl_vars['footer']->value;?>


        <script src="../../libs/jquery/jquery.js"></script>  
        <script src="../../libs/bootstrap/js/bootstrap.js"></script>
        <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/bootstrap-datepicker.js"></script>
        <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/locales/bootstrap-datepicker.es.js"></script> 
        <script src="../../js/aprobarNominaJs/aprobarNomina.js"></script> 

    </body>    

</html><?php }} ?>