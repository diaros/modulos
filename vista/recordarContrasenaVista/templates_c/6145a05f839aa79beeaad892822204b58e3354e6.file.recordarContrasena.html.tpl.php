<?php /* Smarty version Smarty-3.1.13, created on 2014-08-13 08:33:42
         compiled from "..\..\web\recordarContrasenaWeb\recordarContrasena.html.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3539f3c9284bb33-29935470%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6145a05f839aa79beeaad892822204b58e3354e6' => 
    array (
      0 => '..\\..\\web\\recordarContrasenaWeb\\recordarContrasena.html.tpl',
      1 => 1402945497,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3539f3c9284bb33-29935470',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_539f3c929f7737_46850504',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_539f3c929f7737_46850504')) {function content_539f3c929f7737_46850504($_smarty_tpl) {?><!DOCTYPE html>

<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="../../libs/jquery/jquery.js"></script>  
        <script src="../../libs/bootstrap/js/bootstrap.js"></script>  
        <script src="../../js/recordarContrasenaJs/recordarContrasenaJs.js"></script>

        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet" />
        <link type="text/css" href="../../css/recordarContrasenaCss/recordarContrasenaCss.css" rel="stylesheet" />

        <title>Recordar contraseña</title>
    </head>

    <body>

        <div class="container">

            <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">

                <div class="panel panel-info" >

                    <div class="panel-heading">
                        <div class="panel-title">Recordar contraseña</div>
                    </div>     

                    <div id="panelBody" class="panel-body" >                        

                        <form id="loginform" class="form-horizontal" role="form" action="../../vista/recordarContrasenaVista/recordarContrasenaVista.php" autocomplete="off">

                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="usuario" type="text" class="form-control" name="usuario" value="" placeholder="Usuario">                                        
                            </div>

                            <div style="margin-top:10px" class="form-group">
                                <!-- Button -->

                                <div class="col-sm-12 controls">

                                    <a id="btn-login" href="#" class="btn btn-info btn-block" onclick="valVacios();">Enviar</a>
                                  

                                </div>
                            </div>
  
                        </form>
                    </div>                     
                </div>  
            </div>           

        </div>        

    </body>

</html><?php }} ?>