<?php /* Smarty version Smarty-3.1.13, created on 2015-03-26 11:13:10
         compiled from "..\..\web\ayudaWeb\ayuda.html.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14780551430160e9919-10760478%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '487e598469822aee80a188cbf3fefaf59be1c754' => 
    array (
      0 => '..\\..\\web\\ayudaWeb\\ayuda.html.tpl',
      1 => 1427386021,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14780551430160e9919-10760478',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cabecera' => 1,
    'footer' => 1,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5514301678a3d3_92490896',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5514301678a3d3_92490896')) {function content_5514301678a3d3_92490896($_smarty_tpl) {?><!DOCTYPE html>

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

        
        <div id="contenedor">
            
            <legend>Soporte</legend>
            
            
            <form id="aprobacionExamenesForm" name="aprobacionExamenesForm" class="form-horizontal" action="../../vista/aprobacionExamenesVista/aprobacionExamenesVista.php" method="post" autocomplete="off">
                
                <div id="forma" class="well">
                    
                    
                    
                </div>                     
                
            </form>           
             
        </div>
         
        <?php echo $_smarty_tpl->tpl_vars['footer']->value;?>

                
        
    </body>  
    
</html><?php }} ?>