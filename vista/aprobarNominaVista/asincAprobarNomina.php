<?php

include '../../controlador/aprobarNominaControlador/aprobarNominaControl.php';
include_once '../../controlador/utilidades/utilidades.php';

session_start();

$aprobarNominaControl = new aprobarNominaControl();
$utilidades = new utilidades();

if (isset($_POST['accion']) && $_POST['accion'] == 'consultarRegNomina') {

    $empInt = $_POST['empInt'];
    $empCli = $_POST['empCli'];
    $centroCosto = $_POST['centrocosto'];
    $ciudad = $_POST['ciudad'];
    $fechaIni = $_POST['fechaIni'];
    $fechaFin = $_POST['fechaFin'];
    $estado = $_POST['estado'];

    $reporte = $aprobarNominaControl->consultaRegNomina($empInt, $empCli, $centroCosto, $ciudad, $estado, $fechaIni, $fechaFin);

    if ($reporte != false) {

        echo json_encode($reporte);
    } else if ($reporte == null) {

        echo '0';
    } else if ($reporte == false) {

        echo '-1';
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'aprobarSolicitudes') {

    $regNom = $_POST['regNomina'];
    
    $inicioTranc = $utilidades->iniciarTransaccion();
    
    if($inicioTranc != false){
        
        $resAprobacionNominas = $aprobarNominaControl->aprobarNomina($regNom);

        if ($resAprobacionNominas == true) {
            
            $resCommit = $utilidades->commitTransaccion();
            
            if($resCommit != false){                
                 echo '1';                 
            }else {                
                echo '-1';
            }          

        } else {            
            $utilidades->rollbackTransaccion();
            echo '-1';
        }        
        
    }    
}

?>

