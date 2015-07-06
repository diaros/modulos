<?php

session_start();
if(!isset($_SESSION['usuCodigo']) && !isset($_SESSION['usuLogin'])){
    
    header("Location: ../../vista/logueoVista/logueoVista.php");
    
}

include '../../vista/general/componentesGenerales.php';
include '../../controlador/utilidades/utilidades.php';

$msjError = "none";
$mostrarMsj = "none";
$mostrarMsjExito = "none";
$msjExito = "";
$number = 0;

$utilidades = new utilidades();

$consultaCiudades = $utilidades->consultarSucursales();
$consultaLabs = $utilidades->consultarLab();

$smarty->assign("number", $number, true);
$smarty->assign("mostrarMsjExito", $mostrarMsjExito, true);
$smarty->assign("msjExito", $msjExito, true);
$smarty->assign('mostrarMsj', $mostrarMsj, true);
$smarty->assign('msjError', $msjError, true);

$smarty->assign('ciudades',$consultaCiudades,true);
$smarty->assign('laboratorios',$consultaLabs,true);

$smarty->display('../../web/crearLaboratoriosWeb/crearLaboratorio.html.tpl');

?>



