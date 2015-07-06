<?php

session_start();
if (!isset($_SESSION['usuCodigo']) && !isset($_SESSION['usuLogin'])) {
    header("Location: ../../vista/logueoVista/logueoVista.php");
}

include '../../vista/general/componentesGenerales.php';
include '../../controlador/utilidades/utilidades.php';

$idUser  = $_SESSION['usuCodigo'];
$msjError = "none";
$mostrarMsj = "none";
$mostrarMsjExito = "none";
$msjExito = "";

$smarty->assign("mostrarMsjExito", $mostrarMsjExito,true);
$smarty->assign("msjExito", $msjExito, true);
$smarty->assign('mostrarMsj', $mostrarMsj, true);
$smarty->assign('msjError', $msjError, true);

$smarty->assign('idUserLog',$idUser,true);

$smarty->display('../../web/ejecutarSPWeb/ejecutarSPWeb.html.tpl');
?>
