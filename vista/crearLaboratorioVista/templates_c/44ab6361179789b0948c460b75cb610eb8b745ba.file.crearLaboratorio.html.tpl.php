<?php /* Smarty version Smarty-3.1.13, created on 2015-02-27 11:53:29
         compiled from "..\..\web\crearLaboratoriosWeb\crearLaboratorio.html.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2899453d7c5530f5509-49133863%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '44ab6361179789b0948c460b75cb610eb8b745ba' => 
    array (
      0 => '..\\..\\web\\crearLaboratoriosWeb\\crearLaboratorio.html.tpl',
      1 => 1425055557,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2899453d7c5530f5509-49133863',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53d7c55336a565_04059670',
  'variables' => 
  array (
    'cabecera' => 1,
    'mostrarMsj' => 1,
    'msjError' => 1,
    'mostrarMsjExito' => 1,
    'msjExito' => 1,
    'ciudades' => 1,
    'mostrarConsulta' => 0,
    'laboratorios' => 1,
    'number' => 1,
    'footer' => 1,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53d7c55336a565_04059670')) {function content_53d7c55336a565_04059670($_smarty_tpl) {?><!DOCTYPE html>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" />
        <link type="text/css" href="../../libs/DataTables-1.10.3/media/css/jquery.dataTables.min.css">
        <link type="text/css" href="../../css/crearLaboratorioCss/crearLaboratorio.css" rel="stylesheet">
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet">

        <title>Crear laboratorio</title>
    </head>

    <body>
        <?php echo $_smarty_tpl->tpl_vars['cabecera']->value;?>


        <div id="contenedor" class="container">

            <legend>Crear laboratorio</legend>

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

            <form id="crearLaboratorioForm" name="crearLaboratorioForm" class="form-horizontal" action="../../vista/crearLaboratorioVista/crearLaboratorioVista.php" method="post" autocomplete="off">

                <div class="well" id="forma">

                    <input type="hidden" id="idLab" name="idLab" value="" />

                    <div class="col-lg-5">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="nit">Nit:</label>  
                            <div class="col-md-8">
                                <input id="nit" name="nit" placeholder="Nit" class="form-control input-md" type="text" onblur="valNit();">                          
                            </div>
                        </div>  
                    </div>    

                    <div class="col-lg-5">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="nombre">Nombre:</label>  
                            <div class="col-md-8">
                                <input id="nombre" name="nombre" placeholder="nombre" class="form-control input-md" type="text">                          
                            </div>
                        </div>
                    </div>    

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="ciudad">Ciudad:</label>
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

                    <div class="col-lg-5">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="direccion">Direccion:</label>  
                            <div class="col-md-8">
                                <input id="direccion" name="direccion" placeholder="Direccion" class="form-control input-md" type="text">                          
                            </div>
                        </div>
                    </div>    

                    <div class="col-lg-5">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="telefono">Telefono:</label>  
                            <div class="col-md-8">
                                <input id="telefono" name="telefono" placeholder="Telefono" class="form-control input-md" type="text">                          
                            </div>
                        </div>
                    </div> 

                    <div class="col-lg-5">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="contacto">Contacto:</label>  
                            <div class="col-md-8">
                                <input id="contacto" name="contacto" placeholder="contacto" class="form-control input-md" type="text">                          
                            </div>
                        </div>
                    </div>  

                    <div class="col-lg-5">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="mail">Mail Contacto:</label>  
                            <div class="col-md-8">
                                <input id="mail" name="mail" placeholder="Mail Contacto" class="form-control input-md" type="text">                          
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
                        <input type="reset" id="limpiar" value="Limpiar" class="btn btn-danger" onclick="reiniciar();">

                    </div>

                </div>

                <hr>                                    

                <div id="tablaLaboratorios" class="col-lg-12" style="display:<?php echo $_smarty_tpl->tpl_vars['mostrarConsulta']->value;?>
;">

                    <table id="registrosLab" class="table table-hover table-striped table-condensed">

                        <thead>
                            <tr>
                                <th>Nit</th>
                                <th>Nombre</th>
                                <th>Ciudad</th>
                                <th>Direccion</th>
                                <th>Telefono</th>
                                <th>Contacto</th>
                                <th>Mail contacto</th>
                                <th>Estado</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>

                        <tbody id="datosLab">

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

                                <tr>
                            <div style="display:none"><?php echo $_smarty_tpl->tpl_vars['number']->value++;?>
</div>

                            <td><?php echo $_smarty_tpl->tpl_vars['laboratorios']->value[$_smarty_tpl->getVariable('smarty')->value['section']['laboratorio']['index']]['nit'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['laboratorios']->value[$_smarty_tpl->getVariable('smarty')->value['section']['laboratorio']['index']]['nombre'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['laboratorios']->value[$_smarty_tpl->getVariable('smarty')->value['section']['laboratorio']['index']]['suc_nombre'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['laboratorios']->value[$_smarty_tpl->getVariable('smarty')->value['section']['laboratorio']['index']]['direccion'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['laboratorios']->value[$_smarty_tpl->getVariable('smarty')->value['section']['laboratorio']['index']]['telefono'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['laboratorios']->value[$_smarty_tpl->getVariable('smarty')->value['section']['laboratorio']['index']]['contacto'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['laboratorios']->value[$_smarty_tpl->getVariable('smarty')->value['section']['laboratorio']['index']]['mail'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['laboratorios']->value[$_smarty_tpl->getVariable('smarty')->value['section']['laboratorio']['index']]['estado'];?>
</td> 

                            <td>
                                <input type="button" class="btn btn-link" value="Eliminar" onclick="confirmacionEliminar(<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
);"></input>
                            </td>                            
                            <input type="hidden" id="idLab<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" name="idLab<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['laboratorios']->value[$_smarty_tpl->getVariable('smarty')->value['section']['laboratorio']['index']]['id_laboratorio'];?>
">

                            </tr>                               

                        <?php endfor; endif; ?>                                

                        </tbody>

                    </table>

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

                        <p>Esta seguro que desea eliminar este registro?</p>


                        <div class="col-lg-12" id="botones2">

                            <input type="button" id="guardar" value="Confirmar" class="btn btn-primary" onclick="eliminarLab();">
                            <input type="hidden" id="ocultoId">

                        </div>
                    </div>

                    <div class="modal-footer">

                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal --> 


        <?php echo $_smarty_tpl->tpl_vars['footer']->value;?>

        
        
        <script src="../../libs/jquery/jquery.js"></script>  
        <script src="../../libs/bootstrap/js/bootstrap.js"></script> 
        <script src="../../libs/DataTables-1.10.3/media/js/jquery.dataTables.min.js"></script>
        <script src="../../js/crearLaboratorioJs/crearLaboratorio.js"></script>
        
    </body>        

</html><?php }} ?>