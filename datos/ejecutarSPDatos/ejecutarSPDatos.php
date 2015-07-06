<?php

include_once '../../datos/conexion.php';

class ejecutarSPDatos{
    
    function __construct() {}
    
    function ejecutarSP(){
        
        $conexion = new conexion();
        $sql = "";
        $result = $conexion->insertar($sql);
        
    }
    
}

?>

