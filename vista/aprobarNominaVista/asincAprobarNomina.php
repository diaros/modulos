<?php

include '../../controlador/aprobarNominaControlador/aprobarNominaControl.php';
include_once '../../controlador/utilidades/utilidades.php';

session_start();

$aprobarNominaControl = new aprobarNominaControl();
$utilidades = new utilidades();

if (isset($_POST['accion']) && $_POST['accion'] == 'consultarRegNomina') {

    $empInt = $_POST['empInt'];
    $empCli = $_POST['empCli'];
    $centroCosto = $_POST['centroCosto'];
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

if (isset($_POST['accion']) && $_POST['accion'] == 'totalDatos') {
    
    $empInt = $_POST['empInt'];
    $empCli = $_POST['empCli'];
    $centroCosto = $_POST['centroCosto'];
    $ciudad = $_POST['ciudad'];
    $fechaIni = $_POST['fechaIni'];
    $fechaFin = $_POST['fechaFin'];
    $estado = $_POST['estado'];
    
    $totalConceptos = $aprobarNominaControl->totalDatos($empInt, $empCli, $centroCosto, $ciudad, $estado, $fechaIni, $fechaFin);
    
    if(count($totalConceptos)>0){
        
        echo json_encode($totalConceptos);
        
    }else{
        
        echo '-1';
    }
    
}

if (isset($_POST['accion']) && $_POST['accion'] == 'detAdicionales'){
    
    $idRegNominas = $_POST['idRegNominas'];
    $reporte = $aprobarNominaControl->detAdicionales($idRegNominas);
    
    if($reporte != false){
        
        echo json_encode($reporte);
        
    }else{
        
        echo '-1';
        
    }
    
    
}

if (isset($_POST['accion']) && $_POST['accion'] == 'detDominicales'){
    
    $empInt = $_POST['empInt'];
    $empCli = $_POST['empCli'];
    $centroCosto = $_POST['centroCosto'];
    $ciudad = $_POST['ciudad'];
    $fechaIni = $_POST['fechaIni'];
    $fechaFin = $_POST['fechaFin'];
    $estado = $_POST['estado'];
    
    $detDominicales = $aprobarNominaControl->detDominicales($empInt, $empCli, $centroCosto, $ciudad, $estado, $fechaIni, $fechaFin);
    
    if(count($detDominicales)>0){
        
        echo json_encode($detDominicales);
        
    }else if($detDominicales === null){
        
        echo '0';
        
    }else if($detDominicales === false){
        
         echo '-1';
        
    }
    
    
}

if (isset($_POST['accion']) && $_POST['accion'] == 'detFestivos'){
    
    $empInt = $_POST['empInt'];
    $empCli = $_POST['empCli'];
    $centroCosto = $_POST['centroCosto'];
    $ciudad = $_POST['ciudad'];
    $fechaIni = $_POST['fechaIni'];
    $fechaFin = $_POST['fechaFin'];
    $estado = $_POST['estado'];
    
    $detDominicales = $aprobarNominaControl->detFestivos($empInt, $empCli, $centroCosto, $ciudad, $estado, $fechaIni, $fechaFin);
    
    if(count($detDominicales)>0){
        
        echo json_encode($detDominicales);
        
    }else if($detDominicales === null){
        
        echo '0';
        
    }else if($detDominicales === false){
        
         echo '-1';
        
    } 
    
}

if(isset($_POST['accion']) && $_POST['accion'] == 'regByPlanilla'){
    
    $idPlanilla = $_POST['idPlanilla'];
    
    $reporte = $aprobarNominaControl->detRegitrosByIdPlanilla($idPlanilla);
    
    if($reporte != null){
        
        echo json_encode($reporte);
        
    }else {
        
        echo '-1';
    }
        
    
}

?>

