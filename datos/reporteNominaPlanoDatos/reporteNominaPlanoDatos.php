<?php

session_start();
include_once '../../datos/conexion.php';

class reporteNominaPlanoDatos {

    function __construct() {}

    function consultarClietneBySupervisor($idUser, $idEmpInt){

        $conexion = new conexion();

        $sql = "select a.nit ,a.nombre
                from cliente_general a,
                mod_nomina_usuario_cliente b
                where 1=1
                and a.nit = b.nit
                and b.idUser = " . $idUser . " 
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
        
         $sql = "select a.cod_empl,c.nom_empl,c.ape_empl    
                        from dbo.nm_contr a 
                        left join biplus.dbo.novedad_retiro b
                        on(
                        convert(varchar,a.cod_empl) = b.cedula 
                        and a.cod_ccos = b.centro_costos
                        ) ,dbo.bi_emple c 
                        where 
                        a.ind_acti = 'A'
                        and a.cod_empr = " . $empInt . "
                        and c.cod_empr = ".$empInt."
                        and a.cod_ccos = " . $centroCosto . " 
                        and a.cod_niv3 = " . $ciudad . "
                        and a.cod_empl = c.cod_empl
                        and b.cedula is null
                        and b.centro_costos is null";
         
        $resulConsulta = $conexion->consultarKactus($sql);
        return $resulConsulta;
    }

    function valCedCentroCosto($cedula, $empresaInt, $centroCosto, $ciudad) {

        $conexion = new conexion();
        $sql = "select count(*) as cantidad    
                        from dbo.nm_contr a 
                        left join biplus.dbo.novedad_retiro b
                        on(
                        convert(varchar,a.cod_empl) = b.cedula 
                        and a.cod_ccos = b.centro_costos
                        ) ,dbo.bi_emple c 
                        where 
                        a.ind_acti = 'A'
                        and a.cod_empr = " . $empresaInt . "
                        and a.cod_ccos = " . $centroCosto . " 
                        and a.cod_niv3 = " . $ciudad . "
                        and a.cod_empl = " . $cedula . "    
                        and a.cod_empl = c.cod_empl
                        and b.cedula is null
                        and b.centro_costos is null ";

        $resulConsulta = $conexion->consultarKactus($sql);
        return $resulConsulta;
    }

    function insertEncabezadoPlanilla($empresaInt, $empUsu, $centroCosto, $ciudad, $fecha, $quincena, $usuCreo, $fechaCreo, $tipo, $estado) {

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
                          values('" . $tipo . "'," . $empresaInt . "," . $empUsu . "," . $centroCosto . "," . $ciudad . ",'" . $fecha . "',1," . $quincena . "," . $usuCreo . ",'" . $fechaCreo . "'," . $estado . ")";

        $resulInsert = $conexion->insertar($sqlInsert);
        return $resulInsert;
    }

    function insertDetallePlanilla($cedula, $hrsHabiles, $hrsFestivas, $horasDominicales, $observaciones) {
        
        $conexion = new conexion();
        $sqlInsert = "insert into mod_nomina_planilla_usuario(id_planilla,id_usuario,horas_habiles,horas_dominicales,horas_festivos,observaciones) values(IDENT_CURRENT('dbo.mod_nomina_planilla')," . $cedula . "," . $hrsHabiles . "," . $horasDominicales . "," . $hrsFestivas . ",'" . $observaciones . "')";
        $resulInsert = $conexion->insertar($sqlInsert);
        return $resulInsert;
    }

    function insertDia($periodo, $tipo, $nom) {

        $conexion = new conexion();
        $sqlInsert = "insert into mod_nomina_dia(id_planilla_usuario,tipo,fecha,nom) values(IDENT_CURRENT('dbo.mod_nomina_planilla_usuario'),'" . $tipo . "','" . $periodo . "','" . $nom . "')";
        $resulInsert = $conexion->insertar($sqlInsert);
        return $resulInsert;
    }

    function insertConceptos($nombre, $valor) {

        $conexion = new conexion();
        $sqlInsert = "insert into mod_nomina_concepto(id_planilla_usuario,nombre,valor) values(IDENT_CURRENT('dbo.mod_nomina_planilla_usuario'),'" . $nombre . "'," . $valor . ")";
        $resulInsert = $conexion->insertar($sqlInsert);
        return $resulInsert;
    }

    function getIdentityPlanilla() {

        $conexion = new conexion();
        $sql = "select IDENT_CURRENT('dbo.mod_nomina_planilla') as id";
        $resul = $conexion->consultar($sql);
        return $resul;
    }

    function consultarDatosRegByIdPlanilla($id) {

        $conexion = new conexion();
        $sql = "select a.id, a.consecutivo,
                        a.id_emp_int,a.id_emp_cli,
                        a.centro_costo,a.periodo, 
                        a.tipo,a.quincena,
                        b.horas_habiles,
                        b.horas_dominicales,
                        b.horas_festivos,
                        b.id_usuario,
                        e.nom_empl,
                        e.ape_empl  

                        from   mod_nomina_planilla a,
                               mod_nomina_planilla_usuario b
                               left join mod_nomina_concepto d on (b.id = d.id_planilla_usuario),
                               mod_nomina_dia c,      
                               kactus.dbo.bi_emple e
                        where 1 = 1
                        and a.id = " . $id . "
                        and a.id = b.id_planilla
                        and b.id = c.id_planilla_usuario
                        and b.id_usuario = e.cod_empl
                        group by a.id, a.consecutivo,
                        a.id_emp_int,a.id_emp_cli,
                        a.centro_costo,a.periodo, 
                        a.tipo,a.quincena,
                        b.horas_habiles,
                        b.horas_dominicales,
                        b.horas_festivos,
                        b.id_usuario,
                        e.nom_empl,
                        e.ape_empl
                        order by e.ape_empl,e.nom_empl";

        $resul = $conexion->consultar($sql);
        return $resul;
    }

    function consultarDiasByUsuario($idPlanilla, $idUsuario) {

        $conexion = new conexion();
        $sql = "select a.tipo,a.fecha,a.nom 

                from mod_nomina_dia a,
                mod_nomina_planilla_usuario b

                where 1=1
                and b.id_planilla = " . $idPlanilla . "
                and b.id_usuario = " . $idUsuario . "
                and b.id = a.id_planilla_usuario";

        $resul = $conexion->consultar($sql);
        return $resul;
    }

    function consultarConceptosByUsuario($idPlanilla, $idUsuario) {

        $conexion = new conexion();
        $sql = "select d.nom_conc as nombre,a.valor 

                from mod_nomina_concepto a,
                mod_nomina_planilla_usuario b,
                mod_nomina_planilla c,
                kactus.dbo.nm_conce d

                where 1=1
                and b.id_planilla = " . $idPlanilla . "
                and b.id_planilla = c.id
                and c.id_emp_int = d.cod_empr
                and a.nombre = d.cod_conc
                and b.id_usuario = " . $idUsuario . "
                and b.id = a.id_planilla_usuario";

        $resul = $conexion->consultar($sql);
        return $resul;
    }

    function consultarTotalConceptos($idPlanilla) {

        $conexion = new conexion();
        $sql = "select sum(c.valor) as total

                from dbo.mod_nomina_planilla as a,
                dbo.mod_nomina_planilla_usuario b,
                dbo.mod_nomina_concepto c

                where 1 = 1

                and a.id = " . $idPlanilla . "
                and a.id = b.id_planilla
                and b.id = c.id_planilla_usuario
                ";

        $resul = $conexion->consultar($sql);
        return $resul;
    }

    function consultarDetConceptos($idPlanilla) {

        $conexion = new conexion();
        $sql = "select d.nom_conc as nombre,
                        sum (c.valor)as totalConcepto

                 from dbo.mod_nomina_planilla as a,
                 dbo.mod_nomina_planilla_usuario b,
                 dbo.mod_nomina_concepto c,
                 kactus.dbo.nm_conce d
                 where 1 = 1

                 and a.id = " . $idPlanilla . "
                 and a.id_emp_int = d.cod_empr
                 and c.nombre = d.cod_conc    
                 and a.id = b.id_planilla
                 and b.id = c.id_planilla_usuario
                 group by d.nom_conc";

        $resul = $conexion->consultar($sql);
        return $resul;
    }

    function finalizarPlanilla($idPlanilla) {

        $conexion = new conexion();
        $sqlUpdate = "update mod_nomina_planilla set estado = 2 where id = " . $idPlanilla . " ";
        $resul = $conexion->insertar($sqlUpdate);
        return $resul;
    }

    function eliminarPlanilla($idPlanilla) {

        $conexion = new conexion();
        $sqlUpdate = "update mod_nomina_planilla set estado = 3 where id = " . $idPlanilla . " ";
        ;
        $resul = $conexion->insertar($sqlUpdate);
        return $resul;
    }

    function valAdicional($idAdicional, $empInt) {

        $conexion = new conexion();
        $sql = "select count(*) as cantidad
                from dbo.nm_conce a
                where a.cod_empr = " . $empInt . "
                and a.cod_conc = " . $idAdicional . " ";

        $resul = $conexion->consultarKactus($sql);
        return $resul;
    }

    function valDiaReportado($ced, $fecha, $tipoDia) {

        $conexion = new conexion();
        $sql = "select count(*) as cantidad from 
                        dbo.mod_nomina_planilla a,
                        dbo.mod_nomina_planilla_usuario b,
                        dbo.mod_nomina_dia c
                        where 1=1
                        and c.fecha = '" . $fecha . "'
                        and c.tipo = '" . $tipoDia . "'
                        and c.id_planilla_usuario = b.id
                        and b.id_usuario = " . $ced . "
                        and b.id_planilla = a.id
                        and a.estado in (2,4)";

        $resul = $conexion->consultar($sql);
        return $resul;
    }

    function cantUsuariosSinRegistrar($idPlanilla, $empInt, $centroCosto, $ciudad) {

        $conexion = new conexion();
        $sql = "SELECT count(*) as cantidad
                        FROM Kactus.dbo.bi_emple AS e 
                             INNER JOIN Kactus.dbo.nm_contr AS c 
                             ON e.cod_empr = c.cod_empr 
                             AND e.cod_empl = c.cod_empl 
                             LEFT OUTER JOIN dbo.mod_nomina_planilla AS a 
                             INNER JOIN dbo.mod_nomina_planilla_usuario AS b 
                             ON a.id = b.id_planilla 
                             ON c.cod_empl = b.id_usuario 
                             AND c.cod_empr = a.id_emp_int 
                             AND c.cod_ccos = a.centro_costo
                             and a.id = " . $idPlanilla . "
                             left join biplus.dbo.novedad_retiro d
                             on(convert(varchar,c.cod_empl) = d.cedula 
                                and c.cod_ccos = d.centro_costos)
                        WHERE 1=1
                        and c.cod_niv3 = " . $ciudad . "
                        and e.cod_empr = " . $empInt . "
                        and c.cod_empr = " . $empInt . "
                        and c.cod_ccos = " . $centroCosto . " 
                        and c.ind_acti = 'A'
                        and b.id_usuario is null
                        and d.cedula is null
                        and d.centro_costos is null ";

        $resul = $conexion->consultar($sql);
        return $resul;
    }

    function valUsuariosSinRegistrar($idPlanilla, $empInt, $centroCosto, $ciudad) {

        $conexion = new conexion();
        $sql = "SELECT c.cod_empl as cedula,e.ape_empl as apellido,e.nom_empl as nombre
                        FROM Kactus.dbo.bi_emple AS e 
                             INNER JOIN Kactus.dbo.nm_contr AS c 
                             ON e.cod_empr = c.cod_empr 
                             AND e.cod_empl = c.cod_empl 
                             LEFT OUTER JOIN dbo.mod_nomina_planilla AS a 
                             INNER JOIN dbo.mod_nomina_planilla_usuario AS b 
                             ON a.id = b.id_planilla 
                             ON c.cod_empl = b.id_usuario 
                             AND c.cod_empr = a.id_emp_int 
                             AND c.cod_ccos = a.centro_costo
                             and a.id = " . $idPlanilla . "
                             left join biplus.dbo.novedad_retiro d
                             on(convert(varchar,c.cod_empl) = d.cedula 
                                and c.cod_ccos = d.centro_costos)
                        WHERE 1=1
                        and c.cod_niv3 = " . $ciudad . "
                        and e.cod_empr = " . $empInt . "
                        and c.cod_empr = " . $empInt . "
                        and c.cod_ccos = " . $centroCosto . " 
                        and c.ind_acti = 'A'
                        and b.id_usuario is null
                        and d.cedula is null
                        and d.centro_costos is null ";

        $resul = $conexion->consultar($sql);
        return $resul;
    }

}
?>

