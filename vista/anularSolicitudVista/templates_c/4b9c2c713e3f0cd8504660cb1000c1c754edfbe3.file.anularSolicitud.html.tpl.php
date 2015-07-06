<?php /* Smarty version Smarty-3.1.13, created on 2014-10-20 09:11:57
         compiled from "..\..\web\anularSolicitudWeb\anularSolicitud.html.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2262553e949ada66f55-49582283%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4b9c2c713e3f0cd8504660cb1000c1c754edfbe3' => 
    array (
      0 => '..\\..\\web\\anularSolicitudWeb\\anularSolicitud.html.tpl',
      1 => 1413814091,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2262553e949ada66f55-49582283',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53e949afe7b4b9_26947834',
  'variables' => 
  array (
    'cabecera' => 1,
    'mostrarMsj' => 1,
    'msjError' => 1,
    'mostrarMsjExito' => 1,
    'msjExito' => 1,
    'mostrarBtn' => 1,
    'mostrarConsulta' => 1,
    'reporte' => 1,
    'number' => 1,
    'paginaAct' => 1,
    'idSolicitud' => 1,
    'usuElab' => 1,
    'paginaPrev' => 1,
    'paginador' => 1,
    'paginaPos' => 1,
    'footer' => 1,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53e949afe7b4b9_26947834')) {function content_53e949afe7b4b9_26947834($_smarty_tpl) {?><!DOCTYPE html>

<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

        <script src="../../libs/jquery/jquery.js"></script>  
        <script src="../../libs/bootstrap/js/bootstrap.js"></script> 
        <script src="../../libs/DataTables-1.10.3/media/js/jquery.dataTables.min.js"></script>
        <script src="../../js/anularSolicitudJs/anularSolicitud.js"></script>

        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/DataTables-1.10.3/media/css/jquery.dataTables.min.css">
        
        <link type="text/css" href="../../css/anularSolicitudCss/anularSolicitudCss.css" rel="stylesheet"/> 
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet"/> 

        <title>Anular solicitud</title>        

    </head>

    <body>

        <?php echo $_smarty_tpl->tpl_vars['cabecera']->value;?>


        <div id="contenedor" class="container">

            <legend>Anular solicitud</legend>

            <div class="alert alert-danger alert-dismissable" style="display:<?php echo $_smarty_tpl->tpl_vars['mostrarMsj']->value;?>
">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Advertencia!</strong> <p><?php echo $_smarty_tpl->tpl_vars['msjError']->value;?>
</p>
            </div>

            <div class="alert alert-info alert-dismissable" style="display:<?php echo $_smarty_tpl->tpl_vars['mostrarMsjExito']->value;?>
">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Informacion!</strong> <p><?php echo $_smarty_tpl->tpl_vars['msjExito']->value;?>
</p>
            </div>

            <form id="anularSolicitudForm" name="anularSolicitudForm" class="form-horizontal" action="../../vista/anularSolicitudVista/anularSolicitudVista.php" method="post" autocomplete="off">

                <div class="well" id="forma">

                    <input type="hidden" name="accion" value="">

                    <div class="col-lg-5">

                        <div class="form-group">

                            <label class="col-md-4 control-label" for="consOrden">Consecutivo:</label>  

                            <div class="col-md-8">
                                <input id="consOrden" name="consOrden" placeholder="" class="form-control input-md" type="text">                          
                            </div>

                        </div>  

                    </div>

                    <div class="col-lg-12" id="botones">

                        <input type="button" id="anular" name="anular" value="Anular solicitud" class="btn btn-success" onclick="preguntar();" style="display:<?php echo $_smarty_tpl->tpl_vars['mostrarBtn']->value;?>
">
                        <input type="button" id="consultar" value="Consultar" class="btn btn-primary" onclick="valVaciosOrden();">
                        <input type="button" id="limpiar" value="Limpiar" class="btn btn-danger" onclick="reiniciar();">

                    </div> 

                </div>

                <hr>

                <div id="tablaConsultaOrden" class="col-lg-12" style="display:<?php echo $_smarty_tpl->tpl_vars['mostrarConsulta']->value;?>
;">

                    <table id="tablaDatos" class="table table-hover table-striped table-condensed">

                        <thead>

                            <tr>

                                <th>Consecutivo</th>
                                <th>Empresa interna</th>
                                <th>Empresa cliente</th>
                                <th>Centro costo</th>
                                <th>Laboratorio</th>
                                <th>Usuario elaboro</th>
                                <th>Fecha elaboro</th>
                                <th>Estado</th>
                                <th>Anular</th>

                            </tr>

                        </thead>                        

                        <tbody id="datosOrden">

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
                                <tr>

                            <div style="display: none;"><?php echo $_smarty_tpl->tpl_vars['number']->value++;?>
</div>

                            <td><?php echo $_smarty_tpl->tpl_vars['reporte']->value[$_smarty_tpl->getVariable('smarty')->value['section']['reporte']['index']]['id_solicitud_examen'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['reporte']->value[$_smarty_tpl->getVariable('smarty')->value['section']['reporte']['index']]['nom_empr'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['reporte']->value[$_smarty_tpl->getVariable('smarty')->value['section']['reporte']['index']]['nom_cliente'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['reporte']->value[$_smarty_tpl->getVariable('smarty')->value['section']['reporte']['index']]['centro_costo'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['reporte']->value[$_smarty_tpl->getVariable('smarty')->value['section']['reporte']['index']]['nombre_lab'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['reporte']->value[$_smarty_tpl->getVariable('smarty')->value['section']['reporte']['index']]['usu_nombre'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['reporte']->value[$_smarty_tpl->getVariable('smarty')->value['section']['reporte']['index']]['fecha_proceso'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['reporte']->value[$_smarty_tpl->getVariable('smarty')->value['section']['reporte']['index']]['nombre'];?>

                                <input type="hidden" id="estadoOculto<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" name="estadoOculto<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['reporte']->value[$_smarty_tpl->getVariable('smarty')->value['section']['reporte']['index']]['nombre'];?>
"/>
                                <input type="hidden" id="idReg<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" name="idReg<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['reporte']->value[$_smarty_tpl->getVariable('smarty')->value['section']['reporte']['index']]['id_solicitud_examen'];?>
">
                            </td>

                            <td>
                                <input id="estado<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" name="estado<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" type="checkbox">
                            </td>

                            </tr>
                        <?php endfor; endif; ?>   

                        </tbody>

                    </table>

                    <div id="paginador">

                        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['paginaAct']->value;?>
" id="indicePagina"/>
                        
                        <ul class="pagination pagination-sm">
                            <li><a href="../../vista/anularSolicitudVista/anularSolicitudVista.php?solicitud=<?php echo $_smarty_tpl->tpl_vars['idSolicitud']->value;?>
&usuElab=<?php echo $_smarty_tpl->tpl_vars['usuElab']->value;?>
&accion=Consultar&pagina=<?php echo $_smarty_tpl->tpl_vars['paginaPrev']->value;?>
"><<</a></li>

                            <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['pagina'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['name'] = 'pagina';
$_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['paginador']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['pagina']['total']);
?>                    
                                <li id="pag<?php echo $_smarty_tpl->tpl_vars['paginador']->value[$_smarty_tpl->getVariable('smarty')->value['section']['pagina']['index']]['pagina'];?>
" class="">
                                    <a href="../../vista/anularSolicitudVista/anularSolicitudVista.php?solicitud=<?php echo $_smarty_tpl->tpl_vars['idSolicitud']->value;?>
&usuElab=<?php echo $_smarty_tpl->tpl_vars['usuElab']->value;?>
&accion=Consultar&pagina=<?php echo $_smarty_tpl->tpl_vars['paginador']->value[$_smarty_tpl->getVariable('smarty')->value['section']['pagina']['index']]['pagina'];?>
"><?php echo $_smarty_tpl->tpl_vars['paginador']->value[$_smarty_tpl->getVariable('smarty')->value['section']['pagina']['index']]['pagina'];?>
</a>
                                </li>                    
                            <?php endfor; endif; ?>

                            <li><a href="../../vista/anularSolicitudVista/anularSolicitudVista.php?solicitud=<?php echo $_smarty_tpl->tpl_vars['idSolicitud']->value;?>
&usuElab=<?php echo $_smarty_tpl->tpl_vars['usuElab']->value;?>
&accion=Consultar&pagina=<?php echo $_smarty_tpl->tpl_vars['paginaPos']->value;?>
">>></a></li>

                        </ul>               

                    </div>

                </div>

            </form>

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

        <div class="modal fade" id="modalLoad">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-body" style="text-align: center;">
                        <img src="../../libs/imagenes/cargando.gif">
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="modalConfirm">

            <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="tituloModal"></h4>
                    </div>

                    <div class="modal-body" id="cuerpoModal">

                        <p>Esta seguro que desea anular esta solicitud?</p>

                        <div class="col-lg-12" id="botones2">

                            <input type="button" id="guardar" value="Confirmar" class="btn btn-primary" onclick="eliminarOrden();">

                        </div>

                    </div>

                    <div class="modal-footer">

                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal --> 

        <?php echo $_smarty_tpl->tpl_vars['footer']->value;?>


    </body>

</html><?php }} ?>