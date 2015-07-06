<?php

include_once '../conexion.php';

class capturaAnticipoDatos {

    function __construct() {}

    function consultarCta($idUser) {

        $conexion = new conexion();

        $sql = "select * from nm_cuent a,nm_entid b,nm_contr c 
                         where a.cod_empl ='" . $idUser . "'
                         and a.tip_enti = 'BAN'
                         and a.cod_enti = b.cod_enti 
                         and b.tip_enti = 'BAN' 
                         and a.cod_empr = b.cod_empr 
                         and b.cod_sucu = 0 
                         and a.cod_empr = c.cod_empr 
                         and a.cod_empl = c.cod_empl 
                         and c.ind_acti = 'A' 
                         and a.nro_cont = c.nro_cont";

        $resulConsulta = $conexion->consultarKactus($sql);
        return $resulConsulta;
    }

    function consultarCentroCostoUnoE($empInt, $idCentroCosto) {

        $conexion = new conexion();

        if (ctype_digit($idCentroCosto)) {

            $sql = "select top (10) * from dbo.t284_co_ccosto 
                            where f284_id_cia=$empInt
                            and f284_id like '%" . $idCentroCosto . "%'
                            and f284_ind_estado=1";
        } else {

            $sql = "select top (10) * from dbo.t284_co_ccosto 
                            where 
                            and f284_descripcion like '%" . $idCentroCosto . "%'
                            and f284_ind_estado=1
                            order by f284_descripcion desc";
        }
        $resulConsulta = $conexion->consultarUnoE($sql);
        if ($resulConsulta != null) {

            return $resulConsulta;
        }
    }

    function consultaUnidadNegocio($empInt, $idCentroCosto) {

        $conexion = new conexion();
        $centroCosto = $this->consultarCentroCostoUnoE($empInt, $idCentroCosto);
        if ($centroCosto[0]['f284_id_un'] == '') {

            $sql = "select f281_descripcion,f281_id from t281_co_unidades_negocio where f281_ind_estado = 1 And (f281_id_cia = 1 or f281_id_cia = 3) Group by f281_id,f281_descripcion  order by f281_descripcion asc";
            //$sql = "select f281_descripcion,f281_id from t281_co_unidades_negocio where f281_ind_estado = 1 And f281_id_cia = " . $empInt . " Group by f281_id,f281_descripcion  order by f281_descripcion asc";

            $resulConsulta = $conexion->consultarUnoE($sql);
            return $resulConsulta;
        } else {

            //$sql = "select f281_descripcion,f281_id from t281_co_unidades_negocio where f281_ind_estado = 1 And f281_id_cia= " . $empInt . " and f281_id= " . $centroCosto[0]['f284_id_un'] . " Group by f281_id,f281_descripcion  order by f281_descripcion asc";
            $sql = "select f281_descripcion,f281_id from t281_co_unidades_negocio where f281_ind_estado = 1 And (f281_id_cia = 1 or f281_id_cia = 3) and f281_id= " . $centroCosto[0]['f284_id_un'] . " Group by f281_id,f281_descripcion  order by f281_descripcion asc";

            $resulConsulta = $conexion->consultarUnoE($sql);
            return $resulConsulta;
        }
    }

    function consultaPresupuestoBiplus($idPresupuesto) {

        $conexion = new conexion();
        $sql = "select * from presupuesto where pr_consecutivo= " . $idPresupuesto . " and pr_aprobado = 'S' and pr_estado ='A'";
        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
    }

    function consultarCiudadesBycodEmpresa($idEmpresa) {

        $conexion = new conexion();
        $sql = "select nom_nive as f285_descripcion,cod_nive,nom_nive,cod_empr,num_nive from gn_nivel where cod_nive > 0 and num_nive = 3 and cod_empr=" . $idEmpresa . "";
        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
    }

    function consultaConceptosPresupuestoByCiudad($idPresupuesto, $idCiudad) {

        $conexion = new conexion();
        $sql = "select * from Conceptos_presupuesto where pcp_cod_ciudad in (Select b.pcp_cod_ciudad From Conceptos_presupuesto as a 
                            inner join persona_ciudad_presupueto as b on(a.cp_consecutivo = b.pcp_consecutivo_pr 
                                                                         and a.cp_cod_cargo = b.pcp_consecutivo_cargo
                                                                         and  a.cp_base_datos = 'U' 
                                                                         and a.cp_cod_copcento > 0 
                                                                         and a.cp_consecutivo=" . $idPresupuesto . "
                                                                         and b.pcp_estado = 'A'
                                                                         and b.pcp_cod_ciudad = " . $idCiudad . " )
                            LEFT join dbo.mod_anticipos_conceptos_excluidos as c on(a.cp_cod_copcento = c.cod_concepto)
                            where c.cod_concepto is null
                            group by a.cp_cod_copcento,a.cp_valor,a.pr_num_periodo,a.cp_cod_cargo,b.pcp_cod_ciudad,a.cp_item_presupuesto,a.centro_operacion)";
        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
    }

    function consultaConceptosByPeriodo($idPresupuesto, $idCiudad) {

        $conexion = new conexion();
        $sql = "select d.cp_cod_copcento,
                        d.cp_valor,
                        d.pr_num_periodo,
                        d.pcp_num_personas
                 from (select a.cp_cod_copcento, 
                        a.cp_valor, max(a.pr_num_periodo) as pr_num_periodo, 
                        a.cp_cod_cargo, 
                        b.pcp_cod_ciudad, 
                        a.cp_item_presupuesto, 
                        a.centro_operacion, 
                        b.pcp_num_personas
                 from   dbo.conceptos_presupuesto as a inner join
                        dbo.persona_ciudad_presupueto as b on a.cp_consecutivo = b.pcp_consecutivo_pr and a.cp_cod_cargo = b.pcp_consecutivo_cargo and a.cp_base_datos = 'U' and 
                        a.cp_cod_copcento > 0 
                        and a.cp_consecutivo = " . $idPresupuesto . " -- id presupuesto
                        and b.pcp_estado = 'A' 
                        and b.pcp_cod_ciudad = " . $idCiudad . " --id ciudad
                        and b.pcp_num_periodo = (select max(a.pr_num_periodo) as Expr1
                                                        from dbo.conceptos_presupuesto as a inner join 
                                                             dbo.persona_ciudad_presupueto as b on a.cp_consecutivo = b.pcp_consecutivo_pr 
                                                                                                   and a.cp_cod_cargo = b.pcp_consecutivo_cargo 
                                                                                                   and a.cp_base_datos = 'U' 
                                                                                                   and a.cp_cod_copcento > 0 
                                                                                                   and a.cp_consecutivo = " . $idPresupuesto . " --idpresupuesto
                                                                                                   and b.pcp_estado = 'A' 
                                                                                                   and b.pcp_cod_ciudad = " . $idCiudad . " -- id ciudad
                                                                                                   left outer join dbo.mod_anticipos_conceptos_excluidos as c on a.cp_cod_copcento = c.cod_concepto
                                                                                                   where(c.cod_concepto is null)) 
                       left outer join dbo.mod_anticipos_conceptos_excluidos as c on a.cp_cod_copcento = c.cod_concepto
                       where (c.cod_concepto is null)
                       group by a.cp_cod_copcento, a.cp_valor, a.cp_cod_cargo, b.pcp_cod_ciudad, a.cp_item_presupuesto, a.centro_operacion, b.pcp_num_personas
                 ) 
                       as d
                       where 1=1     
                       and d.pcp_cod_ciudad = " . $idCiudad . " -- id ciudad
                       and d.cp_valor != 0      
                       group by d.cp_cod_copcento,
                       d.cp_valor,
                       d.pr_num_periodo,
                       d.pcp_num_personas";
        
        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
    }

    function consultarUnidadNegocioPresupuesto($idEvento = '') {

        $conexion = new conexion();

        if ($idEvento == '') {

            $sql = "select  f281_descripcion,f281_id 
                        from t281_co_unidades_negocio 
                        where f281_ind_estado = 1 
                        and (f281_id_cia = 1 or f281_id_cia = 3) 
                        Group by f281_id,f281_descripcion  
                        order by f281_descripcion asc";

            $resulConsulta = $conexion->consultarUnoE($sql);
            return $resulConsulta;
        } else {

            $sql = "select  f281_descripcion,f281_id 
                        from t281_co_unidades_negocio 
                        where f281_ind_estado = 1 
                        and (f281_id_cia = 1 or f281_id_cia = 3)
                        and f281_id = " . $idEvento . "
                        Group by f281_id,f281_descripcion  
                        order by f281_descripcion asc";

            $resulConsulta = $conexion->consultarUnoE($sql);
            return $resulConsulta;
        }
    }
    
    function consultaConceptoUnoe($idConcepto){
        
        $conexion = new conexion();
        $sql = "Select f253_descripcion From t253_co_auxiliares Where f253_Id='".$idConcepto."' and f253_id_cia = 3";
        $resulConsulta = $conexion->consultarUnoE($sql);
        return $resulConsulta;       
        
    }


//    function consultaConceptosPresupuestoByCiudad($idPresupuesto,$idCiudad){
//         
//        $conexion = new conexion();
//        $sql = "Select a.cp_cod_copcento,a.cp_valor,a.pr_num_periodo,a.cp_cod_cargo,b.pcp_cod_ciudad,a.cp_item_presupuesto,a.centro_operacion 
//
//                       From Conceptos_presupuesto as a 
//                            inner join persona_ciudad_presupueto as b on(a.cp_consecutivo = b.pcp_consecutivo_pr 
//                                                                         and a.cp_cod_cargo = b.pcp_consecutivo_cargo
//                                                                         and  a.cp_base_datos = 'U' 
//                                                                         and a.cp_cod_copcento > 0 
//                                                                         and a.cp_consecutivo=".$idPresupuesto."
//                                                                         and b.pcp_estado = 'A'
//                                                                         and b.pcp_cod_ciudad = ".$idCiudad." )
//                            LEFT join dbo.mod_anticipos_conceptos_excluidos as c on(a.cp_cod_copcento = c.cod_concepto)
//                            where c.cod_concepto is null
//                            group by a.cp_cod_copcento,a.cp_valor,a.pr_num_periodo,a.cp_cod_cargo,b.pcp_cod_ciudad,a.cp_item_presupuesto,a.centro_operacion";
//        $resulConsulta = $conexion->consultar($sql);
//        return $resulConsulta;       
//    }
}
?>

