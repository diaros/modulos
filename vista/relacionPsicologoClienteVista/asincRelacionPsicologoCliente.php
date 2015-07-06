<?php

include '../../controlador/relacionPsicologoClienteControlador/relacionPsicologoClienteControl.php';

$relacionPsicoClient = new relacionPsicologoClienteControl();

if(isset($_POST['accion']) && $_POST['accion'] == 'consultarRelacion'){
    
    $idUsu = $_POST['usuId'];
    $idEmp = $_POST['empId'];
    
    $resulConsulta = $relacionPsicoClient->consultarRelacion($idUsu, $idEmp);
    
    if ($resulConsulta != false){
        
        echo json_encode($resulConsulta);
        
    }else{
        
        echo('-1');
    }   
    
}


?>
