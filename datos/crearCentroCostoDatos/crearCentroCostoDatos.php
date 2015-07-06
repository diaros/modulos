<?php

include_once '../../datos/conexion.php';

class crearCentroCostoDatos {

    function __construct() {}

    function consultarArbolCliente($idEmpInt){

        $conexion = new conexion();
        $sql = "select a.cod_nive,
                       b.nom_nive

                 from  gn_anive as a,
                       gn_nivel as b

                 where a.ide_arbo = 'BI'
                   and a.num_nive = 1
                   and a.cod_empr = " . $idEmpInt . "
                   and a.cod_nive = b.cod_nive
                   and a.ide_arbo = b.ide_arbo
                   and a.num_nive = b.num_nive
                   and a.cod_empr= b.cod_empr";

        $resulConsulta = $conexion->consultarKactus($sql);
        return $resulConsulta;
        
    }

    function registrarCentroCosto($idEmpInt, $idEmpCliente, $aiu, $tipoFac, $arbCliente, $identClienteKactus, $cobroAptos) {

        $conexion = new conexion();

        if ($tipoFac == 1) {

            $sql = 'insert into exmed_tipo_cobro(id_empresa_interna,id_empresa_cliente,aiu,tipo_facturacion,acepta_cobro_no_aptos) values(' . $idEmpInt . ',' . $idEmpCliente . ',' . $aiu . ',' . $tipoFac . ',' . $cobroAptos . ')';

            $resulInsert = $conexion->insertar($sql);
            return $resulInsert;
        } else {

            $sql = 'insert into exmed_tipo_cobro(id_empresa_interna,id_empresa_cliente,aiu,tipo_facturacion,id_cliente_kactus,arbol_cliente,acepta_cobro_no_aptos) values(' . $idEmpInt . ',' . $idEmpCliente . ',' . $aiu . ',' . $tipoFac . ',' . $identClienteKactus . ',' . $arbCliente . ',' . $cobroAptos . ')';
            $resulInsert = $conexion->insertar($sql);
            return $resulInsert;
        }
    }

    function consultarCentroCosto($idEmpInt, $idEmpCliente) {

        $conexion = new conexion();
        $sql = "select id_tipo_cobro from exmed_tipo_cobro where id_empresa_interna = " . $idEmpInt . " and id_empresa_cliente = " . $idEmpCliente . " ";
        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
    }

    function eliminarCentroCosto($idCentroCosto) {

        $conexion = new conexion();
        $sql = "delete from exmed_tipo_cobro where id_tipo_cobro = " . $idCentroCosto . "";
        $resulDelete = $conexion->insertar($sql);
        return $resulDelete;
    }

    function consultarCentroCostos() {

        $conexion = new conexion();
        
        $sql = "select  a.id_tipo_cobro,
                        d.nom_empr as id_empresa_interna,
                        c.nombre as id_empresa_cliente,
                        a.aiu,
                        b.nombre as tipo_facturacion,
                        (case when a.id_cliente_kactus = 0 then '' else a.id_cliente_kactus  end) as id_cliente_kactus,
                       (case when a.acepta_cobro_no_aptos = 1 then 'Si' else 'No' end)as cobro_aptos 
                       from exmed_tipo_cobro a
                                inner join exmed_tipo_facturacion b 
                                        on a.tipo_facturacion = b.id_tipo_facturacion

                                inner join cliente_general c 
                                        on convert(varchar, a.id_empresa_cliente) = c.nit
                                       and a.id_empresa_interna = c.empresa

                                inner join kactus.dbo.gn_empre d
                                        on a.id_empresa_interna = d.cod_empr";
        
        
        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
    }
    

}
?>

