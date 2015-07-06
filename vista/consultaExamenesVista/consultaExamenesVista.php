<?php

session_start();
if (!isset($_SESSION['usuCodigo']) && !isset($_SESSION['usuLogin'])) {

    header("Location: ../../vista/logueoVista/logueoVista.php");
}

include '../../vista/general/componentesGenerales.php';
require '../../controlador/consultaExamenesControlador/consultaExamenesControl.php';

$mostrarMsj = "none";
$mostrarMsjExito = "none";
$msjExito = "";
$msjError = "none";
$mostrarConsulta = "none";
$reporte = "";
$paginador = "";
$paginaActual = '';
$empresaInt = "";
$cedula = '';
$mostrarBtnExcel="none";

$fechaIni = '';
$fechaFin = '';
$cliente = '';
$solIni = '';
$solFin = '';
$condicionDinamica = '';
$registrosxPag = 30;

$consultaExamenes = new consultaExamenesControl();

$empresaInterna = $consultaExamenes->consultarEmpInterna();
$empresaCli = $consultaExamenes->consultarClientes();

if (isset($_POST['accion']) && $_POST['accion'] == "Consultar") {

    $fechaIni = $_POST['fechaIni'];
    $fechaFin = $_POST['fechaFin'];
    $empresaInt = $_POST['empresaInt'];
    $cliente = $_POST['cliente'];
    $solIni = $_POST['solIni'];
    $solFin = $_POST['solFin'];
    $cedula = $_POST['cedula'];
    $estado = $_POST['estado'];

    $inicio = 0;
    $paginador = Array();

    if ($fechaIni != '' && $fechaFin != '') {

        $condicionDinamica = $condicionDinamica . " and a.fecha_proceso BETWEEN '" . $fechaIni . "' and '" . $fechaFin . "' ";
    }

    if ($empresaInt != '') {

        $condicionDinamica = $condicionDinamica . " and a.empresa = '" . $empresaInt . "'";
    }

    if ($cliente != '') {

        $condicionDinamica = $condicionDinamica . " and a.nit_cliente = '" . $cliente . "' ";
    }

    if ($solIni != '' and $solFin != '') {

        $condicionDinamica = $condicionDinamica . "and a.id_solicitud_examen BETWEEN " . $solIni . " and " . $solFin . " ";
    }
    
    if ($cedula != '') {

        $condicionDinamica = $condicionDinamica . " and b.cedula = '" . $cedula . "'";
    }
    
        if ($estado != '') {

            if ($estado == 0) {

                $condicionDinamica = $condicionDinamica . " and f.estado is null ";

            } else {

                $condicionDinamica = $condicionDinamica . " and f.estado = '" . $estado . "' ";
            }
    }

    $consultaRegistros = $consultaExamenes->consultarCantidadExamenes($condicionDinamica);
    $totalRegistros = $consultaRegistros[0]['totalReg'];
    $totalPaginas = ceil($totalRegistros / $registrosxPag);

    if ($totalRegistros > 0) {

        $mostrarConsulta = 'block';

        if ($totalPaginas > 10) {

            for ($i = 1; $i <= 10; $i++) {

                $paginador[]['pagina'] = $i;
            }
        } else {

            for ($i = 1; $i <= $totalPaginas; $i++) {

                $paginador[]['pagina'] = $i;
            }
        }

        $reporte = $consultaExamenes->consultarExamenes($condicionDinamica, $inicio, $registrosxPag);
        $mostrarBtnExcel = "inline";
    } else {

        $mostrarConsulta = 'none';
        $mostrarMsj = "block";
        $msjError = ":( No existen registros con los parametros ingresados.";
    }
}

if (isset($_GET['accion']) && $_GET['accion'] == 'Consultar') {

    $fechaIni = $_GET['fechaIni'];
    $fechaFin = $_GET['fechaFin'];
    $empresaInt = $_GET['empresaInt'];
    $cliente = $_GET['cliente'];
    $solIni = $_GET['solIni'];
    $solFin = $_GET['solFin'];
    $cedula = $_GET['cedula'];
    $estado = $_GET['estado'];
    $mostrarBtnExcel = "inline";
    
    $registrosxPag = 30;
    $inicio = 0;
    $paginador = Array();

   if ($fechaIni != '' && $fechaFin != '') {

        $condicionDinamica = $condicionDinamica . " and a.fecha_proceso BETWEEN '" . $fechaIni . "' and '" . $fechaFin . "' ";
    }

    if ($empresaInt != '') {

        $condicionDinamica = $condicionDinamica . " and a.empresa = '" . $empresaInt . "'";
    }

    if ($cliente != '') {

        $condicionDinamica = $condicionDinamica . " and a.cliente = '" . $cliente . "' ";
    }

    if ($solIni != '' and $solFin != '') {

        $condicionDinamica = $condicionDinamica . "and a.id_solicitud_examen BETWEEN " . $solIni . " and " . $solFin . " ";
    }
    
     if ($cedula != '') {

        $condicionDinamica = $condicionDinamica . " and b.cedula = '" . $cedula . "'";
    }
    
    if ($estado != '') {

        if ($estado == 0) {

            $condicionDinamica = $condicionDinamica . " and f.estado is null ";
            
        } else {

            $condicionDinamica = $condicionDinamica . " and f.estado = '" . $estado . "' ";
        }
    }

    $consultaRegistros = $consultaExamenes->consultarCantidadExamenes($condicionDinamica);
    $totalRegistros = $consultaRegistros[0]['totalReg'];
    $totalPaginas = ceil($totalRegistros / $registrosxPag);

    if ($totalRegistros > 0) {

        $mostrarConsulta = 'block';
        $mostrarBtn = 'in-line';

        if (isset($_GET["pagina"])) {

            $pagina = $_GET["pagina"];

            if ($pagina > 1) {
                $paginaPrev = $pagina - 1;
            } else if ($pagina == 1) {
                $paginaPrev = 1;
            }
            if ($pagina < $totalPaginas) {
                $paginaPos = $pagina + 1;
            } else if ($pagina == $totalPaginas) {
                $paginaPos = $totalPaginas;
            }
        }

        if (isset($pagina)) {
            $inicio = ($pagina - 1) * $registrosxPag;
        }

        if ($totalPaginas > 10) {

            $res = $pagina + 10;

            if ($res < $totalPaginas) {

                for ($i = $_GET['pagina']; $i <= ($_GET['pagina'] + 10); $i++) {
                    $paginador[]['pagina'] = $i;
                }
            } else {

                for ($i = $totalPaginas - 10; $i <= $totalPaginas; $i++) {
                    $paginador[]['pagina'] = $i;
                }
            }
        } else {

            for ($i = 1; $i <= $totalPaginas; $i++) {
                $paginador[]['pagina'] = $i;
            }
        }

        $reporte = $consultaExamenes->consultarExamenes($condicionDinamica, $inicio, $registrosxPag);
    }
}

$smarty->assign("estado", $estado, true);
$smarty->assign("cedula", $cedula, true);
$smarty->assign("empresaInt", $empresaInt, true);
$smarty->assign("cliente", $cliente, true);
$smarty->assign("solIni", $solIni, true);
$smarty->assign("solFin", $solFin, true);
$smarty->assign("fechaIni", $fechaIni, true);
$smarty->assign("fechaFin", $fechaFin, true);
$smarty->assign("paginador", $paginador, true);
$smarty->assign("paginaAct", $paginaActual, true);
$smarty->assign('empresaInterna', $empresaInterna, true);
$smarty->assign('empresaCli', $empresaCli, true);
$smarty->assign('reporte', $reporte, true);
$smarty->assign("mostrarConsulta", $mostrarConsulta, true);
$smarty->assign("mostrarBtnExcel",$mostrarBtnExcel,true);
$smarty->assign('mostrarMsj', $mostrarMsj, true);
$smarty->assign('msjError', $msjError, true);
$smarty->assign("mostrarMsjExito", $mostrarMsjExito, true);
$smarty->assign("msjExito", $msjExito, true);
$smarty->display('../../web/consultaExamenesWeb/consultaExamenes.html.tpl');
?>

