<?php /* Smarty version Smarty-3.1.13, created on 2015-07-13 10:37:35
         compiled from "..\..\web\reporteNominaPlanoWeb\reporteNominaPlano.html.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12373556376ab787468-25265475%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd62a7222d1922cf9e35f2d7343e10bd1e36e06ef' => 
    array (
      0 => '..\\..\\web\\reporteNominaPlanoWeb\\reporteNominaPlano.html.tpl',
      1 => 1436801854,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12373556376ab787468-25265475',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_556376abe8a159_73534255',
  'variables' => 
  array (
    'cabecera' => 1,
    'empresaInterna' => 1,
    'ciudades' => 1,
    'footer' => 1,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_556376abe8a159_73534255')) {function content_556376abe8a159_73534255($_smarty_tpl) {?><!DOCTYPE html>

<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html:charset=UTF-8">
        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/css/datepicker3.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" />
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet"/> 
        <link type="text/css" href="../../css/reporteNominaPlanoCss/reporteNominaPlanoCss.css" rel="stylesheet"/> 
        <link type="text/css" href="../../libs/wow/css/animate.css" rel="stylesheet">

        <title>Reporte Nomina Plano</title>

    </head>

    <body>

        <?php echo $_smarty_tpl->tpl_vars['cabecera']->value;?>


        <div id="contenedor" class="container">

            <legend>Reporte Nomina Plano</legend>  

            <form id="formReporteNominaPlano" name='formReporteNominaPlano' class="form-horizontal" action='../../vista/reporteNominaPlanoVista/reporteNominaPlanoVista.php' method="post" enctype="multipart/form-data">

                <div class="well">

                    <div class="col-lg-12">

                        <div class="col-lg-4">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="empresaInt">Empresa interna:</label>
                                <div class="col-md-8">
                                    <select id="empresaInt" name="empresaInt" class="form-control" onchange="consultarEmpClienteBySupervisor();">
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

                        <div class="col-lg-4">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="empUsu">Empresa cliente:</label>
                                <div class="col-md-8">
                                    <select id="empUsu" name="empUsu" class="form-control" onchange="consultarCC();"></select>
                                </div>
                            </div>                     

                        </div>

                        <div class="col-lg-4">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="centroCosto">Centro costo:</label>
                                <div class="col-md-8">
                                    <select id="centroCosto" name="centroCosto" class="form-control" onchange=""></select>
                                </div>
                            </div>

                        </div>                        

                    </div>

                    <div class="col-lg-12">

                        <div class="col-lg-4">

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

                        <div class="col-lg-4">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="mes">Mes:</label>
                                <div class="col-md-8">
                                    <input id="mes" name="mes"  placeholder="" class="form-control datepicker" type="text">
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-4">

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="periocidad">Periodicidad:</label>
                                <div class="col-md-8">
                                    <select id="periocidad" name="periocidad" class="form-control" onchange="">
                                        <option value=""></option>  
                                        <option value="1">Primer quincena</option>                                    
                                        <option value="2">Segunda quincena</option>  
                                        <option value="3">Mensual</option>  
                                    </select>
                                </div>
                            </div>

                        </div>

                    </div>

                    <input type="hidden" id="empIntOculto" name="empIntOculto">
                    <input type="hidden" id="empCliOculto" name="empCliOculto">
                    <input type="hidden" id="centroCostoOculto" name="centroCostoOculto">
                    <input type="hidden" id="ciudadOculto" name="ciudadOculto">
                    <input type="hidden" id="mesOculto" name="mesOculto">
                    <input type="hidden" id="periocidadOculto" name="periocidadOculto">

                    <input type="hidden" id="nomArchivoOculto" name="nomArchivoOculto">

                    <div class="col-lg-12" style="text-align: right;">                                  

                        <a type="button" id="registrar" class="btn btn-primary" onclick="valArchivo();" style="display: none;"><span class="fa fa-arrow-up"></span>  Planilla</a>
                        <a type="button" id="plantilla" class="btn btn-primary" onclick="descargarPlantilla();" style="display: none;"><span class="fa fa-arrow-down"></span>  Planilla</a>
                        <a type="button" id="consultar"  class="btn btn-primary" onclick="valVacios();"><span class="fa fa-search"></span> Consultar</a>
                        <a type="reset"  id="limpiar"   class="btn btn-danger"  onclick="limpiarForm();"><span class="fa fa-eraser"></span> Limpiar</a>

                    </div>

                    <div id="contenedorBtnCargar" class="col-lg-12" style="display:none; text-align: right;margin-left: 550px; margin-top:5px;">

                        <div class="col-lg-5 col-md-offset-1" style="">
                            <input id="planillaNomina" name="planillaNomina" class="filestyle" type="file" data-buttonName="btn-primary" data-size="nr" data-input="true" data-buttonText="Seleccionar" onchange="valExtension();">
                        </div>                   

                    </div>          


                </div>

                


                <div id="contenedorTablaErrores" class="table-responsive" style="display:none;">

                    <legend>Listado de errores</legend>

                    <table id="tablaErrores" class="table table-hover table-striped table-condensed">

                        <thead id="cabeceraErrores">
                            <tr id="filaEncabezadosErrores">                                
                            </tr>
                        </thead>

                        <tbody id="datosErrores">
                        </tbody>

                    </table>

                    


                </div>     

                <div id="contenedorTabla" style="display: none">

                    <legend>Datos registrados</legend>                   

                    <div class="row" style="font-size: 10px;">

                        <div id="contentUserSinReg" class="col-lg-12 col-md-6">

                        </div>                        

                        <div class="col-lg-3 col-md-6">
                            <div id="panelUserReg" class="panel panel-success">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-user fa-4x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div id="totalUsers" class="huge numeroInfo"></div>
                                            <div>Usuarios Registrados</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div id="panelHrsOrdi" class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-clock-o fa-4x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div id="hrsHabiles" class="huge numeroInfo"></div>
                                            <div>Horas Habiles</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-clock-o fa-4x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div id="hrsDominicales" class="huge numeroInfo"></div>
                                            <div>Horas Dominicales</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-warning">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-clock-o fa-4x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div id="hrsFestivos" class="huge numeroInfo"></div>
                                            <div>Horas Festivos</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-9 col-md-6">
                            <div id="contenedorEstadoPlanilla" class="panel panel-danger">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-file fa-4x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div id="estadoPlanilla" class="huge numeroInfo"></div>
                                            <div id="infoPlanilla">Estado Planilla</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-dollar fa-4x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div id="totalAdicionales" class="huge numeroInfo"></div>
                                            <div><a id="linkDetAdicionales" onclick="mostrarDetAdicionales();">Detalle Adicionales</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>           
                    <!-- /.row --> 

                    <div id="subContentTabla" class="table-responsive">
                        <table id="tablaDatos" class="table table-hover table-striped table-condensed">

                            <thead id="cabeceraDatosUser">
                                <tr id="filaEncabezados">                                
                                </tr>
                            </thead>

                            <tbody id="datosUsuario">
                            </tbody>

                        </table>
                    </div>


                    <div class="col-lg-12" style="text-align: right;">

                        <a type="button" id="finalizar" class="btn btn-primary" onclick="confirmFinalizar();"><span class="fa fa-check"></span>Terminar</a> 
                        <a type="button" id="eliminar" class="btn btn-danger" onclick="confirmEliminar();"><span class="fa fa-close"></span>Eliminar</a>

                    </div>

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

        <div class="modal fade" id="modalInfoDatos">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="tituloModalDatos"></h4>
                    </div>

                    <div class="modal-body" id="cuerpoModalDatos">
                    </div>

                    <div class="modal-footer" style="margin-top: 20px;">
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->  


        <?php echo $_smarty_tpl->tpl_vars['footer']->value;?>

        <script src="../../libs/jquery/jquery.js"></script>  
        <script src="../../libs/bootstrap/js/bootstrap.js"></script>
        <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/bootstrap-datepicker.js"></script>
        <script src="../../libs/calendario/eternicode-bootstrap-datepicker-8bc254a/js/locales/bootstrap-datepicker.es.js"></script> 
        <script src="../../libs/filestyle/filestyle.js"></script>
        <script src="../../js/reporteNominaPlanoJs/reporteNominaPlano.js"></script> 
        <script src="../../libs/wow/js/wow.min.js"></script>
        <script>
                            new WOW().init();
        </script>

    </body>

</html><?php }} ?>