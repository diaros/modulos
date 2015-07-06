<?php /* Smarty version Smarty-3.1.13, created on 2015-04-17 16:21:55
         compiled from "..\..\web\solicitudCompraWeb\solicitudCompra.html.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5328551ad0aad0ecf6-19442504%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c597c5a843a3c9684f61c7648b0b7a670f43e1a5' => 
    array (
      0 => '..\\..\\web\\solicitudCompraWeb\\solicitudCompra.html.tpl',
      1 => 1429285418,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5328551ad0aad0ecf6-19442504',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_551ad0ab134f43_39635981',
  'variables' => 
  array (
    'cabecera' => 1,
    'empresaInterna' => 1,
    'ciudades' => 1,
    'conceptosCompra' => 1,
    'mostrarGuardar' => 0,
    'footer' => 1,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_551ad0ab134f43_39635981')) {function content_551ad0ab134f43_39635981($_smarty_tpl) {?><!DOCTYPE html>

<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" />
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet"/> 
        <link type="text/css" href="../../css/solicitudCompraCss/solicitusComraCss.css" rel="stylesheet"/> 

        <title>Solicitud compra</title>

    </head>

    <body>

        <?php echo $_smarty_tpl->tpl_vars['cabecera']->value;?>

        <div id="contenedor" class="container">

            <legend>Solicitud compra</legend>

            <form id="solicitudCompraForm" name="solicitudComraForm" class="form-horizontal" action="../../vista/solicitudCompraVista/solicitudCompraVista.php" method="post" autocomplete="off">

                
                <div class="well">

                    <p class="text-muted">Encabezado de la solicitud</p>

                    <div class="col-lg-12">

                        <div class="col-lg-4">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="empresaInt">Empresa interna:</label>
                                <div class="col-md-8">
                                    <select id="empresaInt" name="empresaInt" class="form-control" onchange="consultarEmpClienteSE();">
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

                        <div class="col-lg-8">

                            <div class="form-group">
                                
                                <label class="col-md-2 control-label" for="tipoCompra">Tipo compra:</label>
                                <div class="col-md-10">

                                    <div class="btn-group" data-toggle="buttons">

                                        <label id="facturable" class="btn btn-success" onclick="asignarTipoCompra(this.id);">Compra Facturable
                                            <input type="radio" name="options"  autocomplete="off" onclick="asignarTipoCompra(this.id);">
                                            <span id="spanFacturable" class="fa fa-check"></span>
                                        </label>

                                        <label id="presupuesto" class="btn btn-primary" style="margin-left: 13px;" onclick="asignarTipoCompra(this.id);">Incluida en Presupuesto
                                            <input type="radio" name="options"  autocomplete="off">
                                            <span id="spanPresupuesto" class="fa fa-check"></span>
                                        </label>

                                        <label id="administrativa" class="btn btn-warning" style="margin-left: 13px;" onclick="asignarTipoCompra(this.id);">Administrativa
                                            <input type="radio" name="options"  autocomplete="off" >
                                            <span id="spanAdministrativa" class="fa fa-check"></span>
                                        </label>

                                        <input type="hidden" id="tipoCompraOculto" name="tipoCompraOculto" />

                                    </div>

                                </div>

                            </div>                     

                        </div>                  

                    </div>

                    <div class="col-lg-12">

                        <div class="col-lg-4">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="telContacto">Telefono:</label>
                                <div class="col-md-8">
                                    <input id="telContacto" name="telContacto" placeholder="Telefono" class="form-control input-md" type="text">   
                                </div>
                            </div>                     

                        </div>

                        <div class="col-lg-4">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="ciudad">Ciudad:</label>
                                <div class="col-md-8">
                                    <select id="ciudad" name="ciudad" class="form-control" onchange="consultarUsuarioAprueba();">
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

                        <div class="col-lg-4">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="conceptos">Concepto:</label>
                                <div class="col-md-8">
                                    <select id="conceptos" name="conceptos" class="form-control" >
                                        <option value=""></option>
                                        <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['name'] = 'conceptos';
$_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['conceptosCompra']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['conceptos']['total']);
?>
                                            <option value="<?php echo $_smarty_tpl->tpl_vars['conceptosCompra']->value[$_smarty_tpl->getVariable('smarty')->value['section']['conceptos']['index']]['codigo'];?>
"><?php echo $_smarty_tpl->tpl_vars['conceptosCompra']->value[$_smarty_tpl->getVariable('smarty')->value['section']['conceptos']['index']]['detalle'];?>
</option>
                                        <?php endfor; endif; ?>     
                                    </select>
                                </div>
                            </div>                     

                        </div>

                    </div>

                    <div class="col-lg-12">

                        <div class="col-lg-4">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="empCli">Cliente:</label>
                                <div class="col-md-8">
                                    <select id="empCli" name="empCli" class="form-control"></select>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-4">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="presupuestoBiplus">Presupuesto Biplus:</label>
                                <div class="col-md-8">
                                    <input id="presupuestoBiplus" name="presupuestoBiplus" placeholder="" class="form-control input-md" type="text" onblur="validaPresupuesto();">      
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-4">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="aiu">AIU:</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input id="aiu" name="aiu" class="form-control" placeholder="" type="text" style="text-align: center;">
                                        <span class="input-group-addon">%</span>
                                    </div>

                                </div>
                            </div>

                        </div>    

                    </div>

                    <div class="col-lg-12">

                        <div class="col-lg-4">

                            <div class="form-group">

                                <label class="col-md-4 control-label" for="centroCosto">Centro costo:</label>  
                                <div class="col-md-8">

                                    <input class="form-control input-md" id="centroCosto" name="centroCosto" type="text" placeholder="" >
                                    <input type="hidden" id="centroCostoId" name="centroCostoId" value=""/>

                                </div>

                            </div> 

                        </div>

                        <div id="divActividad" class="col-lg-8">

                            <div class="form-group">                                
                                <label class="col-md-2 control-label" for="actividad">Actividad:</label>  
                                <div class="col-md-10">
                                    <input class="form-control input-md" id="actividad" name="actividad" type="text" disabled="true">                                   
                                </div>                                
                            </div>

                        </div>

                    </div>                                    

                    <div class="col-lg-12">

                        <div class="col-lg-4">

                            <div class="form-group">

                                <label class="col-md-4 control-label" for="fechaReq">Fecha requerido:</label>  
                                <div class="col-md-8">

                                    <input id="fechaReq" name="fechaReq"  placeholder="" class="form-control input-sm datepicker" type="text">

                                </div>

                            </div> 

                        </div>

                        <div class="col-lg-4">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="usuAprueba">Solicitud de aprobación a:</label>
                                <div class="col-md-8">
                                    <select id="usuAprueba" name="usuAprueba" class="form-control">                                        
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-4">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="descripcion">Descripción:</label>
                                <div class="col-md-8">                     
                                    <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                                </div>
                            </div>

                        </div>

                    </div>
                                    
                    <div class="col-lg-12" style="text-align: right;">

                        <a id="btnGenerarPdf" class="btn btn-primary" style="display: <?php echo $_smarty_tpl->tpl_vars['mostrarGuardar']->value;?>
" onclick="generarpdf();"><span class="glyphicon glyphicon-file"></span>  Generar PDF</a>
                        <a id="btnFinalizar" class="btn btn-primary" style="display: <?php echo $_smarty_tpl->tpl_vars['mostrarGuardar']->value;?>
" onclick="consultarPsicoAsignado();">Finalizar</a>
                        <a id="btnLimpiar" class="btn btn-danger" onclick="limpiar();">Limpiar</a>

                    </div> 

                </div>              

                <div class="panel panel-default" style="overflow: hidden;">

                    <div class="panel-heading" style="overflow:hidden;">
                        
                        <div class="col-lg-10"><p class="text-muted">Registro de items generico</p></div>
                        
                        <div class="col-lg-2" id="divIcon" style="display: none; text-align: center;"><span id="spanIcono" class="fa fa-spin"></span></div>
                        
                    </div>


                    <table id="tablaItems" class="table table-condensed table-responsive table-striped">

                        <thead>

                            <tr>
                                
                                <th style="text-align: center;">
                                    Cantidad                             
                                </th>

                                <th style="text-align: center;">
                                    Descripciòn                             
                                </th>     

                                <th style="text-align: center;">
                                    Especificaciones                             
                                </th>     

                                <th style="text-align: center;">
                                    Ciudad                             
                                </th>     

                                <th style="text-align: center;">
                                    Direcciòn                                
                                </th>     

                                <th style="text-align: center;">
                                    Contacto/Recibe                             
                                </th>

                                <th>
                                    Agregar
                                </th>
                                
                                <th>
                                    Borrar
                                </th>

                            </tr>


                        </thead>

                        <tbody id="listaItems">

                            <tr id="filaItem1">
                                <td><input id="cantItem1" style="text-align: center;" type="text" class="form-control"></td>
                                <td><input id="descItem1" style="text-align: center;" type="text" class="form-control"></td>  
                                <td><input id="especItem1" style="text-align: center;" type="text" class="form-control"></td>  
                                <td><input id="ciudadItem1" style="text-align: center;" type="text" class="form-control"></td>  
                                <td><input id="dirItem1" style="text-align: center;" type="text" class="form-control"></td>  
                                <td><input id="contacItem1" style="text-align: center;" type="text" class="form-control"></td>  
                                <td>                                 
                                    <a type="button" class="btn btn-primary" id="agregar1" onclick="agregarItem(this.id);">
                                       <span class="fa fa-check">                                
                                    </span>
                                   </a>                                     
                                </td>
                                                              
                                <td>                                 
                                   <a type="button" class="btn btn-danger" id="borrar1" onclick="eliminarItem(this.id);">
                                       <span class="fa fa-trash">                                
                                    </span>
                                   </a>                                     
                                </td>  
                            </tr>                           

                        </tbody>                        

                    </table>

                </div>

            </form>

        </div>

        <?php echo $_smarty_tpl->tpl_vars['footer']->value;?>


        <script src="../../libs/jquery/jquery.js"></script>  
        <script src="../../libs/bootstrap/js/bootstrap.js"></script>
        <script src="../../libs/bootstrap/js/typeahead.js"></script>
        <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/bootstrap-datepicker.js"></script>
        <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/locales/bootstrap-datepicker.es.js"></script> 
        <script src="../../libs/moment-develop/min/moment.min.js"></script>  
        <script src="../../libs/calendario/bootstrap-datetimepicker-master/src/js/bootstrap-datetimepicker.js"></script>    
        <script src="../../js/solicitudCompraJs/solicitudCompra.js"></script> 


    </body>

</html><?php }} ?>