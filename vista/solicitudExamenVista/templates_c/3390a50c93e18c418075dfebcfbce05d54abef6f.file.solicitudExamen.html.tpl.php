<?php /* Smarty version Smarty-3.1.13, created on 2015-08-04 17:20:12
         compiled from "..\..\web\solicitudExamenWeb\solicitudExamen.html.tpl" */ ?>
<?php /*%%SmartyHeaderCode:86353f39ead594481-43917605%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3390a50c93e18c418075dfebcfbce05d54abef6f' => 
    array (
      0 => '..\\..\\web\\solicitudExamenWeb\\solicitudExamen.html.tpl',
      1 => 1437145152,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '86353f39ead594481-43917605',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53f39ead781cb7_69127717',
  'variables' => 
  array (
    'cabecera' => 1,
    'mostrarMsj' => 1,
    'msjError' => 1,
    'mostrarMsjExito' => 1,
    'msjExito' => 1,
    'idUserLog' => 1,
    'vlrRegActivo' => 1,
    'empresaInterna' => 1,
    'laboratorios' => 1,
    'mostrarConsulta' => 1,
    'mostrarConsultaExamen' => 1,
    'footer' => 1,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f39ead781cb7_69127717')) {function content_53f39ead781cb7_69127717($_smarty_tpl) {?><!DOCTYPE html>

<html>

    <head>
        
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">       

        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.css" rel="stylesheet" />
        <link type="text/css" href="../../css/solicitudExamenCss/solicitudExamenCss.css" rel="stylesheet"/> 
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet"/> 

        <title>Solicitud examen</title>
        
    </head>

    <body>            

        <?php echo $_smarty_tpl->tpl_vars['cabecera']->value;?>


        <div id="contenedor" class="container">

            <legend>Solicitud examen</legend>
            
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

            <form id="crearClienteForm" name="crearClienteForm" class="form-horizontal" action="../../vista/solicitudExamenVista/solicitudExamenVista.php" method="post" autocomplete="off">

                <ul class="nav nav-tabs">
                    <li id="tab1"><a href="#solExamenMedico" data-toggle="tab" id="pesta1">Solicitud examen medico</a></li>
                    <li id="tab2" style="display:none;"><a href="#selecExamenes" data-toggle="tab"  id="pesta2">Seleccion de examenes</a></li>
                </ul>

                <div class="tab-content tabs-below">                    

                    <input type="hidden" id="tipoFacOculto" name="tipoFacOculto" value="">
                    <input type="hidden" id="tipoReg" name="tipoReg" value="<?php echo $_smarty_tpl->tpl_vars['vlrRegActivo']->value;?>
">
                    <input type="hidden" id="idOrden" name="idOrden" value="">

                    <div class="tab-pane active" id="solExamenMedico">

                        <div class="well" id="forma">
                           
                            <div class="panel-heading">
                                <h4>Información empresarial</h4>
                            </div>                        

                            <div class="col-lg-5">

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

                            <div class="col-lg-5">

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="empUsu">Empresa cliente:</label>
                                    <div class="col-md-8">
                                        <select id="empUsu" name="empUsu" class="form-control" onchange="consultarTipoFac();"></select>
                                    </div>
                                </div>                     

                            </div>

                            <div class="col-lg-5">

                                <div class="form-group">

                                    <label class="col-md-4 control-label" for="centroCosto">Centro costo:</label>
                                    <div class="col-md-8">
                                        <select id="centroCosto" name="centroCosto" class="form-control"></select>
                                    </div>

                                </div>                     

                            </div>

                            <div class="col-lg-5" id="campoNivel" style="display:none;">

                                <div class="form-group">

                                    <label class="col-md-4 control-label" for="nivel">Nivel:</label>

                                    <div class="col-md-8">
                                        <select id="nivel" name="nivel" class="form-control"></select>
                                    </div>

                                </div>                     

                            </div>            

                        </div>

                        <div class="well" id="forma">                            

                            <div class="panel-heading">
                                <h4>Informacion IPS / Laboratorio</h4>
                            </div>

                            <div class="col-lg-5">

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="ciudad">Ciudad:</label>
                                    <div class="col-md-8">
                                        <select id="ciudad" name="ciudad" class="form-control" >
                                          
                                        </select>
                                    </div>
                                </div>                     

                            </div>

                            <div class="col-lg-5">

                                <div class="form-group">

                                    <label class="col-md-4 control-label" for="lab">Laboratorio:</label>

                                    <div class="col-md-8">
                                        <select id="lab" name="lab" class="form-control">
                                            
                                            <option value=""></option>
                                            
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
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['laboratorios']->value[$_smarty_tpl->getVariable('smarty')->value['section']['laboratorio']['index']]['id_laboratorio'];?>
"><?php echo $_smarty_tpl->tpl_vars['laboratorios']->value[$_smarty_tpl->getVariable('smarty')->value['section']['laboratorio']['index']]['nombre'];?>
</option>
                                            <?php endfor; endif; ?>
                                            
                                        </select>
                                    </div>

                                </div>                     

                            </div>

                            <div class="col-lg-10">

                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="observ">Observaciones:</label>

                                    <div class="col-md-10">

                                        <textarea class="form-control" id="observ" name="observ"></textarea>

                                    </div>
                                </div>                                

                            </div>            

                        </div>
                                            
                       <div id="panelWell">
                           
                           <div class="panel-heading">
                                <h4>Datos personales</h4>
                            </div>

                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="idUser">No.Identificación:</label>  
                                    <div class="col-md-8">
                                        <input id="idUser" name="idUser" placeholder="Identificación" class="form-control input-md" type="text" onblur="consultarUser();">                          
                                    </div>
                                </div>
                            </div> 

                            <div class="col-lg-5">

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="nomUser">Nombre:</label>  
                                    <div class="col-md-8">
                                        <input id="nomUser" name="nomUser" placeholder="Nombre" class="form-control input-md" type="text">                          
                                    </div>
                                </div>

                            </div> 

                            <div class="col-lg-5">                           
                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="cargo">Cargo:</label>  
                                    <div class="col-md-8">
                                        
                                            <input class="form-control input-md" id="cargo" name="cargo" type="text" placeholder="Cargo" >
                                            <input type="hidden" id="cargoId" name="cargoId" value=""/>
                                        
                                    </div>
                                </div> 

                            </div>

                            <div class="col-lg-12" id="botones">

                                <button type="button" id="cosulUsersOrden" name="cosulUsersOrden" class="btn btn-primary" style="display:none;" onclick="consultarUsuariosOrden();"><span class="glyphicon glyphicon-refresh"></span> Recargar tabla</button>
                                <input type="button" id="guardarUser" value="Guardar usuario" class="btn btn-success" onclick="valVaciosUser();" style="display:none">
                                <input type="button" id="guardar" value="Guardar" class="btn btn-primary" onclick="valVaciosSE();">
                                <input type="button" id="limpiar" value="Limpiar" class="btn btn-danger" onclick="reiniciar();">

                            </div>                            

                        </div>                    

                    

                        <hr>

                        <div id="tablaUsuarios" class="col-lg-12" style="display:<?php echo $_smarty_tpl->tpl_vars['mostrarConsulta']->value;?>
;">

                            <table id="tablaDatosUsuarios" class="table table-hover table-striped table-condensed">

                                <thead>

                                <th>Id orden</th>
                                <th>Nombre</th>
                                <th>Cedula</th>
                                <th>Eliminar</th>

                                </thead> 

                                <tbody id="datosUsuarios">
                                </tbody>

                            </table>                  

                        </div>


                    </div>

                    <div class="tab-pane" id="selecExamenes">

                        <div class="well" id="forma">

                            <div class="panel-heading">
                                <h4>Seleccion de examenes</h4>
                            </div>

                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="catExam">Categoria:</label>
                                    <div class="col-md-8">

                                        <select id="catExam" name="catExam" class="form-control" onchange="conultarExamenes();">
                                        </select>     

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="examen">Examen:</label>
                                    <div class="col-md-8" id="examen">
                                    </div>
                                </div>
                            </div>                      

                            <div class="col-lg-12" id="botones">
                                
                                <button type="button" id="cosulExamsOrden" name="cosulExamsOrden" class="btn btn-primary" style="display:none;" onclick="consultarExamenesOrden();"><span class="glyphicon glyphicon-refresh"></span> Recargar tabla</button>
                                <input type="button" id="finalizarSol" value="Finalizar solicitud" class="btn btn-success" onclick="confirmFinalizarSol();" style="display:none">
                                <input type="button" id="guardarExam" value="Guardar" class="btn btn-primary" onclick="valVacionExam();">
                                <input type="button" id="limpiarExam" value="Limpiar" class="btn btn-danger" onclick="reiniciarExam();">

                            </div>

                        </div>

                        <hr>

                        <div id="tablaExamen" class="col-lg-12" style="display:<?php echo $_smarty_tpl->tpl_vars['mostrarConsultaExamen']->value;?>
;">

                            <table id="tablaDatosExamen" class="table table-hover table-striped table-condensed">

                                <thead>

                                    <th>Id orden</th>
                                    <th>Examen</th>
                                    <th>Eliminar</th>

                                </thead> 

                                <tbody id="datosExamen">
                                </tbody>

                            </table>                  

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
                <div class="modal-content noFondoModal">
                    <div class="modal-body" style="text-align: center;">
                        
                        <span class=" fa fa-cog fa-spin fa-6x iconblue"></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalConfirm">

            <div class="modal-dialog">

                <div class="modal-content" style="overflow: hidden;">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="tituloModal2"></h4>
                    </div>

                    <div class="modal-body" id="cuerpoModal2">

                        <p>Esta seguro que desea eliminar este registro?</p>

                        <div class="col-lg-12" id="botones2">

                            <input type="button" id="guardar" value="Confirmar" class="btn btn-primary" onclick="eliminarUser();">
                            <input type="hidden" id="ocultoId">

                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal --> 

        <div class="modal fade" id="modalConfirm2">

            <div class="modal-dialog">

                <div class="modal-content" style="overflow: hidden;">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="tituloModal3"></h4>
                    </div>

                    <div class="modal-body" id="cuerpoModal3">

                        <p>Esta seguro que desea eliminar este registro?</p>

                        <div class="col-lg-12" id="botones3">

                            <input type="button" id="guardar2" value="Confirmar" class="btn btn-primary" onclick="eliminarExamen();">
                            <input type="hidden" id="ocultoId2">

                        </div>                        
                   
                    </div>
                         
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        
        <div class="modal fade" id="modalConfirm3">

            <div class="modal-dialog">

                <div class="modal-content" style="overflow: hidden;">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="tituloModal3">Finalizar solicitud</h4>
                    </div>

                    <div class="modal-body" id="cuerpoModal3">

                        <p>Esta seguro que desea finalizar la soliciutd?</p>

                        <div class="col-lg-12" id="botones3">

                            <input type="button" id="finalizar" value="Confirmar" class="btn btn-primary" onclick="finalizarSol();">                            

                        </div>                        
                   
                    </div>
                         
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal --> 

        <?php echo $_smarty_tpl->tpl_vars['footer']->value;?>

        
        <script src="../../libs/jquery/jquery.js"></script>  
        <script src="../../libs/bootstrap/js/bootstrap.js"></script> 
        <script src="../../libs/bootstrap/js/typeahead.js"></script>
        <script src="../../js/solicitudExamenJs/solicitudExamen.js"></script>      

    </body>   

</html><?php }} ?>