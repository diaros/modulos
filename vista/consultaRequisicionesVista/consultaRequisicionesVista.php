<?php

session_start();

if (!isset($_SESSION['usuCodigo']) && !isset($_SESSION['usuLogin'])) {

    header("Location: ../../vista/logueoVista/logueoVista.php");
}

include '../../vista/general/componentesGenerales.php';
include '../../controlador/consultaRequisicionesControlador/consultaRequisicionesControlador.php';
include '../../controlador/utilidades/utilidades.php';

$consultaControlador = new consultaRequisicionesControlador();
$utilidades = new utilidades();
$reporte = '';
$mostrarTabla = "none";

$mostrarMsj = "none";
$msjError = "none";

$estados = $utilidades->consultaEstadosReq();

if (isset($_POST['accion']) && $_POST['accion'] == 'Consultar'){

    $idUser = $_SESSION['usuCodigo'];
    $fechaIni = $_POST['fechaIni'];
    $fechaFin = $_POST['fechaFin'];
    $estado = $_POST['estado'];

    $reporte = $consultaControlador->consultarReq($idUser, $fechaIni, $fechaFin, $estado);
    
    if($reporte != null){
        
        $mostrarTabla = "block";
        
    }
    
    if($reporte === null){
        
        $mostrarMsj = "block";
        $msjError = ":( No existen registros con los parametros ingresados.";
        
    }
   
}

$smarty->assign('mostrarMsj', $mostrarMsj, true);
$smarty->assign('msjError', $msjError, true);
$smarty->assign("mostrarTabla",$mostrarTabla,true);
$smarty->assign("reporte", $reporte, true);
$smarty->assign("estados", $estados, true);
$smarty->assign("empresaInterna", $consutaEmpInt, true);
$smarty->display('../../web/consultaRequisicionesWeb/consultaRequisicionesWeb.html.tpl');

?>


