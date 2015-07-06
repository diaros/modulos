<?php

require_once '../../datos/conexion.php';

class consulltaExamenesDatos {

    public function __construct() {}

    function totalRegistros($condicionDinamica) {

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
                and a.id_laboratorio = e.id_laboratorio";

        $consulta = $conexion->consultar($sql);

        return $consulta;
    }

    function consultarExamenes($condicionDinamica, $inicio, $limite) {

        $conexion = new conexion();
        
        $sql = "select top " . $limite . " * from(select a.id_solicitud_examen,
                                                  b.nombre,
                                                  b.cedula,
                                                  d.nombre as nombre_examen,        
                                                  e.nombre as nombre_labo,
                                                  c.id_item_orden_examen,
                                                  (case when f.estado is null then 'No ejecutado' else 'Ejecutado' end) estado,
                                                    ROW_NUMBER()OVER (order by a.id_solicitud_examen desc)as id
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
                                                 and a.id_laboratorio = e.id_laboratorio)registros where id >= " . $inicio . "";
        
        $consulta = $conexion->consultar($sql);
        return $consulta;
    }
    
    function reporteTotal($condicionDinamica){
       
         $conexion = new conexion();
         
                                   $sql = "select a.id_solicitud_examen,
                                                  convert(varchar(30),convert(date,a.fecha_proceso,106),103) as fecha_solicitud,
                                                  g.nom_empr,
                                                  h.suc_nombre,
                                                  i.nombre as cliente,    
                                                  b.nombre,
                                                  b.cedula,
                                                  m.nom_carg as cargo,
                                                  d.nombre as nombre_examen,        
                                                  e.nombre as nombre_labo,
                                                  j.NOM_CLIE as centro_costo,
                                                  l.nom_nive as nivel,
                                                  k.vlr_examen,
                                                  f.ovs,
                                                  (case when f.estado is null then 'No ejecutado' else 'Ejecutado' end) estado,
                                                    ROW_NUMBER()OVER (order by a.id_solicitud_examen desc)as id
                                                 from exmed_solicitud_examen a,
                                                            exmed_examen_item_cedula b,
                                                            exmed_item_orden_examen c,
                                                            exmed_tipo_examen d,
                                                            exmed_laboratorio e,
                                                            exmed_usuario_examen f,
                                                            kactus.dbo.gn_empre g,
                                                            Sucursales h,
                                                            dbo.cliente_general i,
                                                            kactus.dbo.nm_fapar j,
                                                            exmed_relacion_cliente_examen k,
                                                            kactus.dbo.gn_nivel l,
                                                            kactus.dbo.bi_cargo m
                                            where 1=1
                                                " . $condicionDinamica . "
                                                   and a.id_solicitud_examen = b.id_orden
                                                    and b.id_orden = c.id_orden
                                                    and b.id_examen_item_cedula = f.id_examen_item_cedula
                                                    and c.id_item_orden_examen = f.id_item_orden_examen
                                                    and c.id_examen = d.id_tipo_examen
                                                    and a.id_laboratorio = e.id_laboratorio
                                                    and a.empresa = g.cod_empr
                                                    and a.ciudad = h.suc_codigo
                                                    and a.nit_cliente = i.nit
                                                    and a.empresa = i.empresa
                                                    and a.centro_costo = j.COD_CLIE
                                                    and a.empresa = j.COD_EMPR
                                                    and a.empresa = k.id_empresa_int
                                                    and a.nit_cliente = k.nit_cliente
                                                    and c.id_examen = k.id_examen
                                                    and a.nivel = l.cod_nive
                                                    and b.cargo = m.cod_carg";
         
         
         $resulConsulta = $conexion->consultar($sql);
         return $resulConsulta;        
        
    }

}























