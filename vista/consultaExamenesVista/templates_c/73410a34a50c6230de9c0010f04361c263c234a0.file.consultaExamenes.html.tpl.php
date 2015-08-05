<?php /* Smarty version Smarty-3.1.13, created on 2015-08-04 17:30:39
         compiled from "..\..\web\consultaExamenesWeb\consultaExamenes.html.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21587539b287d00e9f4-00492150%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '73410a34a50c6230de9c0010f04361c263c234a0' => 
    array (
      0 => '..\\..\\web\\consultaExamenesWeb\\consultaExamenes.html.tpl',
      1 => 1437145021,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21587539b287d00e9f4-00492150',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_539b287d0cff44_44078980',
  'variables' => 
  array (
    'cabecera' => 1,
    'mostrarMsj' => 1,
    'msjError' => 1,
    'mostrarMsjExito' => 1,
    'msjExito' => 1,
    'fechaIni' => 1,
    'fechaFin' => 1,
    'empresaInt' => 1,
    'empresaInterna' => 1,
    'cliente' => 1,
    'cedula' => 1,
    'estado' => 1,
    'solIni' => 1,
    'solFin' => 1,
    'mostrarBtnExcel' => 1,
    'mostrarConsulta' => 1,
    'reporte' => 1,
    'number' => 1,
    'paginaAct' => 1,
    'paginaPrev' => 0,
    'paginador' => 1,
    'paginaPos' => 0,
    'footer' => 1,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_539b287d0cff44_44078980')) {function content_539b287d0cff44_44078980($_smarty_tpl) {?><!DOCTYPE html>
<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">    

        <link type="text/css" href="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/css/datepicker3.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" />
        
        <link type="text/css" href="../../css/consultaExamenesCss/consultaExamenesCss.css" rel="stylesheet" />
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet" />

        <title>Consulta Examenes</title>

    </head>

    <body>
        <?php echo $_smarty_tpl->tpl_vars['cabecera']->value;?>


        <div id="contenedor" class="container">

            <legend>Consulta Examenes</legend>

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

            <form id="consultaExamenesForm" name="consultaExamenesForm" class="form-horizontal" action="../../vista/consultaExamenesVista/consultaExamenesVista.php" method="post" autocomplete="off">

                <div id="forma" class="well">

                    <input type="hidden" name="accion" value="" />

                    <div class="col-lg-5">

                        <div class="form-group ">
                            <label class="col-md-4 control-label" for="fechaIni">Fecha inicial:</label>  
                            <div class="col-md-8">
                                <input id="fechaIniOculto" name="fechaIniOculto" value="<?php echo $_smarty_tpl->tpl_vars['fechaIni']->value;?>
" type="hidden">
                                <input id="fechaIni" name="fechaIni"  placeholder="Fecha inicial" class="form-control input-md datepicker" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="fechaFin">Fecha final:</label>  
                            <div class="col-md-8 ">
                                <input id="fechaFinOculto" name="fechaFinOculto" value="<?php echo $_smarty_tpl->tpl_vars['fechaFin']->value;?>
" type="hidden">
                                <input id="fechaFin" name="fechaFin" placeholder="Fecha final" class="form-control input-md datepicker" type="text">
                            </div>
                        </div>
                    </div>                  

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="empresaInt">Empresa interna:</label>
                            <div class="col-md-8">
                                <input type="hidden" id="empresaIntOculto" name="empresaIntOculto" value="<?php echo $_smarty_tpl->tpl_vars['empresaInt']->value;?>
">
                                <select id="empresaInt" name="empresaInt" class="form-control" onchange="consultarEmpClienteCE();">
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
                            <label class="col-md-4 control-label" for="cliente">Cliente:</label>
                            <div class="col-md-8">
                                <input type="hidden" id="clienteOculto" name="clienteOculto" value="<?php echo $_smarty_tpl->tpl_vars['cliente']->value;?>
">
                                <select id="cliente" name="cliente" class="form-control">
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-5 ">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="cedula">Cedula:</label>  
                            <div class="col-md-8">
                                <input id="cedulaOculto" name="cedulaOculto" value="<?php echo $_smarty_tpl->tpl_vars['cedula']->value;?>
" type="hidden"> 
                                <input id="cedula" name="cedula" placeholder="Cedula" class="form-control input-md" type="text">                                
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-5 ">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="estado">Estado:</label>
                            <div class="col-md-8">
                                <input id="estadoOculto" name="estadoOculto" value="<?php echo $_smarty_tpl->tpl_vars['estado']->value;?>
" type="hidden"> 
                                <select id="estado" name="estado" class="form-control">
                                    <option value=""></option>
                                    <option value="1">Ejecutado</option>
                                    <option value="0">No ejecutado</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-5">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="solicitud">Rango de id:</label>  
                            <div class="col-md-3">
                                <input id="solIniOculto" name="solIniOculto" value="<?php echo $_smarty_tpl->tpl_vars['solIni']->value;?>
" type="hidden"> 
                                <input id="solIni" name="solIni" placeholder="Id. inicial" class="form-control input-md" type="text"> 
                            </div>

                            <div class="col-md-1">
                                <span class="glyphicon glyphicon-minus"></span>
                            </div>
                            <div class="col-md-3">
                                <input id="solFinOculto" name="solFinOculto" value="<?php echo $_smarty_tpl->tpl_vars['solFin']->value;?>
" type="hidden"> 
                                <input id="solFin" name="solFin" placeholder="Id. Final" class="form-control input-md" type="text"> 
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-12" id="botones">

                        <button type="button" id="reporteExcel" name="reporteExcel" class="btn btn-success" style="display:<?php echo $_smarty_tpl->tpl_vars['mostrarBtnExcel']->value;?>
" onclick="generarExcel();"><span class="glyphicon glyphicon-file"></span> Reporte Excel </button>
                        <input type="button" id="consultar" value="Consultar" class="btn btn-primary" onclick="validarVacios();">
                        <input type="reset" id="limpiar" value="Limpiar" class="btn btn-danger" onclick="reiniciar();">

                    </div>

                </div>

                <hr>

                <div id="tablaConsultaExamenes" class="col-lg-12" style="display:<?php echo $_smarty_tpl->tpl_vars['mostrarConsulta']->value;?>
;">

                    <table id="registrosExamenes" class="table table-hover table-striped table-condensed">

                        <thead>

                            <tr>
                                <th>Id orden</th>
                                <th>Empleado</th>
                                <th>Cedula</th>
                                <th>Examen</th>
                                    
                                <th>Estado</th>   
                            </tr>

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
">
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
                            <li><a href="../../vista/consultaExamenesVista/consultaExamenesVista.php?fechaIni=<?php echo $_smarty_tpl->tpl_vars['fechaIni']->value;?>
&fechaFin=<?php echo $_smarty_tpl->tpl_vars['fechaFin']->value;?>
&empresaInt=<?php echo $_smarty_tpl->tpl_vars['empresaInt']->value;?>
&cliente=<?php echo $_smarty_tpl->tpl_vars['cliente']->value;?>
&solIni=<?php echo $_smarty_tpl->tpl_vars['solIni']->value;?>
&solFin=<?php echo $_smarty_tpl->tpl_vars['solFin']->value;?>
&cedula=<?php echo $_smarty_tpl->tpl_vars['cedula']->value;?>
&estado=<?php echo $_smarty_tpl->tpl_vars['estado']->value;?>
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
                                    <a href="../../vista/consultaExamenesVista/consultaExamenesVista.php?fechaIni=<?php echo $_smarty_tpl->tpl_vars['fechaIni']->value;?>
&fechaFin=<?php echo $_smarty_tpl->tpl_vars['fechaFin']->value;?>
&empresaInt=<?php echo $_smarty_tpl->tpl_vars['empresaInt']->value;?>
&cliente=<?php echo $_smarty_tpl->tpl_vars['cliente']->value;?>
&solIni=<?php echo $_smarty_tpl->tpl_vars['solIni']->value;?>
&solFin=<?php echo $_smarty_tpl->tpl_vars['solFin']->value;?>
&cedula=<?php echo $_smarty_tpl->tpl_vars['cedula']->value;?>
&estado=<?php echo $_smarty_tpl->tpl_vars['estado']->value;?>
&accion=Consultar&pagina=<?php echo $_smarty_tpl->tpl_vars['paginador']->value[$_smarty_tpl->getVariable('smarty')->value['section']['pagina']['index']]['pagina'];?>
"><?php echo $_smarty_tpl->tpl_vars['paginador']->value[$_smarty_tpl->getVariable('smarty')->value['section']['pagina']['index']]['pagina'];?>
</a>
                                </li>                    
                            <?php endfor; endif; ?>

                            <li><a href="../../vista/consultaExamenesVista/consultaExamenesVista.php?fechaIni=<?php echo $_smarty_tpl->tpl_vars['fechaIni']->value;?>
&fechaFin=<?php echo $_smarty_tpl->tpl_vars['fechaFin']->value;?>
&empresaInt=<?php echo $_smarty_tpl->tpl_vars['empresaInt']->value;?>
&cliente=<?php echo $_smarty_tpl->tpl_vars['cliente']->value;?>
&solIni=<?php echo $_smarty_tpl->tpl_vars['solIni']->value;?>
&solFin=<?php echo $_smarty_tpl->tpl_vars['solFin']->value;?>
&cedula=<?php echo $_smarty_tpl->tpl_vars['cedula']->value;?>
&estado=<?php echo $_smarty_tpl->tpl_vars['estado']->value;?>
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

           <div class="modal fade" id="modalLoad">
            <div class="modal-dialog">
                <div class="modal-content noFondoModal">
                    <div class="modal-body" style="text-align: center;">
                        
                        <span class=" fa fa-cog fa-spin fa-6x iconblue"></span>
                    </div>
                </div>
            </div>
        </div>

        <?php echo $_smarty_tpl->tpl_vars['footer']->value;?>

    </body>

    <script src="../../libs/jquery/jquery.js"></script>
    <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/bootstrap-datepicker.js"></script>
    <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/locales/bootstrap-datepicker.es.js"></script>        
    <script src="../../libs/bootstrap/js/bootstrap.js"></script>  
    
    <script src="../../js/consultaExamenesJs/consultaExamenesJs.js"></script>

</html><?php }} ?>