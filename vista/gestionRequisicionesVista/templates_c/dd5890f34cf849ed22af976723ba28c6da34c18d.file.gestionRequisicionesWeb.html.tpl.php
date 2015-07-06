<?php /* Smarty version Smarty-3.1.13, created on 2015-03-25 09:42:52
         compiled from "..\..\web\gestionRequisicionesWeb\gestionRequisicionesWeb.html.tpl" */ ?>
<?php /*%%SmartyHeaderCode:627754bec69ee46a27-04942711%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dd5890f34cf849ed22af976723ba28c6da34c18d' => 
    array (
      0 => '..\\..\\web\\gestionRequisicionesWeb\\gestionRequisicionesWeb.html.tpl',
      1 => 1427294567,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '627754bec69ee46a27-04942711',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54bec69f0dfe14_70477422',
  'variables' => 
  array (
    'cabecera' => 1,
    'mostrarMsj' => 1,
    'msjError' => 1,
    'mostrarMsjExito' => 1,
    'msjExito' => 1,
    'fechaIni' => 1,
    'fechaFin' => 1,
    'empresaInterna' => 1,
    'numReq' => 1,
    'idUser' => 1,
    'estados' => 1,
    'mostrarTabla' => 1,
    'reporte' => 1,
    'number' => 1,
    'procesos' => 1,
    'footer' => 1,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54bec69f0dfe14_70477422')) {function content_54bec69f0dfe14_70477422($_smarty_tpl) {?><!DOCTYPE html>
<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet" />
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.css" rel="stylesheet" />
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet"/>
        <link type="text/css" href="../../css/gestionRequisicionesCss/gestionRequisicionesCss.css" rel="stylesheet"/>      
        
        <title>Consulta requisiciones</title>

    </head>

    <body>

        <?php echo $_smarty_tpl->tpl_vars['cabecera']->value;?>


        <div id="contenedor" class="container">

            <legend>Gestion requisiciones</legend>

            <div class="alert alert-danger alert-dismissable" style="display:<?php echo $_smarty_tpl->tpl_vars['mostrarMsj']->value;?>
">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Advertencia!</strong> <p><?php echo $_smarty_tpl->tpl_vars['msjError']->value;?>
</p>
            </div>

            <div class="alert alert-info alert-dismissable" style="display:<?php echo $_smarty_tpl->tpl_vars['mostrarMsjExito']->value;?>
">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Información</strong> <p><?php echo $_smarty_tpl->tpl_vars['msjExito']->value;?>
</p>
            </div>

            <form id="gestionReqForm" name="gestionReqForm" class="form-horizontal" action="../../vista/gestionRequisicionesVista/gestionRequisicionesVista.php" method="post" autocomplete="off">

                <input type="hidden" id="accion" name="accion">
                <input type="hidden" id="auxIdReg" name="auxIdReg">

                <div class="well" id="formulario" name="formulario">

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-5 control-label" for="fechaIni">Fecha inicial</label>  
                            <div class="col-md-7">
                                <input id="fechaIni" name="fechaIni"  placeholder="" class="form-control input-sm datepicker" type="text" value="<?php echo $_smarty_tpl->tpl_vars['fechaIni']->value;?>
">
                            </div>
                        </div>                

                    </div>

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-5 control-label" for="fechaFin">Fecha final</label>  
                            <div class="col-md-7">
                                <input id="fechaFin" name="fechaFin"  placeholder="" class="form-control input-sm datepicker" type="text" value="<?php echo $_smarty_tpl->tpl_vars['fechaFin']->value;?>
">
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-5 control-label" for="empresaInt">Empresa interna:</label>
                            <div class="col-md-7">
                                <select id="empresaInt" name="empresaInt" class="form-control">
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
                            <label class="col-md-5 control-label" for="requisicion">Numero Requisición:</label>  
                            <div class="col-md-7">
                                <input id="requisicion" name="requisicion" placeholder="" class="form-control input-md" type="text" value="<?php echo $_smarty_tpl->tpl_vars['numReq']->value;?>
">
                            </div>
                        </div>

                    </div>            

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-5 control-label" for="idUser">No Identificación:</label>  
                            <div class="col-md-7">
                                <input id="idUser" name="idUser" placeholder="" class="form-control input-md" type="text" onblur="consultarObserv();" value="<?php echo $_smarty_tpl->tpl_vars['idUser']->value;?>
">
                            </div>                            
                        </div>

                    </div>

                    <div class="col-lg-5">
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

                    <div class="col-lg-12" style="text-align: right;">

                        <a id="btnAceptar" class="btn btn-success" style="display: none;" onclick="confirmAceptar();">Archivar</a>
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
                                    Proceso                                
                                </th>
                                
                                <th>
                                    Usuario/Prestamo
                                </th>

                                <th>
                                    Archivar                                
                                </th>

                                <th>
                                    Prestar                                    
                                </th>                     

                            </tr>   


                        </thead>

                        <tbody  id="registros">

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

                            <input id="idReg<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" name="idReg<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['reporte']->value[$_smarty_tpl->getVariable('smarty')->value['section']['reporte']['index']]['idReg'];?>
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
<input id="estadoOculto<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['reporte']->value[$_smarty_tpl->getVariable('smarty')->value['section']['reporte']['index']]['estado'];?>
"></td>

                            <td><?php echo $_smarty_tpl->tpl_vars['reporte']->value[$_smarty_tpl->getVariable('smarty')->value['section']['reporte']['index']]['proceso'];?>
</td>
                            
                            <td><?php echo $_smarty_tpl->tpl_vars['reporte']->value[$_smarty_tpl->getVariable('smarty')->value['section']['reporte']['index']]['observacion'];?>
</td>

                            <td><input name="aceptar<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" id="aceptar<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" type="checkbox" onchange="valCheck();"></td>                               

                            <td><a id="btnCon<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" class="btn btn-link" onclick="confirmPrestar(<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
);">Prestar</a></td>                                

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
                <div class="modal-content">

                    <div class="modal-body" style="text-align: center;">
                        <img src="../../libs/imagenes/cargando.gif">
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="modalConfirmAceptar">

            <div class="modal-dialog">

                <div class="modal-content" style="overflow: hidden;">

                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="tituloModal2">Archivar</h4>

                    </div>

                    <div class="modal-body" id="cuerpoModal2">

                        <p>Confirma la recepcion de las requisiciones seleccionadas?</p>


                        <div class="col-lg-12" id="botones2" style="margin-top:20px;">

                            <input type="button" id="guardar" value="Confirmar" class="btn btn-primary" onclick="aceptar();">                         

                        </div>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal --> 

        <div class="modal fade" id="modalConfirmPrestar">

            <div class="modal-dialog">

                <div class="modal-content" style="overflow: hidden;">

                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="tituloModal2">Prestamo</h4>

                    </div>

                    <div class="modal-body" id="cuerpoModal2">

                        <p>Por favor seleccione el proceso a realizar el prestamo.</p>

                        <div class="form-group">
                            <label class="col-md-5 control-label" for="proceso">Proceso:</label>
                            <div class="col-md-7">
                                <select id="proceso" name="proceso" class="form-control">
                                    <option value=""></option>
                                    <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['proceso'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['name'] = 'proceso';
$_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['procesos']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['proceso']['total']);
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['procesos']->value[$_smarty_tpl->getVariable('smarty')->value['section']['proceso']['index']]['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['procesos']->value[$_smarty_tpl->getVariable('smarty')->value['section']['proceso']['index']]['nombre'];?>
</option>
                                    <?php endfor; endif; ?>    
                                </select>
                            </div>
                        </div>                        
                                
                        <div class="form-group">
                            
                            <label class="col-md-5 control-label" for="textinput">Observación:</label>  
                            <div class="col-md-7">
                            
                                <input id="observacion" name="observacion" type="text" placeholder="Observación" class="form-control input-md">

                            </div>
                        </div>                   


                        <div class="col-lg-12" id="botones2" style="margin-top:20px;">

                            <input type="button" id="guardar" value="Confirmar" class="btn btn-primary" onclick="prestamo();">                         

                        </div>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal --> 


        <?php echo $_smarty_tpl->tpl_vars['footer']->value;?>


    </body>

    <script src="../../libs/jquery/jquery.js"></script>
    <script src="../../libs/bootstrap/js/bootstrap.js"></script>
    <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/bootstrap-datepicker.js"></script>
    <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/locales/bootstrap-datepicker.es.js"></script>     
    <script src="../../js/gestionRequisicionesJs/gestionRequisicionesJs.js"></script>

</html><?php }} ?>