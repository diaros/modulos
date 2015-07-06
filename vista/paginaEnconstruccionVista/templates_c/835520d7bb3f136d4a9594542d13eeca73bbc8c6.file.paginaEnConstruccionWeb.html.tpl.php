<?php /* Smarty version Smarty-3.1.13, created on 2015-01-26 16:33:41
         compiled from "..\..\web\paginaEnConstruccionWeb\paginaEnConstruccionWeb.html.tpl" */ ?>
<?php /*%%SmartyHeaderCode:226954c6b0de8b7c10-54677634%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '835520d7bb3f136d4a9594542d13eeca73bbc8c6' => 
    array (
      0 => '..\\..\\web\\paginaEnConstruccionWeb\\paginaEnConstruccionWeb.html.tpl',
      1 => 1422308015,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '226954c6b0de8b7c10-54677634',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54c6b0de954b15_76359553',
  'variables' => 
  array (
    'cabecera' => 1,
    'footer' => 1,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54c6b0de954b15_76359553')) {function content_54c6b0de954b15_76359553($_smarty_tpl) {?><!DOCTYPE html>
<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet" />
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.css" rel="stylesheet" />
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet"/>

        <title>Pagina en construccion</title>

    </head>

    <body>

        <?php echo $_smarty_tpl->tpl_vars['cabecera']->value;?>
 

        <div id="contenedor" class="container">

            <h1 style="margin-top: 150px;">Pagina en construccion...</h1>
            <p class="lead">Disculpe las molestias.</p>


        </div>
        
        <script src="../../libs/jquery/jquery.js"></script>
        <script src="../../libs/bootstrap/js/bootstrap.js"></script>
        <script src="../../libs/bootstrap/js/typeahead.js"></script>
        <?php echo $_smarty_tpl->tpl_vars['footer']->value;?>


    </body>        

</html><?php }} ?>