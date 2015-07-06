<?php

include '../../controlador/dashBoardControlador/dashBoardControlador.php';

$dashBoardControl = new dashBoardControlador();

if (isset($_POST['accion']) && $_POST['accion'] == 'contratosxMes') {

    $reporte = $dashBoardControl->totalContratosMes();

    if ($reporte != null) {

        echo (json_encode($reporte));
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'estadoReq') {


    $reporte = $dashBoardControl->estadoReq();


    if ($reporte != null) {

        echo (json_encode($reporte));
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'contratosxEmpresa') {

    $reporte = $dashBoardControl->contratosxEmpresa();


    if ($reporte != null) {

        echo (json_encode($reporte));
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'contratosxTipo') {

    $reporte = $dashBoardControl->contratosxTipo();


    if ($reporte != null) {

        echo (json_encode($reporte));
    }
}
?>
