<?php

include_once '../../datos/conexion.php';

class anularSolicitudDatos {

    function __construct() {
        
    }

    function consultarOrden($idOrden, $idUser) {

        $conexion = new conexion();
        $sql = "select id_solicitud_examen,
                      -- nom_empr,
                       a.centro_costo,
                       b.usu_nombre as usuElab,
                       c.usu_nombre as usuAprueb,
                       (case when estado = 'A' then 'En elaboracion' when estado_orden = 'V' then 'Aprobado' when estado = 'I' then 'Anulado' when estado = 'F' then 'Facturada' when estado = 'C' then 'Facturada y Contabilizada' end)estado_orden 
                  from exmed_solicitud_examen a, 
                       usuarios b,
                       usuarios c
                      -- kactus.dbo.gn_empre                      
                 
                 where a.usuario_elaboro = b.usu_id  
                       and a.usuario_elaboro = c.usu_id 
                      -- and empresa=cod_empr 
                       and a.id_orden = '" . $idOrden . "' "
                . "and a.usuario_elaboro = " . $idUser . " ";

        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
    }

    function anularOrden($consOrden) {

        $conexion = new conexion();
        $sql = "update exmed_solicitud_examen set estado = 5 where id_solicitud_examen = " . $consOrden . "  ";
        $resulUpdate = $conexion->insertar($sql);
        return $resulUpdate;
    }

    function totalRegistrosAnular($condicionDinamica, $idUser) {

        $conexion = new conexion();
        $sql = "select count(*) as totalReg

                                                 from    exmed_solicitud_examen a,
                                                         kactus.dbo.gn_empre b,
                                                         dbo.cliente_general c,
                                                         kactus.dbo.NM_FAPAR d,
                                                         dbo.exmed_laboratorio e,
                                                         dbo.Usuarios f,
                                                         dbo.exmed_estado_orden g

                                                 where   1=1
                                                         ".$condicionDinamica."
                                                         and a.estado in (1,5)    
                                                         and a.empresa = b.cod_empr
                                                         and a.nit_cliente = c.nit
                                                         and a.empresa = c.empresa
                                                         and a.centro_costo = d.COD_CLIE
                                                         and a.empresa = d.COD_EMPR
                                                         and a.id_laboratorio = e.id_laboratorio
                                                         and a.usuario_elaboro = f.usu_id
                                                         and a.estado = g.id_estado_orden
                                                         and a.usuario_elaboro = ".$idUser."";
        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
    }

    function consultarExamenesAnular($condicionDinamica, $inicio, $limite, $idUser) {

        $conexion = new conexion();
        $sql = "select top " . $limite . " * from(select a.id_solicitud_examen,
                                                        b.nom_empr,
                                                        c.nombre as nom_cliente,
                                                        d.NOM_CLIE as centro_costo,
                                                        e.nombre as nombre_lab,
                                                        f.usu_nombre,
                                                        a.fecha_proceso,
                                                        g.nombre,
                                                        ROW_NUMBER()OVER (order by a.id_solicitud_examen)as id

                                                 from    exmed_solicitud_examen a,
                                                         kactus.dbo.gn_empre b,
                                                         dbo.cliente_general c,
                                                         kactus.dbo.NM_FAPAR d,
                                                         dbo.exmed_laboratorio e,
                                                         dbo.Usuarios f,
                                                         dbo.exmed_estado_orden g

                                                 where   1=1
                                                         ".$condicionDinamica."
                                                         and a.estado in (1,5)    
                                                         and a.empresa = b.cod_empr
                                                         and a.nit_cliente = c.nit
                                                         and a.empresa = c.empresa
                                                         and a.centro_costo = d.COD_CLIE
                                                         and a.empresa = d.COD_EMPR
                                                         and a.id_laboratorio = e.id_laboratorio
                                                         and a.usuario_elaboro = f.usu_id
                                                         and a.estado = g.id_estado_orden
                                                         and a.usuario_elaboro = ".$idUser."
                                                 )registros where id >= " . $inicio . "";
        $consulta = $conexion->consultar($sql);
        return $consulta;
    }

}

?>