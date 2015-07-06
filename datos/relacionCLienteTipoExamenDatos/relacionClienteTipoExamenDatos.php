<?php

include_once '../../datos/conexion.php';

class relacionClienteTipoExamenDatos{
    
    function __construct() {
        
    }
    
    function consultarExamenes($idEmpInt, $nitEmpUsu){
        
        $conexion = new conexion();  
        
        $sql = "select a.nombre as nombre_examen,
                        a.id_tipo_examen,
                        b.facturable,
                        c.nombre as categoria,
                        b.nit_cliente,
                        d.nombre,
                (case when b.estado = 1 then 'Activo' else 'Inactivo' end)as estado_exam,
                (case when b.vlr_examen is null then '' else b.vlr_examen end) as vlr_examen,
                (case when b.id_relacion_cliente_examen is null then '' else b.id_relacion_cliente_examen end) as id_relacion

                from exmed_tipo_examen as a
                     left join exmed_relacion_cliente_examen as b
                     on (a.id_tipo_examen = b.id_examen and b.nit_cliente = ".$nitEmpUsu." and b.id_empresa_int = ".$idEmpInt.")
                     INNER join exmed_categoria_examen as c
                     on a.id_categoria = c.id_categoria_examen
                     left join dbo.cliente_general as d
                     on (b.nit_cliente = d.nit and d.empresa = ".$idEmpInt.") order by estado_exam";  
        
        $resulConsulta = $conexion->consultar($sql);
        
        return $resulConsulta;
        
    }
    
    function actRelacion($idRelacion,$estadoRelExam,$valorExam,$facturable){
                
        $conexion = new conexion();        
        $sql = "update exmed_relacion_cliente_examen "
                . "set estado = ".$estadoRelExam." , "
                . "facturable = ".$facturable." , "
                . "vlr_examen = ".$valorExam." "
                . "where id_relacion_cliente_examen = ".$idRelacion."  ";          
        $resulUpdate = $conexion->insertar($sql);        
        return $resulUpdate;
        
    }
    
    function insertRelacion($empInt,$nit,$idExam,$estadoRelExam, $valorExam, $facturable){
        
        $conexion = new conexion();        
        $sql = "insert into exmed_relacion_cliente_examen (id_examen,"
                . "                                  nit_cliente,"
                . "                                  estado,"
                . "                                  facturable,"
                . "                                  id_empresa_int,"
                . "                                  vlr_examen)"
                . "                           values(".$idExam.","
                . "                                  ".$nit.","
                . "                                  ".$estadoRelExam.","
                . "                                  ".$facturable.","
                . "                                  ".$empInt.","
                . "                                  ".$valorExam.")";          
        $resulInsert = $conexion->insertar($sql);        
        return $resulInsert;
        
    }
    
    
}

?>
