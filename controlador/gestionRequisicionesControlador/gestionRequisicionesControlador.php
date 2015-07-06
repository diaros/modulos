<?php

include '../../datos/gestionRequisicionesDatos/gestionRequisicionesDatos.php';

class gestionRequisicionesControlador{
    
    function __construct() {}
    
    function consultarReq($fechaIni, $fechaFin,$idEmpInt,$numReq,$idUser,$estado){
        
        $gestionReqDatos = new gestionRequisicionesDatos();
        
        if ($fechaIni != '' && $fechaFin != ''){

            $condicionDinamica = $condicionDinamica . " and a.fecha_registro BETWEEN '" . $fechaIni . "' and '" . $fechaFin . "' ";
        }
        
        if($idEmpInt != ''){
            
            $condicionDinamica = $condicionDinamica. "and a.id_emp_int = ".$idEmpInt." ";
            
        }
        
        if($numReq != ''){
            
             $condicionDinamica = $condicionDinamica. "and a.requisicion = ".$numReq." ";
            
        }
        
        if($idUser != ''){
            
             $condicionDinamica = $condicionDinamica. "and a.id_usuario = ".$idUser." ";
        }
        
        if($estado != ''){
            
            $condicionDinamica = $condicionDinamica. "and a.id_estado = ".$estado." ";
            
        }        

        $reporte = $gestionReqDatos->consultarReq($condicionDinamica);        
        return $reporte;
        
    }
    
    function aceptarRegistro($idReg,$usuCodigo,$fechaAcp){
        
        $gestionReqDatos = new gestionRequisicionesDatos();        
        $resul = $gestionReqDatos->aceptarRegistro($idReg,$usuCodigo,$fechaAcp);        
        return $resul;
    }
    
    function prestamoReq($usuCodigo,$idReg,$idProceso,$fechaPres,$observacion){
        
         $gestionReqDatos = new gestionRequisicionesDatos();  
         $resul = $gestionReqDatos->prestamoReq($usuCodigo,$idReg,$idProceso,$fechaPres,$observacion);
         return $resul;       
    }
    
    function consultaEstadosReq(){
        
         $gestionReqDatos = new gestionRequisicionesDatos();  
         $resul = $gestionReqDatos->consultaEstadosReq();
         return $resul;   
        
    }
    
}

?>

