<?php

session_start();
if(!isset($_SESSION['usuCodigo']) && !isset($_SESSION['usuLogin'])){
    
    header("Location: ../../vista/logueoVista/logueoVista.php");
    
}

include '../../vista/general/componentesGenerales.php';
include '../../controlador/utilidades/utilidades.php';
include '../../controlador/crearCentroCostoControlador/crearCentroCostoControl.php';

$msjError = "none";
$mostrarMsj = "none";
$mostrarMsjExito = "none";
$msjExito = "";
$number = 0;
$mostrarConsulta = "none";

$utilidades = new utilidades();
$crearCentroCosto = new crearCentroCostoControl();

$consutaEmpInt = $utilidades->consultarEmpInterna();
$consultaTipoFac = $utilidades->consultarTipoFacturacion();
$consultarCentrosCostos = $crearCentroCosto->consultarCentroCostos();

$smarty->assign("mostrarMsjExito", $mostrarMsjExito,true);
$smarty->assign("msjExito", $msjExito, true);
$smarty->assign('mostrarMsj', $mostrarMsj, true);
$smarty->assign('msjError', $msjError, true);
//$smarty->assign('mostrarConsulta',$mostrarConsulta,true

$smarty->assign("empresaInterna",$consutaEmpInt,true);
$smarty->assign("tipoFacs",$consultaTipoFac,true);
$smarty->assign("centroCostos",$consultarCentrosCostos,true);

$smarty->display('../../web/crearCentroCostoWeb/crearCentroCosto.html.tpl');

?>

