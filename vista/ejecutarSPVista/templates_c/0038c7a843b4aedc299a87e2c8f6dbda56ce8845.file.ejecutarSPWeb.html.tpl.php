<?php /* Smarty version Smarty-3.1.13, created on 2014-10-27 09:36:30
         compiled from "..\..\web\ejecutarSPWeb\ejecutarSPWeb.html.tpl" */ ?>
<?php /*%%SmartyHeaderCode:33454491d5201b914-94422962%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0038c7a843b4aedc299a87e2c8f6dbda56ce8845' => 
    array (
      0 => '..\\..\\web\\ejecutarSPWeb\\ejecutarSPWeb.html.tpl',
      1 => 1414420585,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '33454491d5201b914-94422962',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54491d52514670_90901031',
  'variables' => 
  array (
    'cabecera' => 1,
    'mostrarMsj' => 1,
    'msjError' => 1,
    'mostrarMsjExito' => 1,
    'msjExito' => 1,
    'idUserLog' => 1,
    'footer' => 1,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54491d52514670_90901031')) {function content_54491d52514670_90901031($_smarty_tpl) {?><!DOCTYPE html>

<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link type="text/css" href="../../css/ejecutarSPCss/ejecutarSPCss.css" rel="stylesheet"/> 
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet"/> 

        <title>Ejecutar facturacion de examenes</title>

    </head>

    <body>

        <?php echo $_smarty_tpl->tpl_vars['cabecera']->value;?>


        <div id="contenedor" class="container">

            <legend>Ejecutar facturacion de examenes</legend>

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

            <input type="hidden" id="idUserLog" name="idUserLog" value="<?php echo $_smarty_tpl->tpl_vars['idUserLog']->value;?>
">

            <form id="ejecutarSpForm" name="ejecutarSpForm" class="form-horizontal" action="../../vista/ejecutarSPVista/ejecutarSPVista.php" method="post" autocomplete="off">

                <div class="well" id="forma">

                    <div class="col-lg-12" style="text-align: center">
                        <div class="form-group">
                            <input type="button" id="ejecutarSpBtn" name="ejecutarSpBtn" value="Ejecutar Procedimiento almacenado" class="btn btn-primary btn-group-sm" onclick="confirmarEjecucion();">
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

        <div class="modal fade" id="modalConfirm">

            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="tituloModal"></h4>
                    </div>

                    <div class="modal-body" id="cuerpoModal">

                        <p>Esta seguro que desea ejecutar el procedimiento de facturación?</p>


                        <div class="col-lg-12" id="botones2">

                            <input type="button" id="guardar" value="Confirmar" class="btn btn-primary" onclick="ejecutarSP();">
                            <input type="hidden" id="ocultoId">

                        </div>
                    </div>

                    <div class="modal-footer">

                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->     


        <script src="../../libs/jquery/jquery.js"></script>  
        <script src="../../libs/bootstrap/js/bootstrap.js"></script> 
        <script src="../../js/ejecutarSPJs/ejecutarSPJs.js"></script>      


        <?php echo $_smarty_tpl->tpl_vars['footer']->value;?>

    </body>    

</html><?php }} ?>