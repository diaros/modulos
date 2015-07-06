<?php /* Smarty version Smarty-3.1.13, created on 2015-05-06 15:53:09
         compiled from "..\..\web\soporteWeb\soporte.html.tpl" */ ?>
<?php /*%%SmartyHeaderCode:339755143102b3e225-56159365%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1b08a67c8a388ec0e3e22824dc1623a195e9878b' => 
    array (
      0 => '..\\..\\web\\soporteWeb\\soporte.html.tpl',
      1 => 1428963118,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '339755143102b3e225-56159365',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_55143102ba66e3_33030299',
  'variables' => 
  array (
    'cabecera' => 1,
    'footer' => 1,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55143102ba66e3_33030299')) {function content_55143102ba66e3_33030299($_smarty_tpl) {?><!DOCTYPE html>

<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" />
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet" /> 

        <title>Soporte</title>

    </head>

    <body>

        <?php echo $_smarty_tpl->tpl_vars['cabecera']->value;?>


        <div id="contenedor" class="container">

            <legend>Soporte</legend>            

            <form id="soporteForm" name="soporteForm" class="form-horizontal" action="../../vista/aprobacionExamenesVista/aprobacionExamenesVista.php" method="post" autocomplete="off">

                <div id="forma" class="well">

                    <div class="col-lg-12">

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="modulo">Modulo:</label>
                            <div class="col-md-3">
                                <select id="modulo" name="modulo" class="form-control">
                                    <option value=""></option>
                                   
                                    <option value="1">Contratos</option>
                                    <option value="2">Examenes Medicos</option>
                                   
                                </select>
                            </div>
                        </div>                                 

                    </div>
                                
                    <div class="col-lg-12">

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="descripcion">Descripción del problema</label>
                            <div class="col-md-10">                     
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="4" cols="1000"></textarea>
                            </div>
                        </div>
                        
                    </div>
                                
                    <div class="col-lg-12" id="botones">

                        <a type="button" id="enviar" value="Enviar" class="btn btn-primary" onclick="valVacios();">
                            <span class="glyphicon glyphicon-send">
                                
                            </span> Enviar
                        </a>
                        <a type="button" id="limpiar" value="limpiar" class="btn btn-danger" onclick="limpiar();">Limpiar</a>

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
        

        <?php echo $_smarty_tpl->tpl_vars['footer']->value;?>



    </body>  

    <script src="../../libs/jquery/jquery.js"></script>  
    <script src="../../libs/bootstrap/js/bootstrap.js"></script> 
    <script src="../../js/soporteJs/soporteJs.js"></script>
    

</html><?php }} ?>