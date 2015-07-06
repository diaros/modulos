<?php

include_once '../../datos/facturacionExamenesDatos/facturacionExamenesDatos.php';

class facturacionExamenesControlador{
    
    function __construct(){}
    
    function facturarExamenes(){
        
        $facturacionDatos = new facturacionExamenesDatos();        
        $resulProceso = $facturacionDatos->facturacionExamens();
        return $resulProceso;              
    }
    
    function consultarIncidencias(){
        
        $facturacionDatos = new facturacionExamenesDatos();
        $resulConsulta = $facturacionDatos->consultaIncidencias();
        return $resulConsulta;        
    }
    
    function consultarExamenesUsuarios(){
        
        $facturacionDatos = new facturacionExamenesDatos();
        $resulConsulta = $facturacionDatos->consultarExamenesUsuarios();
        return $resulConsulta;        
    }
    
}

?>

