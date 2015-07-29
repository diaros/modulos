<?php

include '../../controlador/consultaNominaControlador/consultaNominaControl.php';
include_once '../../controlador/aprobarNominaControlador/aprobarNominaControl.php';
include_once '../../controlador/utilidades/utilidades.php';

session_start();

$consultaNominaControl = new consultaNominaControl();
$utilidades = new utilidades();

if (isset($_POST['accion']) && $_POST['accion'] == 'consultarRegNomina') {
    
    $aprobarNominaControl = new aprobarNominaControl();

    $empInt = $_POST['empInt'];
    $empCli = $_POST['empCli'];
    $centroCosto = $_POST['centroCosto'];
    $ciudad = $_POST['ciudad'];
    $fechaIni = $_POST['fechaIni'];
    $fechaFin = $_POST['fechaFin'];
    $estado = 4;
    $consecutivo = $_POST['consecutivo'];

    $reporte = $aprobarNominaControl->consultaRegNomina($empInt, $empCli, $centroCosto, $ciudad, $estado, $fechaIni, $fechaFin,$consecutivo);

    if ($reporte != false) {

        echo json_encode($reporte);
        
    } else if ($reporte == null) {

        echo '0';
        
    } else if ($reporte == false) {

        echo '-1';
    }
}

if(isset($_POST['accion']) && $_POST['accion'] == 'excel'){
    
    $id = $_POST['consecutivo'];
    $tipoArchivo = 'excel';
    
    $archivo = $consultaNominaControl->generarExcel($id,$tipoArchivo);
    
    if($archivo != false){
        
        echo json_encode($archivo);
        
    }else{
        
        echo '-1';
    }   
}

if(isset($_POST['accion']) && $_POST['accion'] == 'plano'){
   
    $id = $_POST['consecutivo'];
    $archivo = $consultaNominaControl->generarPlano($id);
    
    if($archivo != false){
        
        echo json_encode($archivo);
        
    }else{
        
        echo '-1';
    }  
    
    
}

if (isset($_POST['accion']) && $_POST['accion'] == 'totalDatos') {
    
    $aprobarNominaControl = new aprobarNominaControl();
    
    $empInt = $_POST['empInt'];
    $empCli = $_POST['empCli'];
    $centroCosto = $_POST['centroCosto'];
    $ciudad = $_POST['ciudad'];
    $fechaIni = $_POST['fechaIni'];
    $fechaFin = $_POST['fechaFin'];
    $estado = 4;
    $consecutivo = $_POST['consecutivo'];
    
    $totalConceptos = $aprobarNominaControl->totalDatos($empInt, $empCli, $centroCosto, $ciudad, $estado, $fechaIni, $fechaFin,$consecutivo);
    
    if(count($totalConceptos)>0){
        
        echo json_encode($totalConceptos);
        
    }else{
        
        echo '-1';
    }
    
}

if (isset($_POST['accion']) && $_POST['accion'] == 'detFestivos'){
    
    $aprobarNominaControl = new aprobarNominaControl();
    
    $empInt = $_POST['empInt'];
    $empCli = $_POST['empCli'];
    $centroCosto = $_POST['centroCosto'];
    $ciudad = $_POST['ciudad'];
    $fechaIni = $_POST['fechaIni'];
    $fechaFin = $_POST['fechaFin'];
    $estado = 4;
    $consecutivo = $_POST['consecutivo'];
    
    $detDominicales = $aprobarNominaControl->detFestivos($empInt, $empCli, $centroCosto, $ciudad, $estado, $fechaIni, $fechaFin,$consecutivo);
    
    if(count($detDominicales)>0){
        
        echo json_encode($detDominicales);
        
    }else if($detDominicales === null){
        
        echo '0';
        
    }else if($detDominicales === false){
        
        echo '-1';
        
    } 
    
}

if (isset($_POST['accion']) && $_POST['accion'] == 'detDominicales'){
    
    $aprobarNominaControl = new aprobarNominaControl();
    
    $empInt = $_POST['empInt'];
    $empCli = $_POST['empCli'];
    $centroCosto = $_POST['centroCosto'];
    $ciudad = $_POST['ciudad'];
    $fechaIni = $_POST['fechaIni'];
    $fechaFin = $_POST['fechaFin'];
    $estado = 4;
    $consecutivo = $_POST['consecutivo'];
    
    $detDominicales = $aprobarNominaControl->detDominicales($empInt, $empCli, $centroCosto, $ciudad, $estado, $fechaIni, $fechaFin,$consecutivo);
    
    if(count($detDominicales)>0){
        
        echo json_encode($detDominicales);
        
    }else if($detDominicales === null){
        
        echo '0';
        
    }else if($detDominicales === false){
        
         echo '-1';
        
    } 
    
}



?>

