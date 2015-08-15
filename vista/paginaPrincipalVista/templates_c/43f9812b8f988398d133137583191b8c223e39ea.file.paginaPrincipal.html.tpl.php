<?php /* Smarty version Smarty-3.1.13, created on 2015-08-14 09:15:50
         compiled from "..\..\web\paginaPrincipalWeb\paginaPrincipal.html.tpl" */ ?>
<?php /*%%SmartyHeaderCode:29494539a2910077106-40115473%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '43f9812b8f988398d133137583191b8c223e39ea' => 
    array (
      0 => '..\\..\\web\\paginaPrincipalWeb\\paginaPrincipal.html.tpl',
      1 => 1439561737,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '29494539a2910077106-40115473',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_539a29101ca700_27179857',
  'variables' => 
  array (
    'cabecera' => 1,
    'footer' => 1,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_539a29101ca700_27179857')) {function content_539a29101ca700_27179857($_smarty_tpl) {?><!DOCTYPE html>

<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">       

        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet" />
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" />       
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet"/>
        <link type="text/css" href="../../css/paginaPrincipalCss/paginaPrincipalCss.css" rel="stylesheet"/>
        <link type="text/css" href="../../libs/wow/css/animate.css" rel="stylesheet"/>

        <title>Pagina principal</title>

    </head>

    <body>

        <?php echo $_smarty_tpl->tpl_vars['cabecera']->value;?>
     

        <div id="contenedorImgParallax" class="container-fluid">

            <div>              

                <div id="contenedorVideo">

                        <div id="textB" class="overlay wow fadeInUp" data-wow-offset="0" data-wow-delay="0.5s">                      
                            <h1 id="textBienvenida">Bienvenido a la intranet del grupo <span>Listos S.A.S</span></h1>              
                        </div>

                        <video id="the-video" class="videoPresentacion" loop="" autoplay="">
                            <source src="../../libs/videos/presentacion/5.mp4"/>
                        </video>           

                </div>        

                

            </div>

        </div>

        <div id="contenedorCita" class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="text-center">
                        <h2>Seleccion de modulos</h2>
                        <p>Por favor seleccione un modulo para cargar sus respectivas funcionalidades</p>
                    </div>
                    <hr>
                </div>
            </div>
        </div>

        <div class="container" id="contenedor">         

            

            <div id="info" class="col-lg-12">

                <div class="col-lg-6 wow bounceIn" data-wow-offset="0" data-wow-delay="0.4s">                

                    <i class="fa fa-user-md fa-5x"></i>
                    
                    <h2>
                        Examenes Medicos
                    </h2>

                    <p>
                        Modulo de solicitud, parametrización y facturacion de examenes medicos.
                    </p>

                    <p>
                        <a class="btn btn-primary btn-lg" onclick="ingresarModulo('6');">Ingresar</a>
                    </p>

                </div>

                <div class="col-lg-6 wow bounceIn" data-wow-offset="0" data-wow-delay="0.6s">
                    <i class="fa fa-file-text-o  fa-5x"></i>
                    
                    <h2>
                        Contratos
                    </h2>

                    <p>
                        Modulo de generacion y gestion de requisiciones y contratos.     
                    </p>

                    <p>
                        <a class="btn btn-danger btn-lg" onclick="ingresarModulo('10');">Ingresar</a>
                    </p>

                </div>

            </div>


            <div id="info2" class="col-lg-12">

                <div class="col-lg-6 wow bounceIn"  data-wow-offset="0" data-wow-delay="0.8s">
                    <i class="fa fa-calendar fa-5x"></i>
                    
                    <h2>
                        Nomina
                    </h2>

                    <p>
                        Modulo de reporte y gestion de novedades de nomina.     
                    </p>

                    <p>
                        <a class="btn btn-success btn-lg" onclick="ingresarModulo('8');">Ingresar</a>
                    </p>

                </div> 

                <div class="col-lg-6 wow bounceIn"  data-wow-offset="0" data-wow-delay="1.0s">
                    <i class="fa fa-shopping-cart fa-5x"></i>
                    
                    <h2>
                        Compras
                    </h2>

                    <p>
                        Modulo de solicitud y gestion de compras.     
                    </p>

                    <p>
                        <a class="btn btn-warning btn-lg" onclick="ingresarModulo('8');">Ingresar</a>
                    </p>

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


        <script src="../../libs/jquery/jquery.js"></script>
        <script src="../../libs/bootstrap/js/bootstrap.js"></script>
        <script src="../../js/paginaPrincipalJs/paginaPrincipalJs.js"></script>
        <script src="../../lib/parallax.js-1.3.1/parallax.min.js"></script>
        <script src="../../libs/wow/js/wow.min.js"></script>
        <script>
                            new WOW().init();
        </script>

    </body>



</html><?php }} ?>