<?php

session_start();
include_once '../../libs/Smarty-3.1.13/libs/Smarty.class.php';

$smarty = new Smarty();

$menu = $_SESSION['menu'];

$cabecera = '<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
				<div class="navbar-header">
					 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button> <a id="linkInicio" class="navbar-brand" href="../../vista/paginaPrincipalVista/paginaPrincipalVista.php">Inicio</a>
				</div>
                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				
				'.$menu.'
                               
                                <ul class="nav navbar-nav navbar-right">
                                   <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Cuenta <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="../../vista/soporteVista/soporteVista.php"><i class="fa fa-life-ring"></i> Soporte</a></li>
                                        <li><a href="../../vista/logueoVista/CerrarSesion.php"><i class="fa fa-ban"></i> Cerrar sesión </a></li>
                                    </ul>
                                  </li>
                                </ul>
                                
                                </div>
                                
				
            </nav>';

$arrayUsuario = explode('-', $_SESSION['usuNombres']);
$usuario = $arrayUsuario[0];

$footer = '<div id="footer" class="col-lg-12">    

                <hr>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="col-md-8">
                      <a href="../../vista/paginaEnconstruccionVista/paginaEnconstruccionVista.php">Termininos y condicones</a>    
                    </div>
                    <div class="col-md-4">
                      <p class="muted pull-right">© 2014 Vision y Marketing</p>
                    </div>
                  </div>
                </div>
                
            </div>';

$smarty->assign("nomUser",$usuario,true);
$smarty->assign("cabecera",$cabecera,true);
$smarty->assign("footer",$footer,true);
