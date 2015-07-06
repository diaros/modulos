<?php

include '../../datos/relacionPsicologoClienteDatos/relacionPsicologoClienteDatos.php';

class relacionPsicologoClienteControl{
    
    public function __construct() {
        
    }
    
    function consultarRelacion($idUsu, $idEmp){
        
        $relacionPsicoClienDatos = new relacionPsicologoClienteDatos();        
        $resultConsulta = $relacionPsicoClienDatos->consultarRelacion($idUsu, $idEmp);        
        return $resultConsulta;
    }
    
    function actRelacion($idRel,$estado){
        
        $relacionPsicoClienDatos = new relacionPsicologoClienteDatos();
        $resulUpdate = $relacionPsicoClienDatos->actRelacion($idRel,$estado);
        return $resulUpdate;
        
    }
    
    function insertRelacion($idUsu, $nitCliente, $estadoRel){
        
        $relacionPsicoClienDatos = new relacionPsicologoClienteDatos();
        $resulInsert = $relacionPsicoClienDatos->insertRelacion($idUsu, $nitCliente, $estadoRel);
        return $resulInsert;
    }
    
    
}


?>

