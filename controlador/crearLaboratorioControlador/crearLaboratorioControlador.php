<?php

include_once '../../controlador/utilidades/utilidades.php';
require '../../datos/crearLaboratorioDatos/crearLaboratorioDatos.php';

class crearLaboratorioControl{
    
   // var $dataCrearLaboratorio;
    
    public function __construct() {
        //$this->dataCrearLaboratorio;
    }
    
    
    function consultarNit($nit){
        
        $crearLaboratorioDatos = new crearLaboratorioDatos();
        $consulta = $crearLaboratorioDatos->consultarNit($nit);
        return $consulta;    
        
    }
    
    function registrarLab($nit,$nombre,$ciudad,$direccion,$telefono,$contacto,$mail,$estado){
        
        $crearLaboratorioDatos = new crearLaboratorioDatos();
        $resulInsert = $crearLaboratorioDatos->registrarLab($nit,$nombre,$ciudad,$direccion,$telefono,$contacto,$mail,$estado);
        return $resulInsert;
        
    }
    
    function actLab($nit,$nombre,$ciudad,$direccion,$telefono,$contacto,$mail,$estado,$idLab){
        
         $crearLaboratorioDatos = new crearLaboratorioDatos();
         $resulUpdate = $crearLaboratorioDatos->actLab($nit,$nombre,$ciudad,$direccion,$telefono,$contacto,$mail,$estado,$idLab);
         return $resulUpdate;
        
        
    }
    
    function eliminarLab($idLab){
        
        $crearLaboratorioDatos = new crearLaboratorioDatos();
        $resulUpdate = $crearLaboratorioDatos->eliminarLab($idLab);
        return $resulUpdate;
    }
}

?>

