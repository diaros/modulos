<?php

include '../../datos/relacionCLienteTipoExamenDatos/relacionClienteTipoExamenDatos.php';

class relacionClienteTipoExamenControl{
    
    function __construct() {
        
    }
    
    public function consultarExamenes($idEmpInt, $nitEmpUsu){
        
        $relacionTipoExamenDatos = new relacionClienteTipoExamenDatos();        
        $resulConsulta = $relacionTipoExamenDatos->consultarExamenes($idEmpInt, $nitEmpUsu);
        return $resulConsulta;              
        
    }
    
    public function actRelacion($idRelacion,$estadoRelExam,$valorExam,$facturable){
        
        $relacionTipoExamenDatos = new relacionClienteTipoExamenDatos();        
        $resulUpdate = $relacionTipoExamenDatos->actRelacion($idRelacion,$estadoRelExam,$valorExam,$facturable);
        return $resulUpdate;      
        
    }
    
    public function insertRelacion($empInt,$nit,$idExam,$estadoRelExam, $valorExam, $facturable){
        
        $relacionTipoExamenDatos = new relacionClienteTipoExamenDatos();        
        $resulInsert= $relacionTipoExamenDatos->insertRelacion($empInt,$nit,$idExam,$estadoRelExam, $valorExam, $facturable);
        return $resulInsert;
        
    }
    
    
}


?>

