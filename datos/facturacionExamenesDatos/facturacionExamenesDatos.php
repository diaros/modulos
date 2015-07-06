<?php

include_once '../../datos/conexion.php';

class facturacionExamenesDatos{
    
    function __construct() {}
    
    function facturacionExamens(){
        
        $conexion = new conexion();        
        $sqlProcedure = "EXEC sp_exmed_procesar";
        $resulProceso = $conexion->consultar($sqlProcedure);
        return $resulProceso;       
        
    } 
    
    function consultaIncidencias(){
        
        $conexion = new conexion(); 
        $sql = "";
        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
        
    }
    
    function consultarExamenesUsuarios(){
        
        $conexion = new conexion(); 
        $sql = "select count(*) as cant from exmed_usuario_examen where ovs is null and estado is not null";
        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
    }
    
}

?>

