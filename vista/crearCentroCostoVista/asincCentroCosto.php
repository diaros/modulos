<?php

include '../../controlador/utilidades/utilidades.php';
include '../../controlador/crearCentroCostoControlador/crearCentroCostoControl.php';

$crearCentroCosto = new crearCentroCostoControl();
$utilidades = new utilidades();

if (isset($_POST[accion]) && $_POST['accion'] == 'consultaEmpUsuarias') {

    $idEmpInt = $_POST['idEmpInt'];

    $resConsultaEmpUsuarias = $utilidades->consultarEmpUsuariasByEmpInt($idEmpInt);

    if ($resConsultaEmpUsuarias != false) {

        foreach($resConsultaEmpUsuarias as $fila) {

            $json[$fila['nit']] = $fila['nombre'];
        }

        echo json_encode($json);
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'consulArbol') {

    $idEmpInt = $_POST['idEmpInt'];

    $resulConsultaArbol = $crearCentroCosto->consultarArbolCliente($idEmpInt);

    if ($resulConsultaArbol != false) {

        echo json_encode($resulConsultaArbol);
    } else {

        echo ('-1');
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'guardarCC') {

    $idEmpInt = $_POST['idEmpInt'];
    $idEmpCliente = $_POST['idEmpCliente'];
    $aiu = $_POST['aiu'];
    $tipoFac = $_POST['tipoFac'];
    $arbCliente = $_POST['arbCliente'];
    $identClienteKactus = $_POST['identClienteKactus'];
    
    
    if($_POST['aceptaAptos']== true){
        
        $cobroAptos = 1;
        
    }  elseif ($_POST['aceptaAptos']== false) {
        
        $cobroAptos = 0;
        
    }   

    $resulConsultaCC = $crearCentroCosto->consultarCentroCosto($idEmpInt, $idEmpCliente);

    if ($resulConsultaCC == null) {

        $resulInsertCC = $crearCentroCosto->registrarCentroCosto($idEmpInt, $idEmpCliente, $aiu, $tipoFac, $arbCliente, $identClienteKactus,$cobroAptos);

        if ($resulInsertCC != false){

            echo ("1");
            
        } else {

            echo ("-1");
            
        }
    }else{
        
        echo("-2");
        
    }
}

if(isset($_POST['accion']) && $_POST['accion'] == 'eliminarCC'){    
    
    $idCentroCosto = $_POST['idCentroCosto'];
    
    $resulDelete = $crearCentroCosto->eliminarCentroCosto($idCentroCosto);
    
    if($resulDelete != false){
        
        echo ("1");
        
    }else{
        
        echo ("-1");
    }
    
}

if(isset($_POST['accion']) && $_POST['accion'] == 'consultarCC'){
    
    $resulConsultaCentroCosto = $crearCentroCosto->consultarCentroCostos();
    
    if($resulConsultaCentroCosto != false){
        
         echo json_encode($resulConsultaCentroCosto);
    }    
}

?>

