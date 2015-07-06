<?php

session_start();
if (!isset($_SESSION['usuCodigo']) && !isset($_SESSION['usuLogin'])){
    header("Location: ../../vista/logueoVista/logueoVista.php");
}

include '../../vista/general/componentesGenerales.php';
include '../../controlador/utilidades/utilidades.php';

$utilidades = new utilidades();

$consutaEmpInt = $utilidades->consultarEmpInterna();
$ciudades = $utilidades->consultarSucursales();
$conceptosCompra = $utilidades->consultarConceptosCompra();

$smarty->assign("conceptosCompra",$conceptosCompra,true);
$smarty->assign("ciudades",$ciudades,true);
$smarty->assign("empresaInterna",$consutaEmpInt,true);
$smarty->display('../../web/solicitudCompraWeb/solicitudCompra.html.tpl');

?>
