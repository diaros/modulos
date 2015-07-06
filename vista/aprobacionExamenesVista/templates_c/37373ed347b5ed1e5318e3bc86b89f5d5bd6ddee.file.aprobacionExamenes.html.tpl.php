<?php /* Smarty version Smarty-3.1.13, created on 2015-03-30 15:47:51
         compiled from "..\..\web\aprobacionExamenesWeb\aprobacionExamenes.html.tpl" */ ?>
<?php /*%%SmartyHeaderCode:318155390fcfb005ab5-94845998%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '37373ed347b5ed1e5318e3bc86b89f5d5bd6ddee' => 
    array (
      0 => '..\\..\\web\\aprobacionExamenesWeb\\aprobacionExamenes.html.tpl',
      1 => 1427384719,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '318155390fcfb005ab5-94845998',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5390fcfb1e5c11_36904672',
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
    'fechaIni' => 1,
    'fechaFin' => 1,
    'cedula' => 1,
    'idSolicitud' => 1,
    'estado' => 1,
    'usuElab' => 1,
    'paginaPrev' => 1,
    'paginador' => 1,
    'paginaPos' => 1,
    'footer' => 1,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5390fcfb1e5c11_36904672')) {function content_5390fcfb1e5c11_36904672($_smarty_tpl) {?><!DOCTYPE html>
<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">        

        <link type="text/css" href="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/css/datepicker3.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" />
        <link type="text/css" href="../../css/aprobacionExamenesCss/aprobacionExamenesMedicosCss.css" rel="stylesheet" />
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet" /> 

        <title>Aprobacion Examenes</title>

    </head>

    <body>

        <?php echo $_smarty_tpl->tpl_vars['cabecera']->value;?>


        <div id="contenedor" class="container">

            <legend>Aprobación Examenes</legend>

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

            <form id="aprobacionExamenesForm" name="aprobacionExamenesForm" class="form-horizontal" action="../../vista/aprobacionExamenesVista/aprobacionExamenesVista.php" method="post" autocomplete="off"> 

                <div id="forma" class="well">

                    <input type="hidden" name="accion" value=""/>

                    <div class="col-lg-5">

                        <div class="form-group ">
                            <label class="col-md-4 control-label" for="fechaIni">Fecha inicial:</label>  
                            <div class="col-md-8">
                                <input id="fechaIni" name="fechaIni" placeholder="Fecha inicial" class="form-control input-md datepicker" type="text">
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="fechaFin">Fecha final:</label>  
                            <div class="col-md-8 ">
                                <input id="fechaFin" name="fechaFin" placeholder="Fecha final" class="form-control input-md datepicker" type="text">
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-5 ">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="solicitud">No. Solicitud:</label>  
                            <div class="col-md-8">
                                <input id="solicitud" name="solicitud" placeholder="No. Solicitud" class="form-control input-md" type="text">                                
                            </div>
                        </div>
                        
                    </div>

                    <div class="col-lg-5 ">
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="cedula">Cedula:</label>  
                            <div class="col-md-8">
                                <input id="cedula" name="cedula" placeholder="Cedula" class="form-control input-md" type="text">                                
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-5 ">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="estado">Estado:</label>
                            <div class="col-md-8">
                                <select id="estado" name="estado" class="form-control">
                                    <option value=""></option>
                                    <option value="1">Ejecutado</option>
                                    <option value="0">No ejecutado</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12" id="botones">

                        <input type="button" id="aprobar" value="Ejecutar" class="btn btn-success" onclick="valSeleccionados();" style="display:<?php echo $_smarty_tpl->tpl_vars['mostrarBtn']->value;?>
">
                        <input type="button" id="consultar" value="Consultar" class="btn btn-primary" onclick="validarVacios();">
                        <input type="reset" id="limpiar" value="Limpiar" class="btn btn-danger" onclick="reiniciar();">

                    </div>

                </div>

                <hr>

                <div id="tablaAprobacionExamenes" class="col-lg-12" style="display:<?php echo $_smarty_tpl->tpl_vars['mostrarConsulta']->value;?>
;">

                    <table class="table table-hover table-striped table-condensed" id="datosExamenes">

                        <thead>

                            <tr>
                                <th>Id orden</th>
                                <th>Empleado</th>
                                <th>Cedula</th>
                                <th>Examen</th>
                                    
                                <th>Estado</th>
                                <th>Apto</th>                               
                                <th>Ejecutado</th>    
                            </tr>
                            
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>
                            <input id="marcarTodos" name="marcarTodos" type="checkbox" onclick="marcar();">
                        </th>

                        

                        </thead>

                        <tbody>

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
                            <td><?php echo $_smarty_tpl->tpl_vars['reporte']->value[$_smarty_tpl->getVariable('smarty')->value['section']['reporte']['index']]['nombre'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['reporte']->value[$_smarty_tpl->getVariable('smarty')->value['section']['reporte']['index']]['cedula'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['reporte']->value[$_smarty_tpl->getVariable('smarty')->value['section']['reporte']['index']]['nombre_examen'];?>
</td>
                            
                            <td><?php echo $_smarty_tpl->tpl_vars['reporte']->value[$_smarty_tpl->getVariable('smarty')->value['section']['reporte']['index']]['estado'];?>

                                <input type="hidden" id="estadoOculto<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" name="estadoOculto<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['reporte']->value[$_smarty_tpl->getVariable('smarty')->value['section']['reporte']['index']]['estado'];?>
"/>
                                <input type="hidden" id="idItem<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" name="idItem<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['reporte']->value[$_smarty_tpl->getVariable('smarty')->value['section']['reporte']['index']]['idReg'];?>
"/>
                            </td>

                            <td>
                                <select id="apto<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" name="apto<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" disabled="true">
                                    <option value="-1"></option>
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                </select>
                                <input type="hidden" id="aptoOculto<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" name="aptoOculto<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['reporte']->value[$_smarty_tpl->getVariable('smarty')->value['section']['reporte']['index']]['apto'];?>
">    
                            </td>

                            <td>
                                <input id="estado<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" name="estado<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" type="checkbox" onchange="valEstado(estadoOculto<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
,<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
,<?php echo $_smarty_tpl->tpl_vars['reporte']->value[$_smarty_tpl->getVariable('smarty')->value['section']['reporte']['index']]['idReg'];?>
);">
                            </td>

                            </tr>
                        <?php endfor; endif; ?>    
                        <tr>                           
                        </tr>

                        </tbody>

                    </table>

                    <div id="paginador">

                        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['paginaAct']->value;?>
" id="indicePagina"/>
                        <ul class="pagination pagination-sm">
                            <li><a href="../../vista/aprobacionExamenesVista/aprobacionExamenesVista.php?fechaIni=<?php echo $_smarty_tpl->tpl_vars['fechaIni']->value;?>
&fechaFin=<?php echo $_smarty_tpl->tpl_vars['fechaFin']->value;?>
&cedula=<?php echo $_smarty_tpl->tpl_vars['cedula']->value;?>
&solicitud=<?php echo $_smarty_tpl->tpl_vars['idSolicitud']->value;?>
&estado=<?php echo $_smarty_tpl->tpl_vars['estado']->value;?>
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
                                    <a href="../../vista/aprobacionExamenesVista/aprobacionExamenesVista.php?fechaIni=<?php echo $_smarty_tpl->tpl_vars['fechaIni']->value;?>
&fechaFin=<?php echo $_smarty_tpl->tpl_vars['fechaFin']->value;?>
&cedula=<?php echo $_smarty_tpl->tpl_vars['cedula']->value;?>
&solicitud=<?php echo $_smarty_tpl->tpl_vars['idSolicitud']->value;?>
&estado=<?php echo $_smarty_tpl->tpl_vars['estado']->value;?>
&usuElab=<?php echo $_smarty_tpl->tpl_vars['usuElab']->value;?>
&accion=Consultar&pagina=<?php echo $_smarty_tpl->tpl_vars['paginador']->value[$_smarty_tpl->getVariable('smarty')->value['section']['pagina']['index']]['pagina'];?>
"><?php echo $_smarty_tpl->tpl_vars['paginador']->value[$_smarty_tpl->getVariable('smarty')->value['section']['pagina']['index']]['pagina'];?>
</a>
                                </li>                    
                            <?php endfor; endif; ?>

                            <li><a href="../../vista/aprobacionExamenesVista/aprobacionExamenesVista.php?fechaIni=<?php echo $_smarty_tpl->tpl_vars['fechaIni']->value;?>
&fechaFin=<?php echo $_smarty_tpl->tpl_vars['fechaFin']->value;?>
&cedula=<?php echo $_smarty_tpl->tpl_vars['cedula']->value;?>
&solicitud=<?php echo $_smarty_tpl->tpl_vars['idSolicitud']->value;?>
&estado=<?php echo $_smarty_tpl->tpl_vars['estado']->value;?>
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
                        <h4 class="modal-title">Advertencia</h4>
                    </div>

                    <div class="modal-body" id="cuerpoModal">

                    </div>

                    <div class="modal-footer">

                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <?php echo $_smarty_tpl->tpl_vars['footer']->value;?>

    </body>
    
    <script src="../../libs/jquery/jquery.js"></script>          
    <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/bootstrap-datepicker.js"></script>
    <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/locales/bootstrap-datepicker.es.js"></script>        
    <script src="../../libs/bootstrap/js/bootstrap.js"></script>  
    <script src="../../js/aprobacionExamenesJs/aprobacionExamenes.js"></script>

</html><?php }} ?>