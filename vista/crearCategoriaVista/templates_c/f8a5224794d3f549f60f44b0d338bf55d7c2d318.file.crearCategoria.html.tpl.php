<?php /* Smarty version Smarty-3.1.13, created on 2015-02-27 11:53:32
         compiled from "..\..\web\crearCategoriaWeb\crearCategoria.html.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1897653d8fab86e1df3-93706846%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f8a5224794d3f549f60f44b0d338bf55d7c2d318' => 
    array (
      0 => '..\\..\\web\\crearCategoriaWeb\\crearCategoria.html.tpl',
      1 => 1425055503,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1897653d8fab86e1df3-93706846',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53d8fab87a63f3_45904928',
  'variables' => 
  array (
    'cabecera' => 1,
    'mostrarMsj' => 1,
    'msjError' => 1,
    'mostrarMsjExito' => 1,
    'msjExito' => 1,
    'mostrarConsulta' => 1,
    'categorias' => 1,
    'number' => 1,
    'footer' => 1,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53d8fab87a63f3_45904928')) {function content_53d8fab87a63f3_45904928($_smarty_tpl) {?><!DOCTYPE html>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">       

        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" />
        <link type="text/css" href="../../css/crearCategoriaCss/crearCategoria.css" rel="stylesheet">
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet">

        <title>Crear categoria</title>
    </head>

    <body>
        <?php echo $_smarty_tpl->tpl_vars['cabecera']->value;?>


        <div id="contenedor" class="container">
            <legend>Crear categoria</legend>

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

            <form id="crearCategoriaForm" name="crearCategoriaForm" class="form-horizontal" action="../../vista/crearCategoriaVista/crearCategoriaVista.php" method="post" autocomplete="off"> 

                <div class="well" id="forma">

                    <div class="col-lg-5">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="nombre">Nombre:</label>  
                            <div class="col-md-8">
                                <input id="nombre" name="nombre" placeholder="Nombre" class="form-control input-md" type="text">                          
                            </div>
                        </div>  
                    </div>

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="estado">Estado:</label>

                            <div class="col-md-8">
                                <select id="estado" name="estado" class="form-control">
                                    <option value=""></option>
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                        </div>                     

                    </div>

                    <div class="col-lg-12" id="botones">

                        <input type="button" id="guardar" value="Guardar" class="btn btn-primary" onclick="validarVacios();">
                        <input type="reset" id="limpiar" value="Limpiar" class="btn btn-danger">

                    </div>


                </div>

                <hr>

                <div id="tablaCategorias" class="col-lg-12" style="display:<?php echo $_smarty_tpl->tpl_vars['mostrarConsulta']->value;?>
;">

                    <table class="table table-hover table-striped table-condensed">

                        <thead>

                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Eliminar</th>

                        </thead>

                        <tbody id="datosCat">

                            <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['categoria'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['name'] = 'categoria';
$_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['categorias']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['categoria']['total']);
?>

                                <tr>
                            <div style="display:none;"><?php echo $_smarty_tpl->tpl_vars['number']->value++;?>
</div>
                            <td><?php echo $_smarty_tpl->tpl_vars['categorias']->value[$_smarty_tpl->getVariable('smarty')->value['section']['categoria']['index']]['nombre'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['categorias']->value[$_smarty_tpl->getVariable('smarty')->value['section']['categoria']['index']]['estado'];?>
</td>

                            <td>
                                <input id="eliminar<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" name="eliminar<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" value="Eliminar" type="button" class="btn btn-link" onclick="confirmacionEliminar(<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
)">
                            </td>

                            <input type="hidden" id="idCat<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" name="idCat<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['categorias']->value[$_smarty_tpl->getVariable('smarty')->value['section']['categoria']['index']]['id_categoria_examen'];?>
">
                            </tr>

                        <?php endfor; endif; ?>    

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

        <div class="modal fade" id="modalConfirm">

            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="tituloModal"></h4>
                    </div>

                    <div class="modal-body" id="cuerpoModal">

                        <p>Esta seguro que desea eliminar esta categoria?</p>


                        <div class="col-lg-12" id="botones2">

                            <input type="button" id="guardar" value="Confirmar" class="btn btn-primary" onclick="eliminarCat();">
                            <input type="hidden" id="ocultoId">

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
    <script src="../../js/crearCategoriaJs/crearCategoriaJs.js"></script>


</html><?php }} ?>