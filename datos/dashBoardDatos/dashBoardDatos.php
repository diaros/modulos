<?php

include_once '../../datos/conexion.php';

class dashBoardDatos {

    function __construct() {
        
    }

    function totalContratosMes() {

        $conexion = new conexion();
        $sql = "select MONTH(a.fecha_creacion) as mes,
                 count(a.fecha_creacion) as cantidad 
                 from dbo.contratos_log_contrato a 
                 group by MONTH(a.fecha_creacion)";

        $reporte = $conexion->consultar($sql);
        return $reporte;
    }

    function estadoReq() {

        $conexion = new conexion();

        $sql = "select count(b.id_estado) as cantidad,
                a.descripcion as estado
                from 
                dbo.contratos_estado_requisicion a left join dbo.contratos_log_estado_req b on a.id = b.id_estado
                GROUP by b.id_estado, a.descripcion
                order by a.descripcion";


        $reporte = $conexion->consultar($sql);
        return $reporte;
    }

    function contratosxEmpresa() {

        $conexion = new conexion();

        $sql = "select count(b.id_emp_int) as cantidad,
                a.nom_empr as empresa
                from  kactus.dbo.gn_empre a left join dbo.contratos_log_contrato b on a.cod_empr = b.id_emp_int
                group by b.id_emp_int,a.nom_empr
                order by a.nom_empr";

        $reporte = $conexion->consultar($sql);
        return $reporte;
    }

    function contratosxTipo() {

        $conexion = new conexion();
        $sql = "select count (b.tipo_contrato) as cantidad,
                        a.descripcion as tipo

                 from contratos_tipo_contrato a left join contratos_log_contrato b on a.id = b.tipo_contrato
                 group by b.tipo_contrato,a.descripcion
                 order by a.descripcion";

        $reporte = $conexion->consultar($sql);
        return $reporte;
    }

}

?>
