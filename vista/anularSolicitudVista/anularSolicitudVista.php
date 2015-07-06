<?php

session_start();
if (!isset($_SESSION['usuCodigo']) && !isset($_SESSION['usuLogin'])) {
    header("Location: ../../vista/logueoVista/logueoVista.php");
}

include '../../vista/general/componentesGenerales.php';
include_once '../../controlador/utilidades/utilidades.php';
require '../../controlador/anularSolicitudControlador/anularSolicitudControl.php';

$msjError = "none";
$mostrarMsjExito = "none";
$msjExito = "";
$number = 0;
$mostrarBtn = "none";

$paginaPrev = 1;
$paginaPos = 2;
$paginador = "";
$registrosxPag = 15;
$paginaActual = '';
$reporte = '';
$mostrarMsj = "none";
$mostrarConsulta = "none";

$idUser = $_SESSION['usuCodigo'];

$anularOrden = new anularSolicitudcontrol();
$utilidades = new utilidades();

/* * \brief Accion para consultar solicitudes */
if (isset($_POST['accion']) && $_POST['accion'] == 'Consultar') {

    $idSolicitud = $_POST['consOrden'];

    /**
      \details esta accion se encargar de consultar las solicitudes
      \param $_POST['accion'] define el tipo de acccion a realizar
      \param idSolicitud parametro opcional si se quiere consultar un solicitud por su id.
     */
    $inicio = 0;
    $paginador = Array();

    if ($idSolicitud != '') {

        $condicionDinamica = $condicionDinamica . " and a.id_solicitud_examen = '" . $idSolicitud . "' ";
    }

    $consultaRegistros = $anularOrden->totalRegistrosAnular($condicionDinamica, $idUser);
    $totalRegistros = $consultaRegistros[0]['totalReg'];
    $totalPaginas = ceil($totalRegistros / $registrosxPag);

    if ($totalRegistros > 0) {

        $mostraConsulta = 'block';
        $mostrarBtn = 'in-line';

        if ($totalPaginas > 10) {

            for ($i = 1; $i <= 10; $i++) {

                $paginador[]['pagina'] = $i;
            }
        } else {

            for ($i = 1; $i <= $totalPaginas; $i++) {

                $paginador[]['pagina'] = $i;
            }
        }

        $reporte = $anularOrden->consultarExamenesAnular($condicionDinamica, $inicio, $registrosxPag, $idUser);
    } else {

        $mostraConsulta = 'none';
        $mostrarMsj = "block";
        $msjError = ":( No existen registros con los parametros ingresados.";
    }
}

/* * \brief Accion para consultar solicitudes usando el paginador */
if (isset($_GET['accion']) && $_GET['accion'] == 'Consultar') {

    $idSolicitud = $_GET['consOrden'];
    $condicionDinamica = '';
    $paginaActual = $_GET['pagina'];
    $idUser = $_GET['usuElab'];

    /**
    \details esta accion se encargar de consultar las solicitudes usando el paginador
    \param idSolicitud parametro opcional si se quiere consultar un solicitud por su id.
    \param $_POST['accion'] define el tipo de acccion a realizar
    \param paginaActual indica la pagina actual en la que se encuentra
    \param idUser id del usuario que esta realizando la consulta
    */
    $registrosxPag = 15;
    $inicio = 0;
    $paginador = Array();

    if ($idSolicitud != '') {

        $condicionDinamica = $condicionDinamica . " and a.id_solicitud_examen = '" . $idSolicitud . "' ";
    }

    $consultaRegistros = $anularOrden->totalRegistrosAnular($condicionDinamica, $idUser);
    $totalRegistros = $consultaRegistros[0]['totalReg'];
    $totalPaginas = ceil($totalRegistros / $registrosxPag);

    if ($totalRegistros > 0) {

        $mostraConsulta = 'block';
        $mostrarBtn = 'in-line';

        if ($totalPaginas > 10) {

            for ($i = 1; $i <= 10; $i++) {

                $paginador[]['pagina'] = $i;
            }
        } else {

            for ($i = 1; $i <= $totalPaginas; $i++) {

                $paginador[]['pagina'] = $i;
            }
        }

        $reporte = $anularOrden->consultarExamenesAnular($condicionDinamica, $inicio, $registrosxPag, $idUser);
    } else {

        $mostraConsulta = 'none';
        $mostrarMsj = "block";
        $msjError = ":( No existen registros con los parametros ingresados.";
    }
}

/* * \brief Accion para anular una solicitud*/
if (isset($_POST['accion']) && $_POST['accion'] == 'Anular') {

    $i = 1;
    $flgError = false;
    
    /**
    \details esta accion se encargar de consultar las solicitudes usando el paginador 
    \param $_POST['accion'] se encangar la accion a ejecutar.
    */

    $inicioTransac = $utilidades->iniciarTransaccion();

    if ($inicioTransac != false) {

        foreach ($_POST as $pos => $valor) {

            if (isset($_POST['estado' . $i]) && $_POST['estado' . $i] == 'on') {

                $idReg = $_POST['idReg' . $i];

                $resulAnular = $anularOrden->anularOrden($idReg);

                if ($resulAnular == false) {

                    $flgError = true;
                }
            }

            $i++;
        }
    }

    if ($flgError == true) {

        $utilidades->rollbackTransaccion();
        $msjError = ":( Ha ocurrido un error en la base de datos. Por favor vuelva a intentar la operacion. Si el problema persiste por favor informelo al area de desarrollo.";
        $mostrarMsj = "block";
    } else {

        $utilidades->commitTransaccion();
        $msjExito = ":) Los registros se han anulado exitosamente.";
        $mostrarMsjExito = "block";
    }
}

$smarty->assign("mostrarMsjExito", $mostrarMsjExito, true);
$smarty->assign("msjExito", $msjExito, true);
$smarty->assign('mostrarMsj', $mostrarMsj, true);
$smarty->assign('msjError', $msjError, true);

$smarty->assign("paginador", $paginador, true);
$smarty->assign("paginaPrev", $paginaPrev, true);
$smarty->assign("paginaPos", $paginaPos, true);
$smarty->assign('msjError', $msjError, true);
$smarty->assign('reporte', $reporte, true);
$smarty->assign('mostrarMsj', $mostrarMsj, true);
$smarty->assign('mostrarConsulta', $mostraConsulta, true);
$smarty->assign("paginaAct", $paginaActual, true);
$smarty->assign('idSolicitud', $idSolicitud, true);
$smarty->assign("usuElab", $idUser, true);

$smarty->assign("mostrarBtn", $mostrarBtn, true);

$smarty->display('../../web/anularSolicitudWeb/anularSolicitud.html.tpl');
?>

