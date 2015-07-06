<?php

include_once '../../datos/conexion.php';

class gestionRequisicionesDatos {

    function __construct() {
        
    }

    function consultarReq($condicionDinamica) {

        $conexion = new conexion();

        $sql = "select  a.id as idReg, 
                        d.nom_empr as empresa,
                        a.id_emp_int idEmp,
                        a.requisicion as requisicion,
                        a.id_usuario as usuario,
                        a.fecha_registro as fecha,
                        c.descripcion as estado,
                        e.nombre as proceso,
                        a.observacion
                        
                from 
                
                contratos_log_estado_req a left join dbo.contratos_proceso as e on (a.id_proceso = e.id),
                usuarios b,
                contratos_estado_requisicion c,
                kactus.dbo.gn_empre d
                
                where 1 = 1
                and a.id_psicologo = b.usu_id
                and a.id_emp_int = d.cod_empr
                and a.id_estado = c.id
                and a.id_estado in (3,4,5)
                " . $condicionDinamica . " order by fecha desc";

        $reporte = $conexion->consultar($sql);
        return $reporte;
    }

    function aceptarRegistro($idReg, $usuCodigo, $fechaAcp) {

        $conexion = new conexion();

        $sql = "update contratos_log_estado_req set id_estado = 4, id_usuario_modifico = " . $usuCodigo . ", fecha_modificacion = '" . $fechaAcp . "',id_proceso = null, observacion = null where id = " . $idReg . " ";
        $resul = $conexion->insertar($sql);
        return $resul;
    }
    
    function prestamoReq($usuCodigo,$idReg,$idProceso,$fechaPres,$observacion){
        
        $conexion = new conexion();
        $sql = "update contratos_log_estado_req set id_estado = 5, id_user_reg = " . $usuCodigo . ", fecha_modificacion = '" . $fechaPres . "', id_proceso = ".$idProceso.",observacion = '".$observacion."'  where id = " . $idReg . " ";
        $resul = $conexion->insertar($sql);
        return $resul;
        
    }
    
    function consultaEstadosReq(){
        
        $conexion = new conexion();
        $sql = "select id,descripcion from contratos_estado_requisicion where id in(3,4,5)";
        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
        
    }

}

?>
