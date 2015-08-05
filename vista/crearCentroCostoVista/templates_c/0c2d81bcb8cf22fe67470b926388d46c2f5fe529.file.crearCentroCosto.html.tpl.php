<?php /* Smarty version Smarty-3.1.13, created on 2015-08-04 17:21:07
         compiled from "..\..\web\crearCentroCostoWeb\crearCentroCosto.html.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3230253ebeda98e5f76-52940900%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0c2d81bcb8cf22fe67470b926388d46c2f5fe529' => 
    array (
      0 => '..\\..\\web\\crearCentroCostoWeb\\crearCentroCosto.html.tpl',
      1 => 1437145045,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3230253ebeda98e5f76-52940900',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53ebeda9b2f7d6_87610527',
  'variables' => 
  array (
    'cabecera' => 1,
    'mostrarMsj' => 1,
    'msjError' => 1,
    'mostrarMsjExito' => 1,
    'msjExito' => 1,
    'empresaInterna' => 1,
    'tipoFacs' => 1,
    'mostrarConsulta' => 0,
    'centroCostos' => 1,
    'number' => 1,
    'footer' => 1,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ebeda9b2f7d6_87610527')) {function content_53ebeda9b2f7d6_87610527($_smarty_tpl) {?><!DOCTYPE html>

<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" />
        <link type="text/css" href="../../css/crearCentroCosto/crearCentroCostoCss.css" rel="stylesheet"> 
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet"> 

        <title>Crear centro costo</title>   

    </head>

    <body>

        <?php echo $_smarty_tpl->tpl_vars['cabecera']->value;?>


        <div id="contenedor" class="container">

            <legend>Crear tipo cobro</legend>

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

            <form id="crearClienteForm" name="crearClienteForm" class="form-horizontal" action="../../vista/crearCentroCostoVista/crearCentroCostoVista.php" method="post" autocomplete="off">

                <div class="well" id="forma">

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="empresaInt">Empresa interna:</label>
                            <div class="col-md-8">
                                <select id="empresaInt" name="empresaInt" class="form-control" onchange="consultarEmpCliente();">
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
                            <label class="col-md-4 control-label" for="empUsu">Empresa cliente</label>
                            <div class="col-md-8">
                                <select id="empUsu" name="empUsu" class="form-control">                                   

                                </select>
                            </div>
                        </div>                     

                    </div>  

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="aiu">AIU:</label>  

                            <div class="col-md-4">
                                <div class="input-group">
                                    <input id="aiu" name="aiu" placeholder="aiu" class="form-control input-md" type="text" onblur="valNumerico()">
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                        </div>  

                    </div>

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="tipoFac">Tipo facturación:</label>
                            <div class="col-md-8">
                                <select id="tipoFac" name="tipoFac" class="form-control" onchange="valTipoFac();">

                                    <option value=""></option>

                                    <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['name'] = 'tipoFac';
$_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['tipoFacs']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['tipoFac']['total']);
?>

                                        <option value="<?php echo $_smarty_tpl->tpl_vars['tipoFacs']->value[$_smarty_tpl->getVariable('smarty')->value['section']['tipoFac']['index']]['id_tipo_facturacion'];?>
"><?php echo $_smarty_tpl->tpl_vars['tipoFacs']->value[$_smarty_tpl->getVariable('smarty')->value['section']['tipoFac']['index']]['nombre'];?>
</option>

                                    <?php endfor; endif; ?>

                                </select>

                            </div>

                        </div>

                    </div>

                    <div id="campArbCli" class="col-lg-5" style="display: none">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="arbCliente">Arbol cliente:</label>
                            <div class="col-md-8">
                                <select id="arbCliente" name="arbCliente" class="form-control">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div id="campIdClient" class="col-lg-5" style="display: none">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="idClieKactus">Identificador cliente:</label>  
                            <div class="col-md-8">
                                <input id="idClieKactus" name="idClieKactus" placeholder="Id cliente kactus" class="form-control input-md" type="text">                          
                            </div>
                        </div>  
                    </div>

                    <div id="campIdClient" class="col-lg-5">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="idClieKactus">Acepta cobro de no aptos?</label>  
                            <div class="col-md-8">

                                <label class="radio" for="tipoDato-0">
                                    <input type="radio" name="res" id="res1" value="1" checked>
                                    Si
                                </label>

                                <label class="radio" for="tipoDato-0">
                                    <input type="radio" name="res" id="res2" value="0">
                                    No
                                </label>

                            </div>
                        </div>  
                    </div>                

                    <div class="col-lg-12" id="botones">

                        <input type="button" id="guardar" value="Guardar" class="btn btn-primary" onclick="valVaciosCC();">
                        <input type="button" id="limpiar" value="Limpiar" class="btn btn-danger" onclick="reiniciar();">

                    </div>                

                </div>

                <hr>

                <div id="tablaCentroCosto" class="col-lg-12" style="display:<?php echo $_smarty_tpl->tpl_vars['mostrarConsulta']->value;?>
;">

                    <table class="table table-hover table-striped table-condensed">

                        <thead>

                        <th>Empresa interna</th>
                        <th>Empresa cliente</th>
                        <th>AIU %</th>
                        <th>Tipo facturacion</th>
                            
                        <th>Id cliente Kactus</th>
                        <th>Acepta cobro aptos</th>
                        <th>Eliminar</th>

                        </thead>

                        <tbody id="datosCentroCosto">

                            <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['name'] = 'centroCosto';
$_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['centroCostos']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['centroCosto']['total']);
?>

                                <tr>

                            <div style="display:none;"><?php echo $_smarty_tpl->tpl_vars['number']->value++;?>
</div>

                            <td><?php echo $_smarty_tpl->tpl_vars['centroCostos']->value[$_smarty_tpl->getVariable('smarty')->value['section']['centroCosto']['index']]['id_empresa_interna'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['centroCostos']->value[$_smarty_tpl->getVariable('smarty')->value['section']['centroCosto']['index']]['id_empresa_cliente'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['centroCostos']->value[$_smarty_tpl->getVariable('smarty')->value['section']['centroCosto']['index']]['aiu'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['centroCostos']->value[$_smarty_tpl->getVariable('smarty')->value['section']['centroCosto']['index']]['tipo_facturacion'];?>
</td>
                            
                            <td><?php echo $_smarty_tpl->tpl_vars['centroCostos']->value[$_smarty_tpl->getVariable('smarty')->value['section']['centroCosto']['index']]['id_cliente_kactus'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['centroCostos']->value[$_smarty_tpl->getVariable('smarty')->value['section']['centroCosto']['index']]['cobro_aptos'];?>
</td>
                            <td>
                                <input id="eliminar<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" name="eliminar<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" value="Eliminar" type="button" class="btn btn-link" onclick="confirmacionEliminarCentroCosto(<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
)">
                            </td>

                            <input type="hidden" id="idCentroCosto<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" name="idCentroCosto<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['centroCostos']->value[$_smarty_tpl->getVariable('smarty')->value['section']['centroCosto']['index']]['id_tipo_cobro'];?>
">

                            </tr>

                        <?php endfor; endif; ?>    

                        </tbody>

                    </table>    

                </div>

            </form>

        </div>

        <div class="modal fade" id="modalConfirm">

            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="tituloModal2"></h4>
                    </div>

                    <div class="modal-body" id="cuerpoModal2">

                        <p>Esta seguro que desea eliminar este registro?</p>


                        <div class="col-lg-12" id="botones2">

                            <input type="button" id="guardar" value="Confirmar" class="btn btn-primary" onclick="eliminarCentroCosto();">
                            <input type="hidden" id="ocultoId">

                        </div>
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
    <script src="../../js/crearCentroCostoJs/crearCentroCosto.js"></script>

</html><?php }} ?>