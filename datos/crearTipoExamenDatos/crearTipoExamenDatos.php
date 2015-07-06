<?php

require_once '../../datos/conexion.php';

class crearTipoExamenDatos{
    
    
    function registrarTipoExam($desc,$paraCli,$especial,$estado,$valor){
        
        $conexion = new conexion();        
        $sqlInsert = "insert into exmed_tipo_examen(nombre,id_categoria,paraclinico,especial,estado) values( '".$desc."', ".$valor.",".$paraCli.",".$especial.",".$estado." )";        
        $resultInsert = $conexion->insertar($sqlInsert);        
        return $resultInsert;        
        
    }    
    
    
    function eliminarTipoExamen($idTipoExamen){
        
        $conexion = new conexion();
        $sql = "delete from exmed_tipo_examen where id_tipo_examen = ".$idTipoExamen." ";
        $resulDelete = $conexion->insertar($sql);
        return $resulDelete;
        
    }
    
    
    
}

?>

