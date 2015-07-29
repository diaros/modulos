<?php /* Smarty version Smarty-3.1.13, created on 2015-07-28 16:44:53
         compiled from "..\..\web\consultaRequisicionesWeb\consultaRequisicionesWeb.html.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2457454a1ae041fcfa9-03210084%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4fbe0a2ed09a1b011c3e02588470312d1a6d338c' => 
    array (
      0 => '..\\..\\web\\consultaRequisicionesWeb\\consultaRequisicionesWeb.html.tpl',
      1 => 1437145029,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2457454a1ae041fcfa9-03210084',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54a1ae044a0776_60575352',
  'variables' => 
  array (
    'cabecera' => 1,
    'mostrarMsj' => 1,
    'msjError' => 1,
    'estados' => 1,
    'mostrarTabla' => 1,
    'reporte' => 1,
    'number' => 1,
    'footer' => 1,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54a1ae044a0776_60575352')) {function content_54a1ae044a0776_60575352($_smarty_tpl) {?><!DOCTYPE html>
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

        <?php echo $_smarty_tpl->tpl_vars['cabecera']->value;?>


        <div id="contenedor" class="container">

            <legend>Consulta requisiciones</legend>
            
             <div class="alert alert-danger alert-dismissable" style="display:<?php echo $_smarty_tpl->tpl_vars['mostrarMsj']->value;?>
">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Advertencia!</strong> <p><?php echo $_smarty_tpl->tpl_vars['msjError']->value;?>
</p>
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
                                    <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['estado'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['estado']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['name'] = 'estado';
$_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['estados']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['estado']['total']);
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['estados']->value[$_smarty_tpl->getVariable('smarty')->value['section']['estado']['index']]['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['estados']->value[$_smarty_tpl->getVariable('smarty')->value['section']['estado']['index']]['descripcion'];?>
</option>
                                    <?php endfor; endif; ?>  
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
                
                <div id="contenedorTabla" style="display:<?php echo $_smarty_tpl->tpl_vars['mostrarTabla']->value;?>
"> 

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

                        <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['reporte'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['name'] = 'reporte';
$_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['reporte']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['reporte']['total']);
?>

                        <div style="display: none;"><?php echo $_smarty_tpl->tpl_vars['number']->value++;?>
</div>

                        <tr id="fila<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
">

                            <td><?php echo $_smarty_tpl->tpl_vars['reporte']->value[$_smarty_tpl->getVariable('smarty')->value['section']['reporte']['index']]['empresa'];?>
<input id="idEmpOculto<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['reporte']->value[$_smarty_tpl->getVariable('smarty')->value['section']['reporte']['index']]['idEmp'];?>
"></td>

                            <td><?php echo $_smarty_tpl->tpl_vars['reporte']->value[$_smarty_tpl->getVariable('smarty')->value['section']['reporte']['index']]['requisicion'];?>
<input id="idReqOculto<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['reporte']->value[$_smarty_tpl->getVariable('smarty')->value['section']['reporte']['index']]['requisicion'];?>
"></td>

                            <td><?php echo $_smarty_tpl->tpl_vars['reporte']->value[$_smarty_tpl->getVariable('smarty')->value['section']['reporte']['index']]['usuario'];?>
<input id="idUserOculto<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['reporte']->value[$_smarty_tpl->getVariable('smarty')->value['section']['reporte']['index']]['usuario'];?>
"></td>

                            <td><?php echo $_smarty_tpl->tpl_vars['reporte']->value[$_smarty_tpl->getVariable('smarty')->value['section']['reporte']['index']]['fecha'];?>
</td>

                            <td><?php echo $_smarty_tpl->tpl_vars['reporte']->value[$_smarty_tpl->getVariable('smarty')->value['section']['reporte']['index']]['estado'];?>
</td>        

                            <td><a id="btnCon<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" class="btn btn-link" onclick="consulReq(<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
);">Consultar</a></td>

                            <td><a id="btnPdf<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" class="btn btn-link" onclick="generarPdf(<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
);">PDF</a></td>                                           

                        </tr>

                    <?php endfor; endif; ?>                

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
                <div class="modal-content noFondoModal">
                    <div class="modal-body" style="text-align: center;">
                        
                        <span class=" fa fa-cog fa-spin fa-6x iconblue"></span>
                    </div>
                </div>
            </div>
        </div>

        <?php echo $_smarty_tpl->tpl_vars['footer']->value;?>


    </body>

    <script src="../../libs/jquery/jquery.js"></script>
    <script src="../../libs/bootstrap/js/bootstrap.js"></script>
    <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/bootstrap-datepicker.js"></script>
    <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/locales/bootstrap-datepicker.es.js"></script>     
    <script src="../../js/consultaRequisicionesJs/consultaRequisicionesJs.js"></script>

</html><?php }} ?>