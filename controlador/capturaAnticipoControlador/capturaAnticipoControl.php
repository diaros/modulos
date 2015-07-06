<?php

include_once '../../datos/capturaAnticipoDatos/capturaAnticipoDatos.php';

class capturaAnticipoControl {

    function __construct() {
        
    }

    function consultaCta($idUser) {

        $capturaAnticipoDatos = new capturaAnticipoDatos();
        $resulConsulta = $capturaAnticipoDatos->consultarCta($idUser);
        return $resulConsulta;
    }

    function consultarCentroCostoUnoE($empInt, $cc) {

        $capturaAnticipoDatos = new capturaAnticipoDatos();
        $resulConsulta = $capturaAnticipoDatos->consultarCentroCostoUnoE($empInt, $cc);
        return $resulConsulta;
    }

    function consultaUnidadNegocio($empInt, $idCentroCosto) {

        $capturaAnticipoDatos = new capturaAnticipoDatos();
        $resulConsulta = $capturaAnticipoDatos->consultaUnidadNegocio($empInt, $idCentroCosto);
        return $resulConsulta;
    }

    function consultaPresupuestoBiplus($idPresupuesto) {

        $capturaAnticipoDatos = new capturaAnticipoDatos();
        $resulConsulta = $capturaAnticipoDatos->consultaPresupuestoBiplus($idPresupuesto);
        
        if($resulConsulta != null){            
            
            $codEvento = $resulConsulta[0]['pr_cod_evento_u'];            
            $consultarUniNegocio = $capturaAnticipoDatos->consultarUnidadNegocioPresupuesto($codEvento);  
            
            if($consultarUniNegocio == null){
                
                $codEvento = '';
                
                $consultarUniNegocio = $capturaAnticipoDatos->consultarUnidadNegocioPresupuesto($codEvento);  
                
            }
            
            
            return $consultarUniNegocio;
            
        }
               
    }
    
    function consultarConceptosPresupuesto($idPresupuesto,$idCiudad){
        
       $arregloDatos = Array();
        
       $capturaAnticipoDatos = new capturaAnticipoDatos();       
       $resulConsulta = $capturaAnticipoDatos->consultaConceptosByPeriodo($idPresupuesto, $idCiudad);
       
       if($resulConsulta != null){
           
           $i= 0 ;
           
           foreach ($resulConsulta as $fila){
               
               
               $resulConsultaUnoE = $capturaAnticipoDatos->consultaConceptoUnoe($fila['cp_cod_copcento']);
               
               if($resulConsultaUnoE != null){
                   
                   $arregloDatos[$i]['cp_cod_copcento'] = $fila['cp_cod_copcento'];
                   $arregloDatos[$i]['cp_valor'] = $fila['cp_valor'];
                   $arregloDatos[$i]['pcp_num_personas'] = $fila['pcp_num_personas'];
                   $arregloDatos[$i]['totalConcepto'] = ($fila['cp_valor'] * $fila['pcp_num_personas']);                   
                   $arregloDatos[$i]['nomConcepto'] = $resulConsultaUnoE[0]['f253_descripcion'];
                   
               }
               
               $i++;
               
           }
           
           return $arregloDatos;
           
       }else {}
              
        
    }
    
    function consultarCiudadesBycodEmpresa($codEmpresa) {

        $capturaAnticipoDatos = new capturaAnticipoDatos();
        $resulConsulta = $capturaAnticipoDatos;        
        
    }

}
?>

