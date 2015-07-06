<?php /* Smarty version Smarty-3.1.13, created on 2015-03-17 15:10:20
         compiled from "..\..\web\listaChequeoWeb\listaChequeoWeb.html.tpl" */ ?>
<?php /*%%SmartyHeaderCode:31079548234d4552314-83034775%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '545ef0142f2258592d408124ae64b4cbd55a7c7d' => 
    array (
      0 => '..\\..\\web\\listaChequeoWeb\\listaChequeoWeb.html.tpl',
      1 => 1426611519,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31079548234d4552314-83034775',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_548234d4d42524_08231901',
  'variables' => 
  array (
    'cabecera' => 1,
    'idEmpInt' => 1,
    'req' => 1,
    'idUser' => 1,
    'rutaArchivo' => 0,
    'mostrarMsj' => 1,
    'tipoMsj' => 1,
    'msj' => 1,
    'empresaInterna' => 1,
    'mostrarGuardar' => 1,
    'mostrarTabla' => 1,
    'reporte' => 1,
    'number' => 1,
    'psicologos' => 1,
    'footer' => 1,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_548234d4d42524_08231901')) {function content_548234d4d42524_08231901($_smarty_tpl) {?><!DOCTYPE html>

<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet" />
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.css" rel="stylesheet" />
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet"/>
        <link type="text/css" href="../../css/listaChequeoCss/listaChequeoCss.css" rel="stylesheet"/>
        <title>Lista chequeo</title>        

    </head>

    <body>

        <?php echo $_smarty_tpl->tpl_vars['cabecera']->value;?>
  
        <div id="contenedor" class="container">         

            <legend>Lista chequeo</legend>            

            <form id="listaChequeoForm" name="listaChequeoForm" class="form-horizontal" action="../../vista/listaChequeoVista/listaChequeoVista.php" method="post" enctype="multipart/form-data">

                <input type="hidden" id="accion" name="accion">
                <input type="hidden" id="idPsico" name="idPsico">

                <input type="hidden" id="empresaIntOculto" name="empresaIntOculto" value="<?php echo $_smarty_tpl->tpl_vars['idEmpInt']->value;?>
">
                <input type="hidden" id="reqOculto" name="reqOculto" value="<?php echo $_smarty_tpl->tpl_vars['req']->value;?>
">
                <input type="hidden" id="idUserOculto" name="idUserOculto" value="<?php echo $_smarty_tpl->tpl_vars['idUser']->value;?>
">
                <input type="hidden" id="rutaArchivoOculto" name="rutaArchivoOculto" value="<?php echo $_smarty_tpl->tpl_vars['rutaArchivo']->value;?>
">
                <input type="hidden" id="existeSoporteDerogadoOculto" name="existeSoporteDerogadoOculto" value="">                

                <div class="alert alert-danger alert-dismissible" role="alert" style="display:<?php echo $_smarty_tpl->tpl_vars['mostrarMsj']->value;?>
;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong><?php echo $_smarty_tpl->tpl_vars['tipoMsj']->value;?>
</strong><?php echo $_smarty_tpl->tpl_vars['msj']->value;?>

                </div>

                <div class="well" id="formulario1" name="formulario1">                  

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-5 control-label" for="empresaInt">Empresa interna:</label>
                            <div class="col-md-7">
                                <select id="empresaInt" name="empresaInt" class="form-control" onchange="limpiarCampos();">
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
                                <input id="requisicion" name="requisicion" placeholder="" class="form-control input-md" type="text" onblur="consultarUsuariosxReq();">
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-5 control-label" for="idUser">No Identificación:</label>  
                            <div class="col-md-7">
                                
                                <select id="idUser" name="idUser" class="form-control" onchange="limpiarCampos();" >
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['idUser']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['idUser']->value;?>
</option>
                                </select>
                            </div>                            
                        </div>

                    </div>

                    <div class="col-lg-12" style="text-align: right;">

                        <a id="btnGenerarPdf" class="btn btn-primary" style="display: <?php echo $_smarty_tpl->tpl_vars['mostrarGuardar']->value;?>
" onclick="generarpdf();"><span class="glyphicon glyphicon-file"></span>  Generar PDF</a>
                        <a id="btnFinalizar" class="btn btn-primary" style="display: <?php echo $_smarty_tpl->tpl_vars['mostrarGuardar']->value;?>
" onclick="consultarPsicoAsignado();">Finalizar</a>
                        <a id="btnGuardar" class="btn btn-primary" style="display: <?php echo $_smarty_tpl->tpl_vars['mostrarGuardar']->value;?>
" onclick="guardar();">Guardar</a>
                        <a id="btnConsultar" class="btn btn-primary" onclick="consultar();">Consultar</a>
                        <a id="btnLimpiar" class="btn btn-danger" onclick="limpiar();">Limpiar</a>

                    </div>             

                </div>

                <hr>        

                <div id="contenedorTabla" style="display:<?php echo $_smarty_tpl->tpl_vars['mostrarTabla']->value;?>
"> 

                    <table class="table table-condensed table-hover table-responsive table-striped" id="datosDocumentos">

                        <thead>

                            <tr>

                                <th style="text-align: center;">
                                    Concepto
                                </th>

                                <th style="text-align: center;">
                                    Presentado
                                </th>

                                <th style="text-align: center;">
                                    No Presentado
                                </th>

                                <th style="text-align: center;">
                                    No aplica
                                </th>

                                <th style="text-align: center;">
                                    Derogado
                                </th>

                            </tr>

                        <th style="text-align: center;"></th>
                        <th style="text-align: center;"><input id="marcarTodosPresentado" name="marcarTodos" type="checkbox" onclick="marcar(this.id);"></th>
                        <th style="text-align: center;"><input id="marcarTodosNoPresentado" name="marcarTodos" type="checkbox" onclick="marcar(this.id);"></th>
                        <th style="text-align: center;"><input id="marcarTodosNoAplica" name="marcarTodos" type="checkbox" onclick="marcar(this.id);"></th>
                            

                        </thead>

                        <tbody id="conceptos">

                            <tr id="filaConsultaSoporteDerogados" style="display:none;">

                                <td>
                                    CONSULTAR SOPORTE DEROGADOS
                                </td>

                                <td></td>
                                <td></td>
                                <td></td>

                                <td style="text-align:center">
                                    <a id="linkSoporteDerogado" href="" target="black"></a>
                                </td>

                            </tr>

                            <tr id="filaSoporteDerogados" style="display:none;">
                                <td>
                                    SOPORTE DOCUMENTOS DEROGADOS
                                </td>

                                <td style="text-align: center;">                                      
                                    
                                </td>

                                <td style="text-align: center;"> 
                                    
                                </td>

                                <td></td>

                                <td style="text-align: right; max-width: 200px;">
                                    <input id="soporteDerogado" name="soporteDerogado" class="filestyle" type="file" data-buttonName="btn-primary" data-size="sm" data-buttonText="Adjuntar" onchange="valExtension();">
                                </td>

                            </tr>



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

                                <td>
                                    <?php echo $_smarty_tpl->tpl_vars['reporte']->value[$_smarty_tpl->getVariable('smarty')->value['section']['reporte']['index']]['descripcion'];?>

                                    <input type="hidden" id="idDoc<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" name="idDoc<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['reporte']->value[$_smarty_tpl->getVariable('smarty')->value['section']['reporte']['index']]['idDoc'];?>
"/>
                                    <input type="hidden" id="idLogDoc<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" name="idLogDoc<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['reporte']->value[$_smarty_tpl->getVariable('smarty')->value['section']['reporte']['index']]['idLogDoc'];?>
"/>
                                    <input type="hidden" id="idEstado<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" name="idEstado<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['reporte']->value[$_smarty_tpl->getVariable('smarty')->value['section']['reporte']['index']]['estado'];?>
"/>
                                </td>

                                <td style="text-align: center;">                                      
                                    <input name="presentado<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" id="presentado<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" type="checkbox" onchange="valCheckBox(this.id,<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
);">
                                </td>

                                <td style="text-align: center;"> 
                                    <input name="noPresentado<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" id="noPresentado<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" type="checkbox" onchange="valCheckBox(this.id,<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
);">
                                </td>    

                                <td style="text-align: center;"> 
                                    <input name="noAplica<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" id="noAplica<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" type="checkbox" onchange="valCheckBox(this.id,<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
);">
                                </td>

                                <td style="text-align: center;"> 
                                    <input name="derogado<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" id="derogado<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
" type="checkbox" onchange="valCheckBox(this.id,<?php echo $_smarty_tpl->tpl_vars['number']->value;?>
);">
                                </td>

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

        <div class="modal fade" id="modalConfirmErrores">

            <div class="modal-dialog">

                <div class="modal-content" style="overflow: hidden;">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="tituloModal2"></h4>
                    </div>

                    <div id="divMsjErrores" class="alert alert-danger alert-dismissable" style="display: none;">
                        
                        
                        <p id="MsjErrores"></p>
                    </div>

                    <div class="modal-body" id="cuerpoModal2">

                        <p>Esta lista de chequeo cuenta con documentos faltantes por favor seleccione el psicologo(a) asociado para enviar la notificación </p>

                        <div class="form-group">
                            <label class="col-md-5 control-label" for="empresaInt">Psicologo(a):</label>
                            <div class="col-md-7">
                                <select id="psicoErrores" name="psicoErrores" class="form-control">
                                    <option value=""></option>
                                    <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['name'] = 'psicologo';
$_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['psicologos']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['total']);
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['psicologos']->value[$_smarty_tpl->getVariable('smarty')->value['section']['psicologo']['index']]['usu_codigo'];?>
"><?php echo $_smarty_tpl->tpl_vars['psicologos']->value[$_smarty_tpl->getVariable('smarty')->value['section']['psicologo']['index']]['usu_nombres'];?>
 <?php echo $_smarty_tpl->tpl_vars['psicologos']->value[$_smarty_tpl->getVariable('smarty')->value['section']['psicologo']['index']]['usu_apellidos'];?>
</option>
                                    <?php endfor; endif; ?>    
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12" id="botones2" style="margin-top:20px;">

                            <input type="button" id="guardar" value="Confirmar" class="btn btn-primary" onclick="finalizar('-1');">                         

                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal --> 

        <div class="modal fade" id="modalConfirm">

            <div class="modal-dialog">

                <div class="modal-content" style="overflow: hidden;">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="tituloModal2"></h4>

                    </div>

                    <div id="divMsjSinErrores" class="alert alert-danger alert-dismissable" style="display: none;">
                        
                         
                        <p id="MsjSinErrores"></p>
                    </div>

                    <div class="modal-body" id="cuerpoModal2">

                        <p>Esta lista de chequeo cuenta con todos los documentos presentados y sera notificado al area de archivo. Por favor seleccione el psicologo(a) asociado.</p>

                        <div class="form-group">
                            <label class="col-md-5 control-label" for="empresaInt">Psicologo(a):</label>
                            <div class="col-md-7">
                                <select id="psicoSinErrores" name="psicoSinErrores" class="form-control">
                                    <option value=""></option>
                                    <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['name'] = 'psicologo';
$_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['psicologos']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['psicologo']['total']);
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['psicologos']->value[$_smarty_tpl->getVariable('smarty')->value['section']['psicologo']['index']]['usu_codigo'];?>
"><?php echo $_smarty_tpl->tpl_vars['psicologos']->value[$_smarty_tpl->getVariable('smarty')->value['section']['psicologo']['index']]['usu_nombres'];?>
 <?php echo $_smarty_tpl->tpl_vars['psicologos']->value[$_smarty_tpl->getVariable('smarty')->value['section']['psicologo']['index']]['usu_apellidos'];?>
</option>
                                    <?php endfor; endif; ?>    
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12" id="botones2" style="margin-top:20px;">

                            <input type="button" id="guardar" value="Confirmar" class="btn btn-primary" onclick="finalizar('1');">                         

                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal --> 

        <?php echo $_smarty_tpl->tpl_vars['footer']->value;?>


        <script src="../../libs/jquery/jquery.js"></script>
        <script src="../../libs/bootstrap/js/bootstrap.js"></script>
        <script src="../../libs/bootstrap/js/typeahead.js"></script>
        <script src="../../libs/filestyle/filestyle.js"></script>
        <script src="../../js/listaChequeoJs/listaChequeoJs.js"></script>

    </body>

</html><?php }} ?>