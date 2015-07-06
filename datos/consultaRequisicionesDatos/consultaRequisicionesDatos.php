<?php


include_once '../../datos/conexion.php';

class consultaRequisicionesDatos{
    
    function __construct(){}
    
    function consultarReq($idUser,$condicionDinamica){
        
        $conexion = new conexion();
        
        $sql = "select  d.nom_empr as empresa,
                        a.id_emp_int idEmp,
                        a.requisicion as requisicion,
                        a.id_usuario as usuario,
                        a.fecha_registro as fecha,
                        c.descripcion as estado
                        
                from 
                
                contratos_log_estado_req a,
                usuarios b,
                contratos_estado_requisicion c,
                kactus.dbo.gn_empre d
                where 1 = 1
                and a.id_psicologo = ".$idUser."
                and a.id_psicologo = b.usu_id
                and a.id_emp_int = d.cod_empr
                and a.id_estado = c.id
                ".$condicionDinamica."";
        
        $reporte = $conexion->consultar($sql);
        return $reporte;        
        
    }
    
    
}


?>

