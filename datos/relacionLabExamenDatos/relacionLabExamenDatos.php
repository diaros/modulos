<?php

include_once '../../datos/conexion.php';

class relacionLabExamenDatos {

    public function __construct() {
        
    }

    function consultarExamenes($idLab) {

        $conexion = new conexion();

        $sql = "select b.id_relacion_laboratorio_examen,
                a.nombre as nombre_examen,
                a.id_tipo_examen,
                c.nombre as categoria,
                (case when b.vlr_examen is null then '' else b.vlr_examen end) as vlr_examen,
               (case when b.estado = 1 then 'Activo' else 'Inactivo' end) as estado     

                from exmed_tipo_examen as a
                        LEFT JOIN exmed_relacion_laboratorio_examen as b
                        on(a.id_tipo_examen = b.id_examen and b.id_laboratorio = ".$idLab.")
                        INNER JOIN exmed_categoria_examen as c
                        on(a.id_categoria = c.id_categoria_examen) order by a.nombre";

        $resulConsulta = $conexion->consultar($sql);

        return $resulConsulta;
    }
    
    function actRelLabExam($idRel,$vlrExam,$estado){
        
        $conexion = new conexion();        
        $sql = "update exmed_relacion_laboratorio_examen set vlr_examen = ".$vlrExam." , estado = ".$estado." where id_relacion_laboratorio_examen = ".$idRel."";        
        $resulUpdate = $conexion->insertar($sql);        
        return $resulUpdate;        
    }
    
    function insertRelacion($idLab,$idExam,$vlrExamen,$estadoRel){
        
        $conexion = new conexion();
        $sql="insert into exmed_relacion_laboratorio_examen (id_laboratorio,id_examen,vlr_examen,estado) values(".$idLab.",".$idExam.",".$vlrExamen.",".$estadoRel.")";
        $resultInsert = $conexion->insertar($sql);
        return $resultInsert;
        
    }

}
