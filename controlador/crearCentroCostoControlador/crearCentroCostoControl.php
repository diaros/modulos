<?php

include '../../datos/crearCentroCostoDatos/crearCentroCostoDatos.php';

class crearCentroCostoControl{
    
    
    function __construct() {
    }
    
    function consultarArbolCliente($idEmpInt){
        
        $crearCentroCostoDatos = new crearCentroCostoDatos();        
        $resulconsulArbol = $crearCentroCostoDatos->consultarArbolCliente($idEmpInt);        
        return $resulconsulArbol;
        
    }
    
    function registrarCentroCosto($idEmpInt,$idEmpCliente,$aiu,$tipoFac,$arbCliente,$identClienteKactus,$cobroAptos){
        
         $crearCentroCostoDatos = new crearCentroCostoDatos();
         $resulInsert = $crearCentroCostoDatos->registrarCentroCosto($idEmpInt,$idEmpCliente,$aiu,$tipoFac,$arbCliente,$identClienteKactus,$cobroAptos);
         return $resulInsert;
        
    }
    
    function consultarCentroCosto($idEmpInt,$idEmpCliente){
        
         $crearCentroCostoDatos = new crearCentroCostoDatos();
         $resulConsulta = $crearCentroCostoDatos->consultarCentroCosto($idEmpInt,$idEmpCliente);
         return $resulConsulta;        
        
    }
    
    function eliminarCentroCosto($idCentroCosto){
        
          $crearCentroCostoDatos = new crearCentroCostoDatos();
          $resulDelete = $crearCentroCostoDatos->eliminarCentroCosto($idCentroCosto);
          return $resulDelete;
    }
    
    function consultarCentroCostos(){
        
        $crearCentroCostoDatos = new crearCentroCostoDatos();
        $resulConsulta = $crearCentroCostoDatos->consultarCentroCostos();
        return $resulConsulta;      
        
    }
    
}

?>

