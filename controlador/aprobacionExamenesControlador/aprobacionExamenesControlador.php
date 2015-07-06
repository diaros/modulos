<?php

include '../../controlador/utilidades/utilidades.php';
require '../../datos/aprobacionExamenesDatos/aprobacionExamenesDatos.php';


class aprobacionExamenesControl{
    
    var $dataAprobacionExamenes;
   
    
    public function __construct() {
        $this->dataAprobacionExamenes ;   
    }
    
    public function consultarExamenes($condicionDinamica,$inicio,$limite,$idUser){
        
        $aprobacionExamsDatos = new aprobacionExamenesDatos();        
        $consulta = $aprobacionExamsDatos->consultarExamenes($condicionDinamica,$inicio,$limite,$idUser);        
        return $consulta;
    }    
    
    public function totalRegistros($condicionDinamica,$idUser){
        
        $aprobacionExamsDatos = new aprobacionExamenesDatos();        
        $totalRegistros = $aprobacionExamsDatos->totalRegistros($condicionDinamica,$idUser);        
        return $totalRegistros;               
    }
    
    public function actualizarEstadoItem($idItem,$apto){
        
        $aprobacionExamsDatos = new aprobacionExamenesDatos(); 
        $resulActEstadoItem = $aprobacionExamsDatos->actualizarEstadoItem($idItem,$apto);
        return $resulActEstadoItem;       
        
    }

    public function inicioTransaccion(){
        
        $utilidades = new utilidades();        
        $inicioTransaccion = $utilidades->iniciarTransaccion();        
        return $inicioTransaccion;              
    }
    
    public function rollbackTransaccion(){
        
        $utilidades = new utilidades();        
        $rollbackTransaccion = $utilidades->rollbackTransaccion();        
        return $rollbackTransaccion;
        
    }
    
    public function commitTransaccion(){
        
        $utilidades = new utilidades();        
        $commitTransaccion = $utilidades->commitTransaccion();        
        return $commitTransaccion;
        
    }
    
}

?>
