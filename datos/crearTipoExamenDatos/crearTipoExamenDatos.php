<?php

require_once '../../datos/conexion.php';

class crearTipoExamenDatos{
    
    
    function registrarTipoExam($desc,$paraCli,$especial,$estado,$valor){
        
        $conexion = new conexion();        
        $sqlInsert = "insert into exmed_tipo_examen(nombre,paraclinico,especial,estado) values( '".$desc."',".$paraCli.",".$especial.",".$estado." )";        
        $resultInsert = $conexion->insertar($sqlInsert);        
        return $resultInsert;  
    }
    
    
    function regRelacionExmenCat($categoria){
        
        $conexion = new conexion();        
        $sqlInsert = "insert into exmed_relacion_tipoExam_Cat(id_tip_examen,id_cat_examen) values(IDENT_CURRENT('exmed_tipo_examen'),".$categoria.")";        
        $resultInsert = $conexion->insertar($sqlInsert);        
        return $resultInsert;
        
    }
    
    
    //falta modificar
    function eliminarTipoExamen($idTipoExamen){
        
        $conexion = new conexion();
        $sql = "delete from exmed_tipo_examen where id_tipo_examen = ".$idTipoExamen." ";
        $resulDelete = $conexion->insertar($sql);
        return $resulDelete;        
    }
    
}

?>

