<?php /* Smarty version Smarty-3.1.13, created on 2015-08-04 17:28:08
         compiled from "..\..\web\relacionPsicologoClienteWeb\relacionPsicologoCliente.html.tpl" */ ?>
<?php /*%%SmartyHeaderCode:138353e4f076d79276-13207031%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '95f31774f61c5a279eb491708b736317dca155ad' => 
    array (
      0 => '..\\..\\web\\relacionPsicologoClienteWeb\\relacionPsicologoCliente.html.tpl',
      1 => 1437145152,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '138353e4f076d79276-13207031',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53e4f076e9ea99_94750959',
  'variables' => 
  array (
    'cabecera' => 1,
    'mostrarMsj' => 1,
    'msjError' => 1,
    'mostrarMsjExito' => 1,
    'msjExito' => 1,
    'usuariosPsico' => 1,
    'empInternas' => 1,
    'mostrarConsulta' => 1,
    'footer' => 1,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53e4f076e9ea99_94750959')) {function content_53e4f076e9ea99_94750959($_smarty_tpl) {?><!DOCTYPE html>

<html>

    <head>
        
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">        

        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.css" rel="stylesheet" />
        <link type="text/css" href="../../css/relacionPsicoloClienteCss/relacionPsicologoClienteCss.css" rel="stylesheet"> 
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet"> 

        <title>Relacion Psicologo cliente</title>

    </head>

    <body>

        <?php echo $_smarty_tpl->tpl_vars['cabecera']->value;?>


        <div id="contenedor" class="container">

            <legend>Relacion psicologo cliente</legend>

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

            <form id="crearPsicologoCliente" name="crearPsicologoCliente" class="form-horizontal" action="../../vista/relacionPsicologoClienteVista/relacionPsicologoClienteVista.php" method="post" autocomplete="off">

                <input type="hidden" name="accion" value="" />
                <input type="hidden" name="totalReg" id="totalReg" value="" />


                <div class="well" id="forma">

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="usuario">Psicologo/a</label>
                            <div class="col-md-8">
                                <select id="usuario" name="usuario" class="form-control" onchange="valSeleccion();">

                                    <option value=""></option>
                                    <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['name'] = 'usuarioPsico';
$_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['usuariosPsico']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['usuarioPsico']['total']);
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['usuariosPsico']->value[$_smarty_tpl->getVariable('smarty')->value['section']['usuarioPsico']['index']]['usu_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['usuariosPsico']->value[$_smarty_tpl->getVariable('smarty')->value['section']['usuarioPsico']['index']]['usu_nombre'];?>
</option>
                                    <?php endfor; endif; ?>

                                </select>

                            </div>

                        </div>                     

                    </div>

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="empInt">Empresa interna</label>
                            <div class="col-md-8">

                                <select id="empInt" name="empInt" class="form-control" onchange="valSeleccion();">

                                    <option value=""></option>
                                    <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['empInt'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['name'] = 'empInt';
$_smarty_tpl->tpl_vars['smarty']->value['section']['empInt']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['empInternas']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['empInternas']->value[$_smarty_tpl->getVariable('smarty')->value['section']['empInt']['index']]['cod_Empr'];?>
"><?php echo $_smarty_tpl->tpl_vars['empInternas']->value[$_smarty_tpl->getVariable('smarty')->value['section']['empInt']['index']]['nom_empr'];?>
</option>
                                    <?php endfor; endif; ?>

                                </select>

                            </div>

                        </div>                     

                    </div>

                    <div class="col-lg-12" id="botones">

                        <input type="button" id="guardar" value="Guardar" class="btn btn-primary" onclick="valClientesSeleccionados();" disabled="true">
                        <input type="button" id="limpiar" value="Limpiar" class="btn btn-danger" onclick="reiniciar();">

                    </div>                               

                </div>

                <hr>

                <div id="tablaRelPsicologoCliente" class="col-lg-12" style="display:<?php echo $_smarty_tpl->tpl_vars['mostrarConsulta']->value;?>
;">

                    <table class="table table-hover table-striped table-condensed">

                        <thead>

                            <tr>
                                <th>Cliente</th>
                                <th>Nit</th>
                                <th>Estado</th>
                            </tr>

                        </thead>                        

                        <tbody id="datosRelPsicoClient">
                        </tbody>

                    </table>

                </div>

            </form>

        </div>

          <div class="modal fade" id="modalLoad">
            <div class="modal-dialog">
                <div class="modal-content noFondoModal">
                    <div class="modal-body" style="text-align: center;">
                        
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

        <?php echo $_smarty_tpl->tpl_vars['footer']->value;?>

        
    </body>
    
    <script src="../../libs/jquery/jquery.js"></script>  
    <script src="../../libs/bootstrap/js/bootstrap.js"></script> 
    <script src="../../js/relacionPsicologoClienteJs/relacionPsicologoCliente.js"></script>


</html><?php }} ?>