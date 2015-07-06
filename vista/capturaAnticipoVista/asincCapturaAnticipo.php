<?php

include_once '../../controlador/utilidades/utilidades.php';
include_once '../../controlador/capturaAnticipoControlador/capturaAnticipoControl.php';

$capturaAnticipoControl = new capturaAnticipoControl();

if (isset($_POST['accion']) && $_POST['accion'] == 'consultarCta') {


    $idUser = $_POST['idUser'];

    $resulConsulta = $capturaAnticipoControl->consultaCta(trim($idUser));

    if ($resulConsulta != null) {

        foreach ($resulConsulta as $fila) {

            $json['nom_enti'] = trim(utf8_encode($fila['nom_enti']));
            $json['nro_cuen'] = trim(utf8_encode($fila['nro_cuen']));
            $json['cla_cuen'] = trim(utf8_encode($fila['cla_cuen']));
        }

        echo json_encode($json);
        
    } else {}
}

if (isset($_POST['accion']) && $_POST['accion'] == 'consultarCentroCosto') {

    $centroCosto = $_POST['centroCosto'];
    $empInt = $_POST['empInt'];
    $resulConsulta = $capturaAnticipoControl->consultarCentroCostoUnoE($empInt, $centroCosto);
    echo json_encode($resulConsulta);
    
}

if (isset($_POST['accion']) && $_POST['accion'] == 'consultarUniNeg') {

    $idCentroCosto = $_POST['idCentroCosto'];
    $empInt = $_POST['empInt'];    
    $resulConsulta = $capturaAnticipoControl->consultaUnidadNegocio($empInt, trim($idCentroCosto));   
    
    if($resulConsulta != false){
        
         echo json_encode($resulConsulta);
        
    }else{
        
        
        echo("-1");
    }  
}

if (isset($_POST['accion']) && $_POST['accion'] == 'consultaUnidadNegocioPresupuesto') {
    
    $idPresupuesto = $_POST['idPresupuesto'];   
    $resulConsulta = $capturaAnticipoControl->consultaPresupuestoBiplus($idPresupuesto);
    
    if($resulConsulta != false){
        
         echo json_encode($resulConsulta);
        
    }else{        
        
        echo("-1");
    }  
    
}

if (isset($_POST['accion']) && $_POST['accion'] == 'consultarConceptosPresupuesto') {
    
     $idPresupuesto = $_POST['idPresupuesto'];  
     $ciudad = $_POST['idCiudad'];
     
     $resulConsulta = $capturaAnticipoControl->consultarConceptosPresupuesto($idPresupuesto,$ciudad);
     
     if($resulConsulta != null){
         
         echo json_encode($resulConsulta);
         
     }else{
         
         echo('-1');
         
     }
     
     
     
    
    
}

?>

