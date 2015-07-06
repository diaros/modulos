<?php /* Smarty version Smarty-3.1.13, created on 2015-02-27 11:55:26
         compiled from "..\..\web\relacionLabExamenWeb\relacionLabExamen.html.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3082753e8f921067057-72853358%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '816b38391aafdafc0467d4e71ec9bc75aa17ebaf' => 
    array (
      0 => '..\\..\\web\\relacionLabExamenWeb\\relacionLabExamen.html.tpl',
      1 => 1425055874,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3082753e8f921067057-72853358',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53e8f9211d4d80_17690015',
  'variables' => 
  array (
    'cabecera' => 1,
    'mostrarMsj' => 1,
    'msjError' => 1,
    'mostrarMsjExito' => 1,
    'msjExito' => 1,
    'laboratorios' => 1,
    'mostrarConsulta' => 1,
    'footer' => 1,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53e8f9211d4d80_17690015')) {function content_53e8f9211d4d80_17690015($_smarty_tpl) {?><!DOCTYPE html>

<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.css" rel="stylesheet" />
        <link type="text/css" href="../../css/relacionLabExamenCss/relacionLabExamenCss.css" rel="stylesheet"> 
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet"> 

        <title>Relacion laboratorio examen</title>

    </head>

    <body>

        <?php echo $_smarty_tpl->tpl_vars['cabecera']->value;?>


        <div id="contenedor" class="container">

            <legend>Relacion laboratorio examen</legend>

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

            <form id="relacionLabExamenForm" name="relacionLabExamenForm" class="form-horizontal" action="../../vista/relacionLabExamenVista/relacionLabExamenVista.php" method="post" autocomplete="off">

                <input type="hidden" name="accion" value="" />
                <input type="hidden" name="totalReg" id="totalReg" value="" />

                <div class="well" id="forma">
                    <div class="col-lg-5">
                        <div class="form-group">

                            <label class="col-md-4 control-label" for="laboratorio">Laboratorio</label>

                            <div class="col-md-8">

                                <select id="laboratorio" name="laboratorio" class="form-control" onchange="valSeleccionLab();">

                                    <option value=""></option>
                                    <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['name'] = 'laboratorio';
$_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['laboratorios']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['laboratorio']['total']);
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['laboratorios']->value[$_smarty_tpl->getVariable('smarty')->value['section']['laboratorio']['index']]['id_laboratorio'];?>
"><?php echo $_smarty_tpl->tpl_vars['laboratorios']->value[$_smarty_tpl->getVariable('smarty')->value['section']['laboratorio']['index']]['nombre'];?>
</option>
                                    <?php endfor; endif; ?>

                                </select>

                            </div>

                        </div> 
                    </div>

                    <div class="col-lg-12" id="botones">

                        <input type="button" id="guardar" value="Guardar" class="btn btn-primary" onclick="valExamsSeleccionados();" disabled="true">
                        <input type="button" id="limpiar" value="Limpiar" class="btn btn-danger" onclick="reiniciar();">

                    </div>  

                </div>

                <hr>

                <div id="tablaRelLabExam" class="col-lg-12" style="display:<?php echo $_smarty_tpl->tpl_vars['mostrarConsulta']->value;?>
;">

                    <table class="table table-hover table-striped table-condensed">

                        <thead>

                            <tr>
                                <th>Examen</th>
                                <th>Categoria</th>
                                <th>Valor</th>
                                <th>Estado</th>
                            </tr>

                        </thead>                        

                        <tbody id="datosRelLabExam">
                        </tbody>

                    </table>

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


        <?php echo $_smarty_tpl->tpl_vars['footer']->value;?>


    </body>

    <script src="../../libs/jquery/jquery.js"></script>
    <script src="../../libs/bootstrap/js/bootstrap.js"></script> 
    <script src="../../js/relacionLabExamenJs/relacionLabExamen.js"></script>


</html><?php }} ?>