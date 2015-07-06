<?php

include '../../datos/consultaRequisicionesDatos/consultaRequisicionesDatos.php';
include_once '../../datos/gestionContratosDatos/gestionContratosDatos.php';
include_once '../../datos/listaChequeoDatos/listaChequeoDatos.php';

class consultaRequisicionesControlador {

    function __construct() {
        
    }

    function consultarReq($idUser, $fechaIni, $fechaFin, $estado){

        $consultarReqDatos = new consultaRequisicionesDatos();

        if ($fechaIni != '' && $fechaFin != ''){

            $condicionDinamica = $condicionDinamica . " and a.fecha_registro BETWEEN '" . $fechaIni . "' and '" . $fechaFin . "' ";
        }

        if ($estado != '') {

            $condicionDinamica = $condicionDinamica . " and a.id_estado = '" . $estado . "' ";
            
        }
        
        $reporte = $consultarReqDatos->consultarReq($idUser,$condicionDinamica);        
        return $reporte;
                
    }
    
     function consultarDocumentos($empInt, $req, $idUser) {
         
        $gestionContratos = new gestionContratosDatos();
        $consultarDocDatos = new listaChequeoDatos();
        
         $resExistenciaUser = $gestionContratos->consultarUsuariosxReq($empInt, $req, $idUser);

        if ($resExistenciaUser != null) {
            
            $reporte = $consultarDocDatos->consultarDocumentos($empInt, $req, $idUser);
            return $reporte; 
            
        }
        
        
         
     }

}

?>
