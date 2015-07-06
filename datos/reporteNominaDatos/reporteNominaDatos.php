<?php

session_start();
include_once '../../datos/conexion.php';

class reporteNominaDatos {

    function __construct() {
        
    }

    function consultarClietneBySupervisor($idUser, $idEmpInt) {

        $conexion = new conexion();
        $idUser = 1474; // id usuario temporal       
        $sql = "select a.nit ,a.nombre
                from cliente_general a,
                relacion_clientes b
                where 1=1
                and a.nit = b.rc_nit_cliente
                and b.rc_codigo_coordinador = " . $idUser . " 
                and a.estado = 'A' 
                and a.empresa = " . $idEmpInt . "
                and a.nombre != ''
                group by a.nit,a.nombre order by a.nombre";

        $resulConsulta = $conexion->consultar($sql);
        return $resulConsulta;
    }

    function cosultarCentroCostos($idEmpInt, $idEmpCli) {

        $conexion = new conexion();

        if ($idEmpInt == 1 || $idEmpInt == 3) {

            $sql = "Select  b.cod_ccos,
                            a.act_econ,
                            a.nit_clie,
                            a.cod_clie,
                            a.nom_clie,
                            a.cod_empr,
                            a.obs_erva 
                            From nm_fapar a,
                            gn_ccost b
                            Where  (a.obs_erva='" . $idEmpCli . "' Or a.nit_clie='" . $idEmpCli . "')
                            And a.cod_clie=b.cod_ccos 
                            And a.cod_empr = b.cod_empr 
                            And b.ind_acti= 'A'                            
                            group by a.act_econ,a.nit_clie,a.cod_clie,a.nom_clie,a.cod_empr,a.obs_erva, b.cod_ccos
                            order by a.act_econ";
        } else {

            $sql = "Select b.cod_ccos,a.act_econ,a.nit_clie,a.cod_clie,a.nom_clie,a.cod_empr,a.obs_erva 
                          from nm_fapar a,
                          gn_ccost b
                          Where (a.cod_empr= " . $idEmpInt . ") and a.Nit_clie='" . $idEmpCli . "'
                          and a.cod_clie=b.cod_ccos and a.cod_empr = b.cod_empr and b.ind_acti= 'A'
                          group by a.act_econ,a.nit_clie,a.cod_clie,a.nom_clie,a.cod_empr,a.obs_erva,b.cod_ccos order by a.act_econ";
        }


        $resulConsulta = $conexion->consultarKactus($sql);
        return $resulConsulta;
    }

    function consultarUsuarios($empInt, $centroCosto, $ciudad) {

        $conexion = new conexion();
        $sql = "select DISTINCT a.cod_empl,c.nom_empl,c.ape_empl    
                        from dbo.nm_contr a 
                        left join biplus.dbo.novedad_retiro b
                        on(
                        convert(varchar,a.cod_empl) = b.cedula 
                        and a.cod_ccos = b.centro_costos
                        ) ,dbo.bi_emple c 
                        where 
                        a.ind_acti = 'A'
                        and a.cod_empr = " . $empInt . "
                        and a.cod_ccos = " . $centroCosto . " 
                        and a.cod_niv3 = " . $ciudad . "
                        and a.cod_empl = c.cod_empl
                        and b.cedula is null
                        and b.centro_costos is null";
        $resulConsulta = $conexion->consultarKactus($sql);
        return $resulConsulta;
    }

    function insertEncabezadoPlanilla($empresaInt, $empUsu, $centroCosto, $ciudad, $periodo, $quincena, $usuCreo, $fechaCreo, $tipo, $estado) {

        $conexion = new conexion();
        $sqlInsert = "insert into mod_nomina_planilla (consecutivo,
                                 id_emp_int,
                                 id_emp_cli,
                                 centro_costo,
                                 ciudad,
                                 periodo,
                                 tipo,
                                 quincena,
                                 usu_creo,
                                 fecha_creo,
                                 estado) 
                          values('" . $tipo . "'," . $empresaInt . "," . $empUsu . "," . $centroCosto . "," . $ciudad . ",'" . $periodo . "',1," . $quincena . "," . $usuCreo . ",'" . $fechaCreo . "'," . $estado . ")";

        $resulInsert = $conexion->insertar($sqlInsert);
        return $resulInsert;
    }

    function insertDetallePlanilla($cedula, $observaciones) {

        $conexion = new conexion();
        $sqlInsert = "insert into mod_nomina_planilla_usuario(id_planilla,id_usuario,observaciones)values(IDENT_CURRENT('dbo.mod_nomina_planilla') ," . $cedula . ",'" . $observaciones . "')";
        $resulInsert = $conexion->insertar($sqlInsert);
        return $resulInsert;
    }

    function insertDetallePlanillaAdicionales($cedula, $he, $hen, $hef, $hefn, $hed, $hedn, $rn, $auxMov, $comision, $observaciones) {

        $conexion = new conexion();
        $sqlInsert = "insert into mod_nomina_planilla_usuario(id_planilla,id_usuario,he,hen,hef,hefn,hed,hedn,rn,aux_mov,comision,observaciones)values(IDENT_CURRENT('dbo.mod_nomina_planilla') ," . $cedula . "," . $he . ", " . $hen . "," . $hef . "," . $hefn . "," . $hed . "," . $hedn . "," . $rn . "," . $auxMov . "," . $comision . ",'" . $observaciones . "')";
        $resulInsert = $conexion->insertar($sqlInsert);
        return $resulInsert;
    }

    function insertDia($periodo, $tipo, $nom) {

        $conexion = new conexion();
        $sqlInsert = "insert into mod_nomina_dia(id_planilla_usuario,tipo,fecha,nom) values(IDENT_CURRENT('dbo.mod_nomina_planilla_usuario'),'" . $tipo . "','" . $periodo . "','" . $nom . "')";
        $resulInsert = $conexion->insertar($sqlInsert);
        return $resulInsert;
    }

    function consultarAdicionales() {
        
    }
    
    function getIdentityPlanilla(){
        
        $conexion = new conexion();       
        $sql = "select IDENT_CURRENT('dbo.mod_nomina_planilla') as id";         
        $resul = $conexion->consultar($sql);         
        return $resul;
        
    }

    function cosultaPlanillaById($id) {

        $conexion = new conexion();

        $sql = "select * from mod_nomina_planilla where id = ".$id." ";
        $resulInsert = $conexion->consultar($sql);
        return $resulInsert;
    }

}

?>
