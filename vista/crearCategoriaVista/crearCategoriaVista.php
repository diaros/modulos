<?php

session_start();
if(!isset($_SESSION['usuCodigo']) && !isset($_SESSION['usuLogin'])){
    
    header("Location: ../../vista/logueoVista/logueoVista.php");
    
}

include '../../vista/general/componentesGenerales.php';
include_once '../../controlador/utilidades/utilidades.php';

$msjError = "none";
$mostrarMsj = "none";
$mostrarMsjExito = "none";
$msjExito = "";
$mostrarConsulta = "none";
$number = 0;

$utilidades = new utilidades();
$categorias = $utilidades->consultarCategorias();

if($categorias != false){
    
    $mostrarConsulta = "block";
}

$smarty->assign("number",$number,true);
$smarty->assign("categorias",$categorias,true);
$smarty->assign("mostrarConsulta", $mostrarConsulta, true);
$smarty->assign("categorias", $categorias, true);
$smarty->assign("mostrarMsjExito", $mostrarMsjExito, true);
$smarty->assign("msjExito", $msjExito, true);
$smarty->assign('mostrarMsj', $mostrarMsj, true);
$smarty->assign('msjError', $msjError, true);
$smarty->display('../../web/crearCategoriaWeb/crearCategoria.html.tpl');

?>