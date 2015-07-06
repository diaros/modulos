<?php

session_start();
if (!isset($_SESSION['usuCodigo']) && !isset($_SESSION['usuLogin'])){
    header("Location: ../../vista/logueoVista/logueoVista.php");
}

include '../../vista/general/componentesGenerales.php';
include '../../controlador/utilidades/utilidades.php';
//include '../../controlador/solicitudExamenControlador/solicitudExamenControl.php';

$msjError = "none";
$mostrarMsj = "none";
$mostrarMsjExito = "none";
$msjExito = "";
$number = 0;
$mostrarConsulta = "none";
$mostrarConsultaExamen = "none";
$vlrRegActivo=0;
$idUser  = $_SESSION['usuCodigo'];

$utilidades = new utilidades();
//$solicitudExamen = new solicitudExamenControl();

$consutaEmpInt = $utilidades->consultarEmpInterna();
//$consultaCiudades = $utilidades->consultarSucursales();
$consultarLaboratorios = $utilidades->consultarLaboratorios();
$consultaCat = $utilidades->consultarCategoriasActivas();

$smarty->assign("mostrarMsjExito", $mostrarMsjExito,true);
$smarty->assign("msjExito", $msjExito, true);
$smarty->assign('mostrarMsj', $mostrarMsj, true);
$smarty->assign('msjError', $msjError, true);
$smarty->assign('mostrarConsulta',$mostrarConsulta,true);
$smarty->assign('mostrarConsultaExamen',$mostrarConsultaExamen,true);

$smarty->assign("empresaInterna",$consutaEmpInt,true);
$smarty->assign("laboratorios",$consultarLaboratorios, true);
//$smarty->assign('ciudades',$consultaCiudades,true);
$smarty->assign('vlrRegActivo',$vlrRegActivo,true);
$smarty->assign('idUserLog',$idUser,true);
$smarty->assign('categorias',$consultaCat,true);

$smarty->display('../../web/solicitudExamenWeb/solicitudExamen.html.tpl');
?>

