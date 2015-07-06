<?php

session_start();
include "../../datos/solicitudCompraDatos/solicitudCompraDatos.php";

class solicitudCompraControl {
    
    function __construct(){}
    
    function consultarCentroCostoUnoE($empInt,$cc){
        
        $solicitudCompraDatos = new solicitudCompraDatos();        
        $resConsulta = $solicitudCompraDatos->consultarCentroCostoUnoE($empInt, $cc);        
        return $resConsulta;      
    }
    
    function consultaPresupuesto($presupuesto){
        
        $solicitudCompraDatos = new solicitudCompraDatos();        
        $resulConsulta = $solicitudCompraDatos->consultaPresupuesto($presupuesto);
        return $resulConsulta;        
    }
    
    function consultaUsuarioAprueba($tipoCompra, $ciudad){
        
        $solicitudCompraDatos = new solicitudCompraDatos();        
        $resulConsulta = $solicitudCompraDatos->consultaUsuarioAprueba($tipoCompra, $ciudad);
        return $resulConsulta;        
    }    
    
    function guardarEncabezado($idUserReg,$fechaReg,$usuAprueba,$nitCliente,$ciudad,$aiu,$centroCosto,$fechaReq,$estado,$tipoCompra,$telefono,$concepto,$empInt,$observacion,$presupuesto,$actividad){      
        
        $solicitudCompraDatos = new solicitudCompraDatos();
        $resulInsert = $solicitudCompraDatos->guardarEncabezado($idUserReg,$fechaReg,$usuAprueba,$nitCliente,$ciudad,$aiu,$centroCosto,$fechaReq,$estado,$tipoCompra,$telefono,$concepto,$empInt,$observacion,$presupuesto,$actividad);
        return $resulInsert;       
        
    }
    
    function guardarItem($cantidadItem,$descItem,$especItem,$ciudadItem,$dirItem,$contactoItem,$estadoItem){
        
        $solicitudCompraDatos = new solicitudCompraDatos(); 
        $resulInsert = $solicitudCompraDatos->guardarItem($cantidadItem,$descItem,$especItem,$ciudadItem,$dirItem,$contactoItem,$estadoItem);
        return $resulInsert;
        
    }
}

?>

