<?php

include_once '../../controlador/gestionRequisicionesControlador/gestionRequisicionesControlador.php';
include_once '../../controlador/utilidades/utilidades.php';

$utilidades = new utilidades();

if (isset($_POST['accion']) && $_POST['accion'] == 'prestamo') {

    session_start();
    $gestionReqControl = new gestionRequisicionesControlador();

    $usuCodigo = $_SESSION['usuCodigo'];
    $idReg = $_POST['idReg'];
    $idProceso = $_POST['idProceso'];
    $fechaPres = date('Y-m-d');
    $observacion = $_POST['observacion'];

    $begin = $utilidades->iniciarTransaccion();

    if ($begin != false) {

        $resulPrestamo = $gestionReqControl->prestamoReq($usuCodigo, $idReg, $idProceso, $fechaPres,$observacion);

        if ($resulPrestamo != null) {

            $resulComiit = $utilidades->commitTransaccion();

            if ($resulComiit != false) {

                echo("1");
                
            } else {

                echo("-1");
            }
            
        } else {
            
            $utilidades->rollbackTransaccion();
            echo("-1");
        }
    } else {

        echo("-1");
    }
}
?>

