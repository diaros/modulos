<?php

include '../../datos/relacionLabExamenDatos/relacionLabExamenDatos.php';

class relacionLabExamenControl{
    
    public function __construct() {
        
    }
    
    function consultarExamenes($idLab){
        
        $relLaExamDatos = new relacionLabExamenDatos();        
        $resulConsulta = $relLaExamDatos->consultarExamenes($idLab);
        return $resulConsulta;
        
    }
    
    function actRelLabExam($idRel,$vlrExam,$estado){
        
        $relLaExamDatos = new relacionLabExamenDatos();        
        $resulUpdate = $relLaExamDatos->actRelLabExam($idRel,$vlrExam,$estado);
        return $resulUpdate;
    }
    
    function insertRelacion($idLab,$idExam,$vlrExamen,$estadoRel){
        
        $relLaExamDatos = new relacionLabExamenDatos();        
        $resulInsert = $relLaExamDatos->insertRelacion($idLab,$idExam,$vlrExamen,$estadoRel);
        return $resulInsert;
        
    }
    
}

