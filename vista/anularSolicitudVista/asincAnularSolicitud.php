<?php

session_start();

include '../../controlador/anularSolicitudControlador/anularSolicitudControl.php';

$anularOrden = new anularSolicitudcontrol();

if (isset($_POST['accion']) && $_POST['accion'] == 'consultarOrden') {

    $idOrden = $_POST['idOrden'];
    $idUser = $_SESSION['usuCodigo'];

    $resulConsulta = $anularOrden->consultarOrden($idOrden, $idUser);

    if ($resulConsulta == false) {

        echo ('-1');
        
    } else {
        
        echo json_encode($resulConsulta);
        
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'anularOrden') {

    $consOrden = $_POST['consOrden'];
    $idUser = $_SESSION['usuCodigo'];

    $resulConsultaOrden = $anularOrden->consultarOrden($consOrden, $idUser);

    if ($resulConsultaOrden != FALSE) {

        $estadoOrden = $resulConsultaOrden[0]['estado_orden'];

        if ($estadoOrden == 'En elaboracion' || $estadoOrden == 'Aprobado') {

            $resulAnular = $anularOrden->anularOrden($consOrden);

            if ($resulAnular == false) {

                echo ("-1");
                
            } else {

                echo ("1");
            }
        }else{
            
            echo '-2';
            
        }
    }
}
?>
