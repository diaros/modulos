<!DOCTYPE html>
<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="text/css" href="../../libs/bootstrap/css/bootstrap.css" rel="stylesheet" />
        <link type="text/css" href="../../libs/font-awesome-4.2.0/css/font-awesome.css" rel="stylesheet" />
        <link type="text/css" href="../../css/estilosGenerales/estilosGeneralesCss.css" rel="stylesheet"/>        

        <title>DashBoard</title>

    </head>


    <body>

        {$cabecera} 
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
                            {* <a href="#">
                            <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                            </div>
                            </a>*}
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
                            {* <a href="#">
                            <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                            </div>
                            </a>*}
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
        {$footer}


    </body>

    <script src="../../libs/jquery/jquery.js"></script>
    <script src="../../libs/bootstrap/js/bootstrap.js"></script>
    <script src="../../libs/Chart.js-master/Chart.min.js"></script>
    <script src="../../js/dashBoardJs/dashBoardJs.js"></script>


</html>