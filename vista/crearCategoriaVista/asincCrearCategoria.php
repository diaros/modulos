<?php

require '../../controlador/crearCategoriaControlador/crearCategoriaControlador.php';
require_once '../../controlador/utilidades/utilidades.php';

$crearCat = new crarCategoriaControl();
$utilidades = new utilidades();

if(isset($_POST['accion']) && $_POST['accion'] == 'guardarCat'){
    
    $nombre = $_POST['nombre'];
    $estado = $_POST['estado'];
    
    $resInsert = $crearCat->registrarCat($nombre, $estado);
    
    if($resInsert !=false){
        
        echo('1');
                
    }else{
        
        echo ('0');
        
    }    
    
}

if(isset($_POST['accion']) && $_POST['accion'] == 'consultarCat'){
    
    $resulConsulta = $utilidades->consultarCategorias();
    
    if($resulConsulta != false){
        
       echo json_encode($resulConsulta);
        
    }else{
        
        echo('0');
        
    }   
}

if(isset($_POST['accion']) && $_POST['accion'] == "eliminarCat"){
    
    $idCat = $_POST['idCat'];
    
    $resulDelete = $crearCat->eliminarCat($idCat);
    
    if($resulDelete != false){
        
        echo ('1');
        
        
    }else{
        
         echo ('0');
    }
    
}

?>
