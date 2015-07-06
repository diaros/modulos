<?php

include '../../datos/dashBoardDatos/dashBoardDatos.php';

class dashBoardControlador {

    function __construct() {}

    function totalContratosMes() {

        $dashBoarDatos = new dashBoardDatos();
      
        $reporte = $dashBoarDatos->totalContratosMes();

        if ($reporte != null) {

            $arregloDatos = Array();

            for ($i = 1; $i <= 12; $i++) {

                foreach ($reporte as $valor) {

                    if ($valor['mes'] == $i) {

                        $arregloDatos[$i] = $valor['cantidad'];
                    }
                }

                if ($arregloDatos[$i] == '') {

                    $arregloDatos[$i] = '0';
                }
            }

            return $arregloDatos;
            
        } else {

            return ('-1');
        }
    }

    function estadoReq() {

        $dashBoarDatos = new dashBoardDatos();
        
        $reporte = $dashBoarDatos->estadoReq();
        
        if ($reporte != null) {
            
            return $reporte;
            
        }        
       
    }
    
    function contratosxEmpresa(){
        
        $dashBoarDatos = new dashBoardDatos();
        
        $reporte = $dashBoarDatos->contratosxEmpresa();
        
        if ($reporte != null) {
            
            $arregloDatos = Array();
            
            for ($i = 1; $i <= 3; $i++) {
               
                foreach ($reporte as $valor){
                 
                    if(isset($valor['empresa'])){
                        
                        
                        
                    }
                    
                }              
                
            }
            
            return $reporte;
            
        }       
        
    }
    
    function contratosxTipo(){
        
        $dashBoarDatos = new dashBoardDatos();
        
        $reporte = $dashBoarDatos->contratosxTipo();
        
        if ($reporte != null) {
            
            return $reporte;
            
        }       
        
        
    }
}
?>

