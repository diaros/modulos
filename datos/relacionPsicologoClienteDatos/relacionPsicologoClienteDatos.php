<?php

include_once '../../datos/conexion.php';

class relacionPsicologoClienteDatos {

    public function __construct(){}

    function consultarRelacion($idUsu, $idEmp){

        $conexion = new conexion();
        $sql = "select b.id_relacion_sicologo_cliente,
                    (case when b.estado = 1 then 'Activo' else 'Inactivo' end)as estado,
                     b.id_usuario,
                     c.usu_nombre,
                     a.nombre,
                     a.nit  

                from dbo.cliente_general as a
                   LEFT JOIN exmed_relacion_sicologo_cliente as b
                   on (a.nit = b.nit_cliente  and b.id_usuario = " . $idUsu . ")
                   LEFT join dbo.Usuarios as c
                   on (c.usu_id = b.id_usuario)
                where a.empresa = " . $idEmp . " order by estado,a.nombre";

        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
        
    }

    function actRelacion($idRel, $estado){

        $conexion = new conexion();
        $sql = "update exmed_relacion_sicologo_cliente set estado = ".$estado." where id_relacion_sicologo_cliente = ".$idRel."";
        $resulUpdate = $conexion->insertar($sql);
        return $resulUpdate;
        
    }
    
    function insertRelacion($idUser,$nitCliente,$estado){
        
        $conexion = new conexion();
        $sql = "insert into exmed_relacion_sicologo_cliente (nit_cliente,id_usuario,estado) values(".$nitCliente.",".$idUser.",".$estado.")";
        $resulInsert = $conexion->insertar($sql);
        return $resulInsert;        
    }

}
?>

