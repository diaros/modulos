<?php

include '../../controlador/crearLaboratorioControlador/crearLaboratorioControlador.php';
require_once '../../controlador/utilidades/utilidades.php';

$crearLab = new crearLaboratorioControl();
$utilidades = new utilidades();

if(isset($_POST['accion']) && $_POST['accion'] == 'valExistenciaLab'){
    
    $nit = $_POST['nit'];
    
    $resConsultaNit = $crearLab->consultarNit($nit);
    
    if($resConsultaNit != ''){
        
       echo json_encode($resConsultaNit);
        
    }  
    
}

if(isset($_POST['accion']) && $_POST['accion'] == 'guardar' || $_POST['accion'] == 'actualizar'){
        
   $nit = $_POST['nit'];
   $nombre = $_POST['nombre'];
   $ciudad = $_POST['ciudad'];
   $direccion = $_POST['direccion'];
   $telefono = $_POST['telefono'];
   $contacto = $_POST['contacto'];
   $mail = $_POST['mail'];
   $estado = $_POST['estado'];
   $idLab = $_POST['idLab'];   
   
   if($idLab == ''){
       
        $resulInsert = $crearLab->registrarLab($nit,$nombre,$ciudad,$direccion,$telefono,$contacto,$mail,$estado);
        
        if($resulInsert == false){            
            echo('0');
        }else{            
            echo('1');            
        }        
       
   }else{       
       
       $resulUpdate = $crearLab->actLab($nit,$nombre,$ciudad,$direccion,$telefono,$contacto,$mail,$estado,$idLab);
       
       if($resulUpdate == false){            
            echo('0');
        }else{            
            echo('1');            
        }      
   }   
    
}

if(isset($_POST['accion']) && $_POST['accion'] == 'consultarLab'){    
    
    $resulConsulta = $utilidades->consultarLab();
    
    if($resulConsulta !=false){
        
        echo json_encode($resulConsulta);
        
    }else{
        
        echo ('0');
    }
    
}

  if(isset($_POST['accion']) && $_POST['accion'] == 'eliminarLab'){
  
      $idLab = $_POST['idLab'];
      
      $resulDelete = $crearLab->eliminarLab($idLab);
      
      if($resulDelete != false){
          
          echo ('1');
          
      }else{
          
          echo ('0');
      }       
        
  }

?>

