<?php /* Smarty version Smarty-3.1.13, created on 2015-02-27 12:08:55
         compiled from "..\..\web\dashboardWeb\dashboardWeb.html.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1639354ca4a723a72d3-07993847%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '79094d1bf8fcec266716ef3d9d754e39eb47ed9b' => 
    array (
      0 => '..\\..\\web\\dashboardWeb\\dashboardWeb.html.tpl',
      1 => 1425055582,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1639354ca4a723a72d3-07993847',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54ca4a7244fd08_74285170',
  'variables' => 
  array (
    'cabecera' => 1,
    'footer' => 1,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ca4a7244fd08_74285170')) {function content_54ca4a7244fd08_74285170($_smarty_tpl) {?><!DOCTYPE html>
<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet" />
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.css" rel="stylesheet" />
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet"/>        

        <title>DashBoard</title>

    </head>


    <body>

        <?php echo $_smarty_tpl->tpl_vars['cabecera']->value;?>
 
        <div id="contenedor" class="container">
            <h1 style="text-align: center; margin-top: 30px;">Requisiciones</h1>
            <hr>
            <form id="dashBoardForm" name="dashBoardForm" class="form-horizontal" action="../../vista/dashBoardVista/dashBoardVista.php" method="post" autocomplete="off">

                <div class="row" >                   
                    
                    <div class="col-lg-3 col-md-6">

                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-folder-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div id="totalReq" class="huge numeroInfo"></div>
                                        <div>Total</div>
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
                                        <i class="fa fa-folder-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div id="reqArchivadas" class="huge numeroInfo"></div>
                                        <div>Archivadas / Prestamo</div>
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
                                        <i class="fa fa-folder-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div id="reqAceptadas" class="huge numeroInfo"></div>
                                        <div>Aceptadas</div>
                                    </div>
                                </div>
                            </div>
                       
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-folder-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div id="reqDevueltas" class="huge numeroInfo"></div>
                                        <div>Devueltas</div>
                                    </div>
                                </div>
                            </div>
                     
                        </div>
                    </div>
                </div>
                <!-- /.row -->       

                <hr>

                <div class="row" >

                    <div class="col-lg-6">

                        <div class="panel panel-primary">

                            <div class="panel-heading">
                                <h3 class="panel-title">Estado Requisiciones</h3>
                            </div>

                            <div class="panel-body">

                                <div class="col-lg-6">

                                    <canvas id="estadoContratos" width="435" height="552"></canvas>

                                </div>

                            </div>



                        </div> 

                    </div>       

                    <div class="col-lg-6">
                        
                        <div class="panel panel-primary">

                            <div class="panel-heading">
                                <h3 class="panel-title">Estado Requisiciones</h3>
                            </div>

                            <div class="panel-body">

                                <div class="col-lg-6">

                                    <canvas id="estadoContratos2" width="435" height="552"></canvas>

                                </div>
                            </div>
                            
                        </div> 

                    </div>   

                </div>                
                
                 <h1 style="text-align: center;">Contratos</h1>
                <hr>
                 <div class="row" >                   
                    
                    <div class="col-lg-3 col-md-6">

                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div id="totalContratos" class="huge numeroInfo"></div>
                                        <div>Total Contratos</div>
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
                                        <i class="fa fa-file-text-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div id="contratosListos" class="huge numeroInfo"></div>
                                        <div>Listos</div>
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
                                        <i class="fa fa-file-text-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div id="contratosTercerizar" class="huge numeroInfo"></div>
                                        <div>Tercerizar</div>
                                    </div>
                                </div>
                            </div>
                       
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div id="contratosVyM" class="huge numeroInfo"></div>
                                        <div>Vision y Marketing</div>
                                    </div>
                                </div>
                            </div>
                     
                        </div>
                    </div>
                </div>
                <!-- /.row --> 
                

                <div class="row" >

                    <div class="panel panel-primary">

                        <div class="panel-heading">
                            <h3 class="panel-title">Contratos vs Mes</h3>
                        </div>

                        <div class="panel-body">
                            <div class="col-lg-12">

                                <canvas id="contratosMes" width="1130" height="552"></canvas>

                            </div>
                        </div>

                    </div>  

                </div>
                
                <hr>
                
                    <div class="row" >

                    <div class="col-lg-6">

                        <div class="panel panel-primary">

                            <div class="panel-heading">
                                <h3 class="panel-title">Contratos por empresa</h3>
                            </div>

                            <div class="panel-body">

                                <div class="col-lg-6">

                                    <canvas id="contratosxEmpresa" width="435" height="552"></canvas>

                                </div>

                            </div>

                        </div> 

                    </div>       

                    <div class="col-lg-6">
                        
                        <div class="panel panel-primary">

                            <div class="panel-heading">
                                <h3 class="panel-title">Contratos por tipo</h3>
                            </div>

                            <div class="panel-body">

                                <div class="col-lg-6">

                                    <canvas id="contratosxTipo" width="435" height="552"></canvas>

                                </div>
                            </div>

                        </div> 

                    </div>   

                </div>

            </form>

        </div>
        <?php echo $_smarty_tpl->tpl_vars['footer']->value;?>



    </body>

    <script src="../../libs/jquery/jquery.js"></script>
    <script src="../../libs/bootstrap/js/bootstrap.js"></script>
    <script src="../../libs/Chart.js-master/Chart.min.js"></script>
    <script src="../../js/dashBoardJs/dashBoardJs.js"></script>


</html><?php }} ?>