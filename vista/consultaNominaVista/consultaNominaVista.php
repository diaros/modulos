<?php

session_start();
if (!isset($_SESSION['usuCodigo']) && !isset($_SESSION['usuLogin'])) {
    header("Location: ../../vista/logueoVista/logueoVista.php");
}

include '../../vista/general/componentesGenerales.php';
include '../../controlador/utilidades/utilidades.php';

$utilidades = new utilidades();
$consutaEmpInt = $utilidades->consultarEmpInterna();
$ciudades = $utilidades->consultarSucursales();
$estados = $utilidades->consultarEstadoNomina();

$mostrarTabla = "block";

$smarty->assign("mostrarTabla", $mostrarTabla, true);
$smarty->assign("ciudades", $ciudades, true);
$smarty->assign("empresaInterna", $consutaEmpInt, true);
$smarty->assign("empresaCliente", $clientes, true);
$smarty->assign("estados",$estados,true);
$smarty->display('../../web/consultaNominaWeb/consultaNomina.html.tpl');

?>
