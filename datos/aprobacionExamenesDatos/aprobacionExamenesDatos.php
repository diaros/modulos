<?php

require_once '../../datos/conexion.php';

class aprobacionExamenesDatos {

    public function __construct(){}

    function totalRegistros($condicionDinamica, $idUser){

        $conexion = new conexion();

        $sql = "select count(*) as totalReg  

                from exmed_solicitud_examen a,
                     exmed_examen_item_cedula b,
                     exmed_item_orden_examen c,
                     exmed_tipo_examen d,
                     exmed_laboratorio e,
                     exmed_usuario_examen f

                where 1=1
                " . $condicionDinamica . "
                --and a.estado_orden = 'A'
                and a.id_solicitud_examen = b.id_orden
                and b.id_orden = c.id_orden
                and b.id_examen_item_cedula = f.id_examen_item_cedula
                and c.id_item_orden_examen = f.id_item_orden_examen
                and c.id_examen = d.id_tipo_examen
                and a.usuario_elaboro = " . $idUser . " 
                and a.id_laboratorio = e.id_laboratorio";

        $consulta = $conexion->consultar($sql);

        return $consulta;
    }

    function consultarExamenes($condicionDinamica, $inicio, $limite, $idUser) {

        $conexion = new conexion();
        $sql = "select top " . $limite . " * from(select a.id_solicitud_examen,
                                                            b.nombre,
                                                            b.cedula,
                                                            d.nombre as nombre_examen,        
                                                            e.nombre as nombre_labo,
                                                            c.id_item_orden_examen,
                                                            f.apto,
                                                            f.id_usuario_examen as idReg,
                                                            (case when f.estado is null then 'No ejecutado' else 'Ejecutado' end) estado,
                                                            ROW_NUMBER()OVER (order by a.id_solicitud_examen)as id
                                                       from exmed_solicitud_examen a,
                                                            exmed_examen_item_cedula b,
                                                            exmed_item_orden_examen c,
                                                            exmed_tipo_examen d,
                                                            exmed_laboratorio e,
                                                            exmed_usuario_examen f
                                                    where 1=1
                                                    " . $condicionDinamica . "
                                                    --and a.estado_orden = 'A'
                                                    and a.id_solicitud_examen = b.id_orden
                                                    and b.id_orden = c.id_orden
                                                    and b.id_examen_item_cedula = f.id_examen_item_cedula
                                                    and c.id_item_orden_examen = f.id_item_orden_examen
                                                    and c.id_examen = d.id_tipo_examen
                                                    and a.usuario_elaboro = " . $idUser . " 
                                                    and a.id_laboratorio = e.id_laboratorio)registros where id >= " . $inicio . "";
        $consulta = $conexion->consultar($sql);
        return $consulta;
    }

    function actualizarEstadoItem($idItem,$apto) {

        $conexion = new conexion();
        $sql = "update exmed_usuario_examen set estado = 1,apto = ".$apto." where id_usuario_examen = " . $idItem . " ";
        $resulInsert = $conexion->insertar($sql);
        return $resulInsert;
    }

}
