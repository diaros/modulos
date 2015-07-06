<?php

session_start();
if(!isset($_SESSION['usuCodigo']) && !isset($_SESSION['usuLogin'])){
    
    header("Location: ../../vista/logueoVista/logueoVista.php");
    
}

include '../../vista/general/componentesGenerales.php';
require '../../controlador/aprobacionExamenesControlador/aprobacionExamenesControlador.php';

$flgErrorActualizacion = "";
$mostrarMsj = "none";
$mostrarMsjExito = "none";
$msjExito = "";
$mostraConsulta = "none";
$msjError = "none";
$mostrarBtn = "none";
$fechaIni = "";
$fechaFin = "";
$paginaPrev = 1;
$paginaPos = 2;
$paginador = "";
$registrosxPag = 15;
$paginaActual = '';
$reporte = '';
$cedula = '';
$estado = '';
$idSolicitud = '';
$i = 1;
$number = 0;
$condicionDinamica = '';
$aprobacionExamsControl = new aprobacionExamenesControl();
$idUser = $_SESSION['usuCodigo'];

if (isset($_POST['accion']) && $_POST['accion'] == "Consultar") {

    $fechaIni = $_POST['fechaIni'];
    $fechaFin = $_POST['fechaFin'];
    $cedula = $_POST['cedula'];
    $estado = $_POST['estado'];
    $idSolicitud = $_POST['solicitud'];
    
    $inicio = 0;
    $paginador = Array();
    
    if($idSolicitud != ''){
        
        $condicionDinamica = $condicionDinamica." and a.id_solicitud_examen = '".$idSolicitud."' ";
    }

    if ($fechaIni != '' && $fechaFin != '') {

        $condicionDinamica = $condicionDinamica . " and a.fecha_proceso BETWEEN '" . $fechaIni . "' and '" . $fechaFin . "' ";
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

    $consultaRegistros = $aprobacionExamsControl->totalRegistros($condicionDinamica,$idUser);
    $totalRegistros = $consultaRegistros[0]['totalReg'];
    $totalPaginas = ceil($totalRegistros / $registrosxPag);

    if ($totalRegistros > 0) {

        $mostraConsulta = 'block';
        $mostrarBtn = 'in-line';

        if ($totalPaginas > 10){

            for ($i = 1; $i <= 10; $i++) {

                $paginador[]['pagina'] = $i;
            }
            
        } else {

            for ($i = 1; $i <= $totalPaginas; $i++){

                $paginador[]['pagina'] = $i;
            }
        }

        $reporte = $aprobacionExamsControl->consultarExamenes($condicionDinamica, $inicio, $registrosxPag,$idUser);
        
    } else {

        $mostraConsulta = 'none';
        $mostrarMsj = "block";
        $msjError = ":( No existen registros con los parametros ingresados.";
    }
}

if (isset($_GET['accion']) && $_GET['accion'] == 'Consultar') {

    $fechaIni = $_GET['fechaIni'];
    $fechaFin = $_GET['fechaFin'];
    $cedula = $_GET['cedula'];
    $estado = $_GET['estado'];
    $idSolicitud = $_GET['solicitud'];
    $idUser = $_GET['usuElab'];
    $paginaActual = $_GET['pagina'];
    $condicionDinamica = '';   
   
    $registrosxPag = 15;
    $inicio = 0;
    $paginador = Array();
    
    if($idSolicitud != ''){
        
        $condicionDinamica = $condicionDinamica." and a.id_solicitud_examen = '".$idSolicitud."' ";
    }

    if ($fechaIni != '' && $fechaFin != '') {

        $condicionDinamica = $condicionDinamica . " and a.fecha_proceso BETWEEN '" . $fechaIni . "' and '" . $fechaFin . "' ";
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

    $consultaRegistros = $aprobacionExamsControl->totalRegistros($condicionDinamica,$idUser);
    $totalRegistros = $consultaRegistros[0]['totalReg'];
    $totalPaginas = ceil($totalRegistros / $registrosxPag);

    if ($totalRegistros > 0) {

        $mostraConsulta = 'block';
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

        $reporte = $aprobacionExamsControl->consultarExamenes($condicionDinamica, $inicio, $registrosxPag,$idUser);
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'Ejecutar') {

    $iniciodeTransaccion = $aprobacionExamsControl->inicioTransaccion();

    if ($iniciodeTransaccion != false) {

        foreach ($_POST as $pos => $valor) {

            if (isset($_POST['estado' . $i]) && $_POST['estado' . $i] == 'on') {

                $idItem = $_POST['idItem' . $i];
                
                if($_POST['apto'.$i] == 1){
                    
                    $apto = 1;
                    
                }else if($_POST['apto'.$i] == 0){
                    
                    $apto = 0;
                    
                }

                $resulActEstadoItem = $aprobacionExamsControl->actualizarEstadoItem($idItem,$apto);

                if ($resulActEstadoItem == false) {

                    $flgErrorActualizacion = true;
                }
            }

            $i++;
        }

        if ($flgErrorActualizacion == true) {

            $aprobacionExamsControl->rollbackTransaccion();

            $msjError = ":( Ha ocurrido un error en la base de datos. Por favor vuelva a intentar la operacion. Si el problema persiste por favor informelo al area de desarrollo.";
            $mostrarMsj = "block";
        } else {

            $commitTransaccion = $aprobacionExamsControl->commitTransaccion();

            if ($commitTransaccion == false) {

                $msjError = ":( Ha ocurrido un error en la base de datos. Por favor vuelva a intentar la operacion. Si el problema persiste por favor informelo al area de desarrollo.";
                $mostrarMsj = "block";
            } else {

                $msjExito = ":) Los registros se han actualizado exitosamente.";
                $mostrarMsjExito = "block";
            }
        }
    } else {

        $msjError = ":( Ha ocurrido un error en la base de datos. Por favor vuelva a intentar la operacion. Si el problema persiste por favor informelo al area de desarrollo.";
        $mostrarMsj = "block";
    }
}


$smarty->assign('idSolicitud',$idSolicitud,true);
$smarty->assign("paginaAct",$paginaActual,true);
$smarty->assign("cedula", $cedula, true);
$smarty->assign("estado", $estado, true);
$smarty->assign("mostrarMsjExito", $mostrarMsjExito, true);
$smarty->assign("msjExito", $msjExito, true);
$smarty->assign("number", $number, true);
$smarty->assign("mostrarBtn", $mostrarBtn, true);
$smarty->assign("fechaIni", $fechaIni, true);
$smarty->assign("fechaFin", $fechaFin, true);
$smarty->assign("usuElab",$idUser,true);
$smarty->assign("paginador", $paginador, true);
$smarty->assign("paginaPrev", $paginaPrev, true);
$smarty->assign("paginaPos", $paginaPos, true);
$smarty->assign('msjError', $msjError, true);
$smarty->assign('reporte', $reporte, true);
$smarty->assign('mostrarMsj', $mostrarMsj, true);
$smarty->assign('mostrarConsulta', $mostraConsulta, true);
$smarty->display('../../web/aprobacionExamenesWeb/aprobacionExamenes.html.tpl');

?>