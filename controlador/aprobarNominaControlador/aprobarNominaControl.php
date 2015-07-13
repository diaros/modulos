<?php

include '../../datos/aprobarNominaDatos/aprobarNominaDatos.php';
include_once '../../controlador/utilidades/utilidades.php';

session_start();

class aprobarNominaControl {

    function __construct() {
        
    }

    function consultaRegNomina($empInt, $empCli, $centroCosto, $ciudad, $estado, $fechaIni, $fechaFin) {

        $aprobarNominaDatos = new aprobarNominaDatos();
        $condicionDinamica = '';

        if ($fechaIni != '' && $fechaFin != '') {

            $condicionDinamica = $condicionDinamica . " and a.fecha_creo BETWEEN '" . $fechaIni . "' and '" . $fechaFin . "' ";
        }

        if ($empInt != '') {

            $condicionDinamica = $condicionDinamica . " and a.id_emp_int = " . $empInt . " ";
        }

        if ($empCli != '') {

            $condicionDinamica = $condicionDinamica . " and a.id_emp_cli = " . $empCli . " ";
        }

        if ($centroCosto != '') {

            $condicionDinamica = $condicionDinamica . " and a.centro_costo = " . $centroCosto . " ";
        }

        if ($ciudad != '') {

            $condicionDinamica = $condicionDinamica . " and a.ciudad = " . $ciudad . " ";
        }

        if ($estado != '') {

            $condicionDinamica = $condicionDinamica . " and a.estado = " . $estado . " ";
        }

        $reporte = $aprobarNominaDatos->consultaRegNomina($condicionDinamica);

        return $reporte;
    }
    
    function aprobarNomina($regNom){
        
       $aprobarNominaDatos = new aprobarNominaDatos();
       $flgError = true;
       
       foreach ($regNom as $valor){
           
           if($valor != ''){
               
               $resulUpdate = $aprobarNominaDatos->aprobarRegNom($valor);
               
               if($resulUpdate == false){
                   
                   $flgError = false;
               }
               
           }
           
       }
       
       if($flgError == false){
           
           return false;
           
       }else{
           
           return true;
       }
        
    }
    
    function totalDatos($empInt, $empCli, $centroCosto, $ciudad, $estado, $fechaIni, $fechaFin){
        
        $aprobarNominaDatos = new aprobarNominaDatos();
        $reporte = Array();
        $condicionDinamica = '';
        $flgError = true;        

        if ($fechaIni != '' && $fechaFin != '') {

            $condicionDinamica = $condicionDinamica . " and a.fecha_creo BETWEEN '" . $fechaIni . "' and '" . $fechaFin . "' ";
        }

        if ($empInt != '') {

            $condicionDinamica = $condicionDinamica . " and a.id_emp_int = " . $empInt . " ";
        }

        if ($empCli != '') {

            $condicionDinamica = $condicionDinamica . " and a.id_emp_cli = " . $empCli . " ";
        }

        if ($centroCosto != '') {

            $condicionDinamica = $condicionDinamica . " and a.centro_costo = " . $centroCosto . " ";
        }

        if ($ciudad != '') {

            $condicionDinamica = $condicionDinamica . " and a.ciudad = " . $ciudad . " ";
        }

        if ($estado != '') {

            $condicionDinamica = $condicionDinamica . " and a.estado = " . $estado . " ";
        }

        $reporte['totalConceptos'] = $aprobarNominaDatos->totalConceptos($condicionDinamica);      
        $reporte['totalUsuarios'] = $aprobarNominaDatos->totalUsuarios($condicionDinamica);
        $reporte['hrsDominicales'] = $aprobarNominaDatos->totalDominicales($condicionDinamica);
        $reporte['hrsFestivos'] = $aprobarNominaDatos->totalFestivos($condicionDinamica);
        $reporte['hrsOrdinarias'] = $aprobarNominaDatos->totalOrdinarias($condicionDinamica);
        
        if($reporte['totalConceptos'] == false || $reporte['totalUsuarios'] == false || $reporte['hrsDominicales'] == false || $reporte['hrsFestivos'] == false || $reporte['hrsOrdinarias'] == false){
            
            return false;
            
        }else{
            
            return $reporte;
            
        } 
        
    }
    
}

?>

