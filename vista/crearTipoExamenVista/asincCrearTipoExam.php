<?php

include '../../controlador/crearTipoExamenControlador/crearTipoExamenControlador.php';
require_once '../../controlador/utilidades/utilidades.php';

$crearTipoExam = new crearTipoExamenControlador();
$utilidades = new utilidades();


if (isset($_POST['accion']) && $_POST['accion'] == 'guardarTipoExam') {   
    
    $flgError = false;
    $desc = $_POST['desc'];
    $paraCli = $_POST['paraCli'];
    $especial = $_POST['especial'];
    $estado = $_POST['estado'];
    $categorias = $_POST['categorias'];
    
    $categoriasSinVacios = array_values(array_diff($categorias, array('')));


    $inicioTransac = $utilidades->iniciarTransaccion();

    if ($inicioTransac != false) {

        foreach ($categoriasSinVacios as $valor) {

            $resulInsert = $crearTipoExam->registrarTipoExam($desc, $paraCli, $especial, $estado, $valor);
            
            if($resulInsert == FALSE){
                
                $flgError = true;
                
            }     
            
        }
        
        if($flgError == true){
            
            $utilidades->rollbackTransaccion();
            echo ("-1");
            
            
        }else{
            
            $ressulCommit = $utilidades->commitTransaccion();
            
            if($ressulCommit != FALSE){
                
                echo ('1');
                
            }else{
                
                echo ("-1");
            }
            
            
        }
        
    }else{
        
        echo("-1");
    }
}

if (isset($_POST['accion']) && $_POST['accion'] == 'consultarTiposExams') {
    
    
    $resulConsulta = $utilidades->consultarTipoExams();
    
     if($resulConsulta != false){
        
       echo json_encode($resulConsulta);
        
    }else{
        
        echo('0');
        
    }   
    
}

if(isset($_POST['accion']) && $_POST['accion'] == "eliminarTipoExamen"){
    
    $idTipoExamen = $_POST['idTipoExamen'];
    
    $resulDelete = $crearTipoExam->eliminarTipoExamen($idTipoExamen);
    
    if($resulDelete != false){
        
        echo ('1');
        
        
    }else{
        
         echo ('0');
    }
    
}


?>

