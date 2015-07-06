<?php

session_start();

if (!isset($_SESSION['usuCodigo']) && !isset($_SESSION['usuLogin'])) {

    header("Location: ../../vista/logueoVista/logueoVista.php");
}

include '../../vista/general/componentesGenerales.php';
include '../../controlador/utilidades/utilidades.php';
include '../../controlador/gestionRequisicionesControlador/gestionRequisicionesControlador.php';

$utilidades = new utilidades();
$gestionReqControl = new gestionRequisicionesControlador();

$mostrarMsj = "none";
$msjError = "";

$mostrarMsjExito = "none";
$msjExito = "";

$mostrarTabla = "none";
$reporte = '';
$consutaEmpInt = $utilidades->consultarEmpInterna();
$procesos = $utilidades->consultaProcesos();
$estados = $gestionReqControl->consultaEstadosReq();

$fechaIni = '';
$fechaFin = '';
$idEmpInt = '';
$numReq = '';
$idUser = '';
$estado = '';

if (isset($_POST['accion']) && $_POST['accion'] == 'Consultar') {

    $idUser = $_SESSION['usuCodigo'];
    $fechaIni = $_POST['fechaIni'];
    $fechaFin = $_POST['fechaFin'];
    $idEmpInt = $_POST['empresaInt'];
    $numReq = $_POST['requisicion'];
    $idUser = $_POST['idUser'];
    $estado = $_POST['estado'];

    $reporte = $gestionReqControl->consultarReq($fechaIni, $fechaFin,$idEmpInt,$numReq,$idUser,$estado);

    if ($reporte != null) {

        $mostrarTabla = "block";
    }

    if ($reporte === null) {

        $mostrarMsj = "block";
        $msjError = ":( No existen registros con los parametros ingresados.";
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'Aceptar') {

    $flgError = false;
    $i = 1;
    $usuCodigo = $_SESSION['usuCodigo'];
    $fechaIni = $_POST['fechaIni'];
    $fechaFin = $_POST['fechaFin'];
    $idEmpInt = $_POST['empresaInt'];
    $numReq = $_POST['requisicion'];
    $idUser = $_POST['idUser'];
    $estado = $_POST['estado'];
    $fechaAcp = date('Y-m-d H:i:s');

    $begin = $utilidades->iniciarTransaccion();

    if ($begin != false) {

        foreach ($_POST as $pos => $valor) {

            if (($_POST['aceptar' . $i]) == 'on') {

                $idReg = $_POST['idReg' . $i];

                $resAceptarReg = $gestionReqControl->aceptarRegistro($idReg, $usuCodigo, $fechaAcp);

                if ($resAceptarReg == null) {

                    $flgError = true;
                }
            }

            $i++;
        }

        if ($flgError == true) {

            $utilidades->rollbackTransaccion();
            $mostrarMsj = "block";
                $msjError = "Ha ocurrido un fallo iniciando la transaccion. Por favor vuelva a intentarlo, si el problema persiste comuniquese con el departamento de desarrollo.";
            
        } else {

            $commit = $utilidades->commitTransaccion();

            if ($commit == false) {

                $mostrarMsj = "block";
                $msjError = "Ha ocurrido un fallo iniciando la transaccion. Por favor vuelva a intentarlo, si el problema persiste comuniquese con el departamento de desarrollo.";
            }
            
           

           header("Location: http://192.168.1.203/Proyectos/ExamenesMedicos/vista/gestionRequisicionesVista/gestionRequisicionesVista.php?fechaIni=$fechaIni&fechaFin=$fechaFin&idEmpInt=$idEmpInt&numReq=$numReq&idUser=$idUser&estado=$estado&accion=postAceptar");
           //header("Location: http://192.168.1.203/Proyectos/ExamenesMedicos/vista/gestionRequisicionesVista/gestionRequisicionesVistax.php");
        }
    } else {

        $mostrarMsj = "block";
        $msjError = "Ha ocurrido un fallo iniciando la transaccion. Por favor vuelva a intentarlo, si el problema persiste comuniquese con el departamento de desarrollo.";
    }
}

if (isset($_GET['accion']) && $_GET['accion'] == 'postAceptar') {    
   

    $fechaIni = $_GET['fechaIni'];
    $fechaFin = $_GET['fechaFin'];
    $idEmpInt = $_GET['idEmpInt'];
    $numReq   = $_GET['numReq'];
    $idUser   = $_GET['idUser'];
    $estado = $_GET['estado'];
    
    $reporte = $gestionReqControl->consultarReq($fechaIni, $fechaFin,$idEmpInt,$numReq,$idUser,$estado);

    if ($reporte != null) {

        $mostrarTabla = "block";
        $mostrarMsjExito = "block";
        $msjExito = ":) Requisiciones archivadas";
    }

    if ($reporte === null) {

        $mostrarMsj = "block";
        $msjError = ":( No existen registros con los parametros ingresados.";
    }
}


$smarty->assign("estado",$estado,true);
$smarty->assign("idUser",$idUser,true);
$smarty->assign("numReq",$numReq,true);
$smarty->assign("idEmpInt",$idEmpInt,true);
$smarty->assign("fechaIni", $fechaIni, true);
$smarty->assign("fechaFin", $fechaFin, true);

$smarty->assign("estados", $estados, true);
$smarty->assign("reporte", $reporte, true);
$smarty->assign("procesos", $procesos, true);
$smarty->assign("empresaInterna", $consutaEmpInt, true);
$smarty->assign("mostrarTabla", $mostrarTabla, true);
$smarty->assign('mostrarMsj', $mostrarMsj, true);
$smarty->assign('msjError', $msjError, true);
$smarty->assign('mostrarMsjExito', $mostrarMsjExito, true);
$smarty->assign('msjExito', $msjExito, true);
$smarty->display('../../web/gestionRequisicionesWeb/gestionRequisicionesWeb.html.tpl');
?>

