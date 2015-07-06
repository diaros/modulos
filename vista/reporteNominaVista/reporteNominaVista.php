<?php

session_start();
if (!isset($_SESSION['usuCodigo']) && !isset($_SESSION['usuLogin'])) {
    header("Location: ../../vista/logueoVista/logueoVista.php");
}

include '../../vista/general/componentesGenerales.php';
include '../../controlador/utilidades/utilidades.php';
include_once '../../controlador/reporteNominaControlador/reporteNominaControl.php';

$utilidades = new utilidades();
$consutaEmpInt = $utilidades->consultarEmpInterna();
$ciudades = $utilidades->consultarSucursales();

$smarty->assign("ciudades", $ciudades, true);
$smarty->assign("empresaInterna", $consutaEmpInt, true);
$smarty->assign("empresaCliente", $clientes, true);
$smarty->display('../../web/reporteNominaWeb/reporteNomina.html.tpl');
?>
