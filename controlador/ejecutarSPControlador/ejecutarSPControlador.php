<?php

include '../../datos/ejecutarSPDatos/ejecutarSPDatos.php';


class ejecutarSPControlador{
    
    
    function __construct() {
        
    }
    
    function ejecutarSP(){
        
        $ejecutarSPDatos = new ejecutarSPDatos();
        $resultSP = $ejecutarSPDatos->ejecutarSP();
        return $resultSP;
        
        
    }    
    
}

?>
